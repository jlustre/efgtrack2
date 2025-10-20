<?php
$root = __DIR__;
$enFile = $root . '/resources/lang/en.json';
$esFile = $root . '/resources/lang/es.json';
$timestamp = date('YmdHis');
$backupFile = $esFile . '.bak.' . $timestamp;

if (!file_exists($enFile)) {
    echo "en.json not found\n";
    exit(1);
}

$enJson = file_get_contents($enFile);
$en = json_decode($enJson, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Failed to parse en.json: " . json_last_error_msg() . "\n";
    exit(1);
}

$es = [];
if (file_exists($esFile)) {
    $esRaw = file_get_contents($esFile);
    // backup raw es file even if malformed
    file_put_contents($backupFile, $esRaw);
    $es = json_decode($esRaw, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Warning: existing es.json is malformed (backup created at: $backupFile). Proceeding with empty Spanish translations.\n";
        $es = [];
    }
} else {
    echo "No existing es.json found. A new one will be created.\n";
}

$merged = [];
foreach ($en as $k => $v) {
    if (isset($es[$k]) && $es[$k] !== '') {
        $merged[$k] = $es[$k];
    } else {
        $merged[$k] = $v; // english placeholder
    }
}

// sort by key for determinism
ksort($merged);
$out = json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if ($out === false) {
    echo "Failed to encode merged JSON: " . json_last_error_msg() . "\n";
    exit(1);
}
file_put_contents($esFile, $out . PHP_EOL);

echo "Merged es.json written successfully. Backup of previous es.json: $backupFile\n";
exit(0);
