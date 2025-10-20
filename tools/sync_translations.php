<?php
// Scans resources/views for __('...') and "__(\"...\")" usages,
// finds keys missing from resources/lang/en.json and appends them.

$root = __DIR__ . '/../resources/views';
$enFile = __DIR__ . '/../resources/lang/en.json';

function findFiles($dir) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $files = [];
    foreach ($rii as $file) {
        if ($file->isDir()) continue;
        if (in_array($file->getExtension(), ['blade.php', 'php', 'vue', 'js', 'json'])) {
            $files[] = $file->getPathname();
        }
    }
    return $files;
}

$files = findFiles($root);
$keys = [];
$pattern1 = '/__\(\s*\'([^\']+)\'\s*[),]/';
$pattern2 = '/__\(\s*\"([^\"]+)\"\s*[),]/';

foreach ($files as $file) {
    $text = file_get_contents($file);
    if ($text === false) continue;
    if (preg_match_all($pattern1, $text, $m1)) {
        foreach ($m1[1] as $k) $keys[$k] = true;
    }
    if (preg_match_all($pattern2, $text, $m2)) {
        foreach ($m2[1] as $k) $keys[$k] = true;
    }
}

if (!file_exists($enFile)) {
    file_put_contents($enFile, json_encode(new stdClass(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
$en = json_decode(file_get_contents($enFile), true) ?: [];
$missing = [];
foreach (array_keys($keys) as $k) {
    if (!array_key_exists($k, $en)) {
        $missing[$k] = $k;
        $en[$k] = $k;
    }
}

if (count($missing) === 0) {
    echo "No missing translation keys found.\n";
    exit(0);
}

// Sort and write back
ksort($en);
file_put_contents($enFile, json_encode($en, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Added " . count($missing) . " missing translation keys to resources/lang/en.json\n";
foreach ($missing as $k => $_) {
    echo " - $k\n";
}
