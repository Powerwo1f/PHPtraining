<?php

class User Extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index() {
        require_once DIR_TEMPLATE . 'views/common/start.html';
    }

    public function login() {
        if(isset($_POST['login_button'])) {
            if(!empty($_POST['login']) && !empty($_POST['password'])) {
                $query = $this->db->query("SELECT id as user_id FROM user_list WHERE password = '" . md5($this->db->escape($_POST['password'])) . "' AND login = '" . $this->db->escape($_POST['login']) . "'");

                if($query->num_rows) {
                    $_SESSION['user'] = $query->row['user_id'];
                }
            }
        }

        $this->router->redirect('/');
    }

    public function register() {
        if(isset($_POST["register_button"])) {
            if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["login"])) {
                $query = $this->db->query("INSERT INTO user_list (`login`, `email`, `password`) VALUES ('" . $this->db->escape($_POST['login']) . "', '" . $this->db->escape($_POST['email']) . "', '" . md5($this->db->escape($_POST['password'])) . "')");

                if ($query) {
                    $user_id = $this->db->getLastId();
                    $_SESSION['user'] = $user_id;
                }
            }
        }

        $this->router->redirect('/');
    }

}