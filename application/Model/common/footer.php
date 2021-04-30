<?php
namespace common;
use System\Model as Model;

class footer {

    private $model;

    public function __construct () {
        $this->model = new Model();
    }
    public function index() {
        if(isset($_POST['inner'])) {
            if(!empty($_POST['file'])) {
                $r = ['jpg','png'];
                var_dump($_POST['file']);
            }

        }
        if(isset($_POST['outer'])) {
            if(!empty($_POST['user_id'])) {
                $id = $_POST['user_id'];
                $query = $this->model->db->query("SELECT email FROM user_list WHERE id = $id ");
                echo 'u selected : ' . $query->row['email'];
            }

        }
    }
}

 ?>
