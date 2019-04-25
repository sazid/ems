<?php
require_once('db.php');

class User {
    public static function getUserByUsername(string $username) {
        $db = new DbManager();
        return $db->select('user', "username='$username'");
    }
    
    public static function getUserByUsernamePassword(string $username, string $password) {
        $db = new DbManager();
        return $db->select('user', "username='$username' AND password='$password' AND active='1'");
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

    public static function insertUser($username, $password, $type, $email, $active, $name) {
        $db = new DbManager();
        $username = $db->conn->quote($username);
        $password = $db->conn->quote($password);
        $type = $db->conn->quote($type);
        $email = $db->conn->quote($email);
        $name = $db->conn->quote($name);
        
        $table_name = 'user';
        $column_str = "username, password, type, email, active, name";
        $values_str = "$username, $password, $type, $email, $active, $name";
        $sql = "INSERT INTO $table_name ($column_str) VALUES ($values_str)";

        return $db->exec($sql);
    }
}
