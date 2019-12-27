<?php

namespace app\models;

use app\core\Model;

class Gallery extends Model {

    function getPartOfPhotos(){
        return  $this->db->row("SELECT path FROM photos ORDER BY creation DESC LIMIT 3");
    }

}
