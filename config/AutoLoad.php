<?php

function autoload($className)
{
    $directories = array(
        $_SERVER['DOCUMENT_ROOT'] . '/config/',
        $_SERVER['DOCUMENT_ROOT'] . '/template/'
    );

    foreach ($directories as $directory) {
        $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
        if (file_exists($directory . $className . '.php')) {
            require_once($directory . $className . '.php');
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