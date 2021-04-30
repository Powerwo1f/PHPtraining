<?php
namespace User;
use System\Model as Model;

class User {

    private $model;

    public function __construct () {
        $this->model = new Model();
    }
    public function index() {
      echo 'text from user model';
    }
}

 ?>
