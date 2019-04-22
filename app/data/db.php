<?php

class DbManager {
    var $username;
    var $password;
    var $host;
    var $db_name;
    var $conn;

    function __construct(
        string $host = 'localhost',
        string $username = 'root',
        string $password = '',
        string $db_name = 'ems'
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->db_name = $db_name;

        $this->conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function __destruct() {
        $this->conn = null;
    }

    // Return PDOStaetment or FALSE on failure
    function query(string $sql) {
        return $this->conn->query($sql, PDO::FETCH_ASSOC);
    }

    // Return number of affected rows
    function exec(string $sql) {
        return $this->conn->exec($sql);
    }

    // Select * from a given table name
    function select(string $table_name, string $where_query = null) {
        $sql = "SELECT * FROM $table_name";
        if ($where_query != null)
            $sql .= " WHERE $where_query";
        
        return $this->query($sql);
    }

    // Delete all rows matching the where query for the given table
    function delete(string $table_name, string $where_query = null) {
        $sql = "DELETE FROM $table_name";
        if ($where_query != null)
            $sql .= " WHERE $where_query";
        return $this->exec($sql);
    }
}
