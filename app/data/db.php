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

    // Select columns from a given table name
    function selectCols(string $table_name, string $column_str, string $where_query = null) {
        $sql = "SELECT $column_str FROM $table_name";
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

    // Returns a comma-separated string from an array
    // If $arr is for column names, set $column_name = true
    function commaSeparatedString(array $arr, bool $column_name = false) : string {
        $str = "";
        for ($i = 0; $i < count($arr); ++$i) {
            if (!$column_name)
                $arr[$i] = $this->conn->quote($arr[$i]);
            
            if ($i == count($arr) - 1)
                $str .= "{$arr[$i]}";
            else
                $str .= "{$arr[$i]}, ";
        }
        return $str;
    }

    function insert(string $table_name, array $column_names, array $column_values) {
        $column_str = $this->commaSeparatedString($column_names, true);
        $values_str = $this->commaSeparatedString($column_values);

        $sql = "INSERT INTO $table_name ($column_str) VALUES ($values_str)";

        return $this->exec($sql);
    }
}
