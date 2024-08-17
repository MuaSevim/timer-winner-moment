<?php

// session_start();

require dirname(__DIR__) . '/config.php';

spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});
