<?php
$root = __DIR__;
$enFile = $root . '/resources/lang/en.json';
$esFile = $root . '/resources/lang/es.json';
$en = json_decode(file_get_contents($enFile), true);
$es = json_decode(file_get_contents($esFile), true);
if (json_last_error() !== JSON_ERROR_NONE) $es = [];

$overrides = [
    'Profile' => 'Perfil',
    'Saved.' => 'Guardado.',
    'Saved:' => 'Guardado:',
    'Weekdays AM' => 'Días entre semana - Mañana',
    'Weekdays PM' => 'Días entre semana - Tarde',
    'Weekends AM' => 'Fines de semana - Mañana',
    'Weekends PM' => 'Fines de semana - Tarde',
    'Anytime' => 'En cualquier momento',
    'Language' => 'Idioma',
    'Settings' => 'Configuración',
    'Log Out' => 'Cerrar sesión',
    'English' => 'Inglés',
    'Spanish' => 'Español',
    'Select' => 'Seleccionar',
    'Save' => 'Guardar'
];

foreach ($en as $k => $v) {
    if (isset($overrides[$k])) {
        $es[$k] = $overrides[$k];
    } elseif (!isset($es[$k]) || $es[$k] === '') {
        $es[$k] = $v; // fallback
    }
}
ksort($es);
$out = json_encode($es, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents($esFile, $out . PHP_EOL);
echo "Applied Spanish overrides and wrote es.json\n";
