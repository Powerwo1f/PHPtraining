<?php
/**
Простой файл конфигурации для хранения информации
 * Незачем использовать один и тот же путь разводя путаницу по проэкту
 */

// HTTP
define('HTTP_SERVER', 'http://lending.local/');

// DIR
define('DIR_APPLICATION', 'application/');
define('DIR_SYSTEM', 'system/');
define('DIR_IMAGE', 'image/');
define('DIR_TEMPLATE', 'application/template/');

// DB
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'users');


/**
Условия для маршрутизации [Ключ для определения контроллера] => маска страницы
 */
//Routes
define('ROUTES', array(
    //'pages/life'  => 'life',
    'pages/live'  => 'live',
    //'pages/love'  => 'love'
));
