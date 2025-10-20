<?php
$root = __DIR__;
$enFile = $root . '/resources/lang/en.json';
$esFile = $root . '/resources/lang/es.json';

$en = json_decode(file_get_contents($enFile), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Failed to parse en.json: " . json_last_error_msg() . PHP_EOL;
    exit(1);
}

$raw = file_get_contents($esFile);

// Capture all occurrences of "key": "value"
$pattern = '/"((?:\\.|[^"\\])+)"\s*:\s*"((?:\\.|[^"\\])*)"/u';
$occ = [];
if (preg_match_all($pattern, $raw, $m)) {
    for ($i = 0; $i < count($m[1]); $i++) {
        $k = stripcslashes($m[1][$i]);
        $v = stripcslashes($m[2][$i]);
        if ($k === '' || $k === '{' || $k === '}') continue;
        if (!isset($occ[$k])) $occ[$k] = [];
        $occ[$k][] = $v;
    }
}

$merged = [];
foreach ($en as $k => $v) {
    $chosen = null;
    if (isset($occ[$k])) {
        // prefer any occurrence different from english (i.e., likely Spanish)
        foreach ($occ[$k] as $candidate) {
            if ($candidate !== $v && $candidate !== '') {
                $chosen = $candidate;
                break;
            }
        }
        // if none different, take last occurrence
        if ($chosen === null) {
            $chosen = end($occ[$k]);
        }
    }
    $merged[$k] = $chosen ?? $v;
}

ksort($merged);
$out = json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents($esFile, $out . PHP_EOL);

echo "Normalized es.json written.\n";
