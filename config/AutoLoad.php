<?php

function autoload($className)
{
    $directories = [
        $_SERVER['DOCUMENT_ROOT'] . '/config/',
        $_SERVER['DOCUMENT_ROOT'] . '/template/',
        $_SERVER['DOCUMENT_ROOT'] . '/model/',
    ];

    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once($file);
            // echo $file . ' loaded successfully!';
            return;
        }
    }
}

class Autoload
{
    public static function loadRun()
    {
        spl_autoload_register('autoload');
    }
}