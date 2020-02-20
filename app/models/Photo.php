<?php

namespace app\models;

use app\core\Model;

class Photo extends Model {

    function getFilters(){
        return  $this->db->row("SELECT path FROM filters ORDER BY id");
    }

}
