<?php
require_once('db.php');

class Course {
    public static function getCourseById(number $id) {
        $db = new DbManager();
        return $db->select('course', "id='$id'");
    }
    
    public static function getCourses(string $filter) {
        $db = new DbManager();
        if ($filter != null && !empty($filter)) {
            return $db->select('user',
                "(name LIKE '%$filter%'
                OR code LIKE '%$filter%'");
        }
        return $db->select('course');
    }

    public static function getUsersForCourse($id) {
        $db = new DbManager();
        return $db->select('user_course_map', "course_id='$id'");
    }

    public static function updateUsers($id, $users) {
        $db = new DbManager();
        
        try {
            // Delete previous entries first
            $sql = "DELETE FROM user_course_map WHERE course_id='$id'";
            $db->exec($sql);

            foreach($users as $user) {
                $sql = "INSERT INTO user_course_map(user_id, course_id) VALUES ('{$user['id']}', '$id')";
                $db->exec($sql);
            }
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }

        return true;
    }

    public static function insertCourse($name, $code, $active) {
        $db = new DbManager();
        $name = $db->conn->quote($name);
        $code = $db->conn->quote($code);
        
        $table_name = 'course';
        $column_str = "name, code, active";
        $values_str = "$name, $code, $active";
        $sql = "INSERT INTO $table_name ($column_str) VALUES ($values_str)";

        $result = $db->exec($sql);
        $last_insert_id = $db->getLastInsertId();
        return [
            "result" => $result,
            "last_insert_id" => $last_insert_id
        ];
    }

    public static function updateCourse($id, $name, $code, $active) {
        $db = new DbManager();
        $name = $db->conn->quote($name);
        $code = $db->conn->quote($code);

        $table_name = 'course';

        $sql = "
            UPDATE
                $table_name
            SET
                name=$name,
                code=$code,
                active=$active
            WHERE
                id='$id'";

        return $db->exec($sql);
    }

    public static function getLastInsertId() {
        $db = new DbManager();
        return $db->getLastInsertId();
    }
}
