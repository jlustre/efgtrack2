<?php
$j=json_decode(file_get_contents('resources/lang/es.json'),true);
$keys=['Profile','Saved.','Saved:','Weekdays AM','Weekdays PM','Anytime','Language','Settings','Log Out','English','Spanish','Select','Save'];
foreach($keys as $k){
    echo $k.' => '.($j[$k] ?? '[missing]')."\n";
}
