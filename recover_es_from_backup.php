<?php
$root = __DIR__;
$enFile = $root . '/resources/lang/en.json';
$backupPattern = $root . '/resources/lang/es.json.bak.*';
$matches = glob($backupPattern);
if (empty($matches)) {
    echo "No es.json backup found matching pattern: $backupPattern\n";
    exit(1);
}
$backupFile = $matches[count($matches)-1]; // most recent
$outFile = $root . '/resources/lang/es.json';

$en = json_decode(file_get_contents($enFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Failed to parse en.json: " . json_last_error_msg() . "\n";
    exit(1);
}

$txt = file_get_contents($backupFile);
// regex to capture simple "key": "value" lines (handles escaped quotes)
$pattern = '/"((?:\\.|[^"\\])+)"\s*:\s*"((?:\\.|[^"\\])*)"/u';
$found = [];
if (preg_match_all($pattern, $txt, $m)) {
    $keys = $m[1];
    $vals = $m[2];
    for ($i = 0; $i < count($keys); $i++) {
        $k = stripcslashes($keys[$i]);
        $v = stripcslashes($vals[$i]);
        // ignore accidental json structure keys like '{' or '}'
        if ($k === '' || $k === '{' || $k === '}' ) continue;
        $found[$k] = $v; // last occurrence wins
    }
}

$merged = [];
foreach ($en as $k => $v) {
    if (isset($found[$k]) && $found[$k] !== '') {
        $merged[$k] = $found[$k];
    } else {
        $merged[$k] = $v; // english fallback
    }
}
ksort($merged);
$out = json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if ($out === false) {
    echo "Failed to encode merged JSON: " . json_last_error_msg() . "\n";
    exit(1);
}
file_put_contents($outFile, $out . PHP_EOL);

echo "Reconstructed es.json from backup ($backupFile). Wrote $outFile\n";
exit(0);
