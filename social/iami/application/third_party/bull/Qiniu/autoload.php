<?php

function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    //$file = __DIR__ . '/src/' . $path . '.php';
    $file = APPPATH.'third_party'.DIRECTORY_SEPARATOR.'bull'.DIRECTORY_SEPARATOR. $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('classLoader');

require_once  APPPATH.'third_party'.DIRECTORY_SEPARATOR.'bull'.DIRECTORY_SEPARATOR.'/Qiniu/functions.php';
