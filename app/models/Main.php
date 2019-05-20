<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

    public function getUsers(){
        $result = $this->db->row('SELECT login, email FROM users');
        return $result;
    }

}



