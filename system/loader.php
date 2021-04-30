<?php

/**
Loader - встроенный подгрузчик для MVC контента.
 */

Class Loader {

    public $classes = array();

    public function __construct(){
        if(!is_dir(DIR_APPLICATION)){
            var_dump("DIR_APPLICATION not founded!");die();
        }
    }

    //Check path only working with dir/file functional, no methods here
    public function checkPath($path, $mvc,$namespace = '') {
        if(!in_array(strtolower($mvc), array('controller', 'model', 'view'))) {
            var_dump("MVC mast be in ('controller', 'model', 'view')");die();
        }

        $path = explode('/', $path);

        $className = $path[1];
        $route = $path[0] . '/' . $className;

        if(isset($classes[$route])) {
            return $route;
        }

        $directory = DIR_APPLICATION . strtolower($mvc) . '/' .  $path[0] . '/';
        if(is_dir($directory)){
            $file = $directory . $path[1] . '.php';
            if(file_exists($file)) {
                require_once $file;
                //Используем route каталог/файл как ключ, потому что могут появится одинаковые названия классов
                if($namespace === '') {
                    $this->classes[$route] = new $className;

                } else {
                    $class = $namespace . "\\" . $className;
                    $this->classes[$class] = new $class;
                }

                return $route;
            }
        }

        return false;
    }


    // Загрузчик контроллера принимает только каталог/файл , чтобы не мудрить и не путать ф-л
    public function loadController($path){
        if(count(explode('/', $path)) > 2){
            var_dump("Path to load Controller must be only in dir/file");die();
        }

        if(isset($this->classes[$path]) || ($this->checkPath($path, 'controller'))) {
            //Вот тут возвращаем нужный объект
            return $this->classes[$path];
        } else {
            var_dump("Class is not exists!");die();
        }
    }

    public function loadModel($path,$namespace){
      if(count(explode('/', $path)) > 2){
          var_dump("Path to load Controller must be only in dir/file");die();
      }
      if(isset($this->classes[$path]) || ($this->checkPath($path,'model',$namespace))) {
          //Вот тут возвращаем нужный объект
          $path2 = explode('/',$path);
          $path = join($path2,'\\');
          return $this->classes[$path];
      } else {
          var_dump("Class is not exists!");die();
      }
    }

    public function renderView($data, $path){
        //
    }
}
