<?php

$files = glob(__DIR__ . '/*');
$i = 0;
foreach ($files as $file) {
    if (is_file($file)) {
        $i++;
        echo basename($file);
        if($i < count($files)-1) echo ',';
    }
}