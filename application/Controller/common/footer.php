<?php

Class Footer extends Controller {
    private $data;

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        require_once DIR_TEMPLATE . 'views/common/footer.html';
    }
}