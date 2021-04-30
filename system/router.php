<?php

/**
Router работает только с локигой маршрутизации
 */

Class Router {

    private $loader;

    public function __construct($loader){
        $this->loader = $loader;
    }

    public function route(){
        $route = false;

        if(!$_SERVER['REQUEST_URI'] || $_SERVER['REQUEST_URI'] == '/'){
            if(isset($_SESSION['user'])){
                $route = 'common/home';
            } else $route = 'user/user';

        } elseif(isset($_GET['route'])){
            $route = ($this->loader->checkPath($_GET['route'], 'controller') ? $_GET['route'] : false);

            $routes = ROUTES;
            if(isset($routes[$route])){
                $this->redirect(ROUTES[$route]);
            }

        } elseif ($_SERVER['REQUEST_URI'] && $_SERVER['REQUEST_URI'] !== '/') {
            //Внутренние ссылки ведут сразу на маску так что мы ищем роут из массива в конфигах
            $get_route = array_search(str_replace('/', '', $_SERVER['REQUEST_URI']), ROUTES);
            if ($get_route) {
                $route = ($this->loader->checkPath($get_route) ? $get_route : false);
            }

        }

        //При не найденном маршруте сайт редиректит на / что в итоге воспроизведёт первое условие
        if (!$route){
            $this->redirect('/');
        }

        //При наличии 3 параметра пути роутер попробует запустить указанный после 2го слеша метод класса, если такой есть
        if (count(explode('/', $route)) >= 3){
            $this->run_method($route);
        }

        return $route;
    }

    public function redirect($location){
        header('Location: ' . $location);
    }

    public function link($route){
        $link = '/';

        $route = ($this->loader->checkPath($route, 'controller') ? $route : false);
        if($route) {
            $routes = ROUTES;
            if(isset($routes[$link])){
                $link = $routes[$link];
            } else {
                $link = 'index.php?route=' . $route;
            }
        }

        return $link;
    }

    private function run_method($route){
        $path = explode('/', $route);
        $class = new $path[1];
        $method = $path[2];
        if(method_exists($class, $method)) {
            $class->$method();
            die();
        }
    }

}