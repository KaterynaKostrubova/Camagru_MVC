<?php

namespace app\lib;

use PDO;
use PDOException;
use PDOStatement;

class Db {

    function __construct(){

        try {
//            echo 1;
            $config = require 'app/config/db.php';
            $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].';charset=UTF8', $config['user'], $config['password']);
//            echo 2;
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo 3;
        } catch (PDOException $e){
            header('Location: app/config/setup.php');
            exit($e->getMessage());
        }
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

    }

    public function row($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function insertto($sql){
        try {
            $this->db->exec($sql);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

}