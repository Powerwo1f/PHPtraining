<?php

/**
index.php Подгружает всё необходимое для запуска.
 */

session_start();
if (file_exists('config.php')){
    require_once 'config.php';
}

// Start
if (file_exists(DIR_SYSTEM . 'controller.php')){
    require_once DIR_SYSTEM . 'controller.php';
    $controller = new Controller();
    $controller->start();
}

?>