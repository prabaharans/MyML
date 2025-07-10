<?php

function getFiles($path) {
    $files = glob($path.'/*');
    if ($files === false) {
        throw new RuntimeException("Failed to glob for function files");
    }
    foreach ($files as $file) {
        $src = $path.$file;
        echo $src;die;
        if(is_dir($src)) {
            getFiles($src);
        } else {
            require_once $src;
        }

    }
    unset($file);
    unset($files);
}

$path = glob(__DIR__ . '/src');
getFiles($path);

