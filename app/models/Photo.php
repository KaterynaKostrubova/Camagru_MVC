<?php

namespace app\models;

use app\core\Model;

class Photo extends Model {

    public function getFilters(){
        return  $this->db->row("SELECT path FROM filters ORDER BY id DESC;");
    }

    public function addPhoto($path, $user_id, $name, $description){
        return $this->db->insertto("INSERT INTO photos (path, user_id, name, description) VALUE ('$path', '$user_id', '$name', '$description');");
    }

    public function getUserData($user){
        return $this->db->row("SELECT * FROM users WHERE login='$user';");
    }

    public function getEditedPhotos($id){
        return $this->db->row("SELECT * FROM photos WHERE user_id='$id';");
    }

    public function getIdPhoto($path){
        return $this->db->row("SELECT id FROM photos WHERE path='$path';");
    }

    public function delImage($id){
        return $this->db->delete("DELETE FROM photos WHERE id='$id';");
    }

    public function getNameImage($id)
    {
        return $this->db->row("SELECT path FROM photos WHERE id='$id';");
    }

    public function changeAvatar($photo_id, $id){
            $this->db->insertto("UPDATE users SET photo_id= '$photo_id' WHERE id = '$id';");

    }

    public function changeBg($bg_id, $id){
        return $this->db->insertto("UPDATE users SET bg_id= '$bg_id' WHERE id = '$id';");
    }

    function addLike($photo_id, $user_id){
        return $this->db->insertto("INSERT INTO likes (photo_id, user_id) VALUE ('$photo_id', '$user_id');");
    }

    function removeLike($photo_id, $user_id){
        return $this->db->query("DELETE FROM likes WHERE photo_id='$photo_id' AND user_id='$user_id';");
    }

//    function getLikes($id){
//        return $this->db->row("SELECT photo_id FROM likes WHERE user_id='$id';");
//    }
    function isMyLike($photo_id, $user_id){
        return $this->db->row("SELECT id FROM likes WHERE photo_id='$photo_id' AND user_id='$user_id';");
    }

    function getLikes($photo_id){
        return $this->db->row("SELECT * FROM likes WHERE photo_id='$photo_id';");
    }

//    function getComments(){
//        return $this->db->row("SELECT c.text, p.id, u.login  FROM comments c JOIN photos p ON c.photo_id = p.id JOIN users u ON c.user_id = u.id;");
//    }
    function getComments($id){
        return $this->db->row("SELECT c.text, c.user_id  FROM comments c WHERE photo_id='$id';");
    }

    function addComments($photo_id, $user_id, $text){
        return $this->db->insertto("INSERT INTO comments (photo_id, user_id, text) VALUE ('$photo_id', '$user_id', '$text');");
    }

    public function getPictureData($id)
    {
        return $this->db->row("SELECT path, user_id FROM photos WHERE id='$id';");
    }

    public function getOwnerInfo($id){
            return $this->db->row("SELECT photo_id, login FROM users WHERE id='$id';");
    }

//    public function getLogin($id){
//        return $this->db->row("SELECT login FROM users WHERE id='$id';");
//    }
}
