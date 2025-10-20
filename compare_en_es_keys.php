<?php
$en=json_decode(file_get_contents('resources/lang/en.json'), true);
$es=json_decode(file_get_contents('resources/lang/es.json'), true);
if (json_last_error() !== JSON_ERROR_NONE) { echo "Parse error in en.json or es.json: " . json_last_error_msg() . PHP_EOL; exit(1); }
$missing = [];
$extra = [];
foreach (array_keys($en) as $k) {
    if (!array_key_exists($k, $es)) $missing[] = $k;
}
foreach (array_keys($es) as $k) {
    if (!array_key_exists($k, $en)) $extra[] = $k;
}
echo "en keys: " . count($en) . PHP_EOL;
echo "es keys: " . count($es) . PHP_EOL;
echo "missing in es.json: " . count($missing) . PHP_EOL;
if (count($missing)) echo implode("\n", $missing) . PHP_EOL;
echo "extra keys in es.json (not in en.json): " . count($extra) . PHP_EOL;
if (count($extra)) echo implode("\n", $extra) . PHP_EOL;
if (count($missing) === 0) echo "All keys synced.\n";
