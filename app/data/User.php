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

    public static function getUsers(string $filter, string $type) {
        $db = new DbManager();
        if ($filter != null && !empty($filter)) {
            return $db->select('user',
                "(username LIKE '%$filter%'
                OR name LIKE '%$filter%'
                OR email LIKE '%$filter%')
                AND type='$type'");
        }
        return $db->select(
            'user',
            "type='$type'");
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

    public static function updateUser($id, $username, $password, $type, $email, $active, $name)
    {
        $db = new DbManager();
        $username = $db->conn->quote($username);
        $type = $db->conn->quote($type);
        $email = $db->conn->quote($email);
        $name = $db->conn->quote($name);

        $table_name = 'user';

        $password_sql = '';
        if ($password != null && !empty($password)) {
            $password = $db->conn->quote($password);
            $password_sql = ", password=$password";
        }
        
        $sql = "
            UPDATE
                $table_name
            SET
                username=$username,
                type=$type,
                email=$email,
                active=$active,
                name=$name
                $password_sql
            WHERE
                id='$id'";

        return $db->exec($sql);
    }
}
