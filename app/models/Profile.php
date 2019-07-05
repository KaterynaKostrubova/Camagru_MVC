<?php

namespace app\models;

use app\core\Model;

class Profile extends Model {

    public function getUser($user){
        $result = $this->db->row("SELECT * FROM users WHERE login='$user'");
        return $result;
    }

    public function updateTable($table, $field, $value, $whereField, $whereValue){
        if($this->db->query("UPDATE $table SET $field='$value' WHERE $whereField='$whereValue'"))
            return true;
        else
            return false;
    }

}
