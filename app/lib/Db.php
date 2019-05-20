<?php

namespace app\lib;

use PDO;

class Db {

    function __construct(){
//        echo 'class DB';
        $config = require 'app/config/db.php';
//        debug($config);
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].';charset=UTF8', $config['user'], $config['password']);
    }

    function query($sql, $params = []){
        //защпта от иньекций
        $stmt = $this->db->prepare($sql);
        if (!empty($params)){
            foreach ($params as $key => $val){
                $stmt->bindValue(':'.$key, $val);

            }
        }
        $stmt->execute();
        return $stmt;

//        $query = $this->db->query($sql);
//        $result = $query->fetchColumn();
//        debug($result);
//        return $query;
    }

    public function row($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }




}