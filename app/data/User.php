<?php
require_once('db.php');

class User {
    public static function getUserByUsername(string $username) {
        $db = new DbManager();
        return $db->select('user', "username='$username'");
    }
    
    public static function getUserByUsernamePassword(string $username, string $password) {
        $db = new DbManager();
        return $db->select('user', "username='$username' AND password='$password'");
    }

    public static function getUsers(string $filter = null) {
        $db = new DbManager();
        if ($filter != null) {
            return $db->select('user',
                "username LIKE '%$filter%'
                OR name LIKE '%$filter%'
                OR email LIKE '%$filter%'");
        }
        return $db->select('user');
    }
}
