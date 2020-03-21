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

    function getComments($id){
        return $this->db->row("SELECT c.photo_id, c.text, u.login 
                                    FROM comments c 
                                    JOIN users u 
                                    ON (u.id = c.user_id)
                                    AND c.photo_id = '$id' 
                                    ;");
    }

    public function deleteLikes($id){
        return $this->db->delete("DELETE FROM likes WHERE photo_id='$id';");
    }

    public function deleteComments($id){
        return $this->db->delete("DELETE FROM comments WHERE photo_id='$id';");
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

    public function getNotification($id){
        $result = $this->db->row("SELECT u.notification, p.user_id FROM users u JOIN photos p ON u.id = p.user_id AND p.id ='$id' ");
        return $result;
    }

    public function checkAvatar($id){
        $result = $this->db->row("SELECT u.photo_id, p.user_id, p.path FROM users u JOIN photos p ON u.id = p.user_id AND u.photo_id ='$id'");
        return $result;
    }

    public function checkBg($id){
        $result = $this->db->row("SELECT u.bg_id, p.user_id, p.path FROM users u JOIN photos p ON u.id = p.user_id AND u.bg_id ='$id'");
        return $result;
    }

    function getUsersPartPhotos($i, $n, $id){
        return  $this->db->row("SELECT p.id, p.path FROM photos p WHERE user_id=$id ORDER BY creation DESC LIMIT $n OFFSET $i");
    }

    function getUserPhotosNumber($id){
        return  $this->db->column("SELECT COUNT(id) as num FROM photos WHERE user_id=$id;");
    }


}
