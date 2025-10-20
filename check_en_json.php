<?php
$path = 'resources/lang/en.json';
$raw = file_get_contents($path);
if ($raw === false) { echo "en.json not found\n"; exit(1); }
// check basic json
$json = json_decode($raw, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "en.json JSON error: " . json_last_error_msg() . PHP_EOL;
    exit(2);
}

// detect duplicate keys by scanning tokens
$tokens = preg_split('/\n/', $raw);
$keys = [];
$lineNo = 0;
$dups = [];
foreach ($tokens as $line) {
    $lineNo++;
    if (preg_match('/"((?:\\\\.|[^"\\\\])+)"\s*:/', $line, $m)) {
        $k = stripcslashes($m[1]);
        if (isset($keys[$k])) {
            $dups[] = [ 'key' => $k, 'first' => $keys[$k], 'duplicate' => $lineNo ];
        } else {
            $keys[$k] = $lineNo;
        }
    }
}

if (!empty($dups)) {
    echo "Duplicate keys found in en.json:\n";
    foreach ($dups as $d) {
        echo "Key: {$d['key']} (first at line {$d['first']}, duplicate at line {$d['duplicate']})\n";
    }
    exit(3);
}

echo "en.json parsed OK; no duplicate keys detected. Total keys: " . count($keys) . PHP_EOL;
exit(0);
