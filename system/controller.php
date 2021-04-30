<?php
use System\Model as model;
use System\DB as DB;
/**
Controller подгружает необходимый функционал
 */

Class Controller {

    private $objects;

    public function __construct(){
        require_once DIR_SYSTEM . 'loader.php';
        $loader = new Loader();
        $this->objects['loader'] = $loader;

        require_once DIR_SYSTEM . 'router.php';
        $router = new Router($this->loader);
        $this->objects['router'] = $router;

        require_once DIR_SYSTEM . 'DB.php';
        $db = new DB(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        $this->objects['db'] = $db;

        require_once DIR_SYSTEM . 'model.php';
        $this->objects['model'] = new model();
    }

    /**
    По сути простая подгрузка Контроллеров один за другим
     */
    public function start() {
        $routeClass = $this->router->route();

        $parts = array(
            '0' => 'common/header',
            '1' => $routeClass,
            '2' => 'common/footer'
        );

        foreach ($parts as $part){
            $path = explode('/', $part);
            $route = $path[0] . '/' . $path[1];
            $model = $this->loader->loadModel($route,$path[0]);
            $model->index();
            $controller = $this->loader->loadController($route);
            $controller->index();

        }
    }

    public function __get($name){
        if(isset($this->objects[$name])){
            return $this->objects[$name];
        }
    }

}
