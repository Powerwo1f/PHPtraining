<?php

Class Header extends Controller {
    private $data;

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->data['live_link'] = $this->router->link('user/user');

        if (isset($_SESSION['user'])) {
            $this->data['user'] = $_SESSION['user'];
        }

        extract($this->data);
        require_once DIR_TEMPLATE . 'views/common/header.html';
    }
}