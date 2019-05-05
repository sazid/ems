<?php
require_once('db.php');

class Exam {
    public static function getExamById($id) {
        $db = new DbManager();
        return $db->select('exam', "id='$id'");
    }
    
    public static function getExams(string $filter) {
        $db = new DbManager();
        if ($filter != null && !empty($filter)) {
            return $db->select('exam', "(name LIKE '%$filter%')");
        }
        return $db->select('exam');
    }

    public static function getExamsForUser(string $filter, $user_id) {
        $db = new DbManager();

        $sql = "SELECT * FROM exam WHERE course_id in (SELECT course_id FROM user_course_map WHERE user_id='$user_id')";        
        
        if ($filter != null && !empty($filter)) {
            $sql .= " AND (name LIKE '%$filter%')";
        }

        return $db->query($sql);
    }

    public static function getUsersForExam($id) {
        $db = new DbManager();
        return $db->select('user_course_map', "course_id='$id'");
    }

    public static function updateQuestions($id, $questions) {
        $db = new DbManager();
        
        try {
            // Delete previous entries first
            $sql = "DELETE FROM question_set WHERE exam_id='$id'";
            $db->exec($sql);

            foreach($questions as $question) {
                $sql = "INSERT INTO question_set (exam_id, question_id) VALUES ('$id', '{$question['id']}')";
                $db->exec($sql);
            }
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }

        return true;
    }

    public static function deleteExam($id) {
        try {
            $db = new DbManager();

            $db->delete('question_set', "exam_id='$id'");
            $db->delete('exam', "id='$id'");
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }

        return true;
    }

    public static function insertExam($name, $start, $end, $course_id, $questions) {
        try {
            $db = new DbManager();
            $name = $db->conn->quote($name);
            
            $table_name = 'exam';
            $column_str = "name, start, end, course_id";
            $values_str = "$name, '$start', '$end', '$course_id'";
            $sql = "INSERT INTO $table_name ($column_str) VALUES ($values_str)";

            $db->exec($sql);
            $last_insert_id = $db->getLastInsertId();

            foreach ($questions as $question) {
                $sql = "INSERT INTO question_set (exam_id, question_id) VALUES ('$last_insert_id', '{$question['id']}')";
                $db->exec($sql);
            }
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }
        
        return true;
    }

    public static function updateExam($id, $name, $start, $end, $course_id) {
        $db = new DbManager();
        $name = $db->conn->quote($name);

        $table_name = 'exam';

        $sql = "
            UPDATE
                $table_name
            SET
                name=$name,
                start='$start',
                end='$end',
                course_id='$course_id'
            WHERE
                id='$id'";

        return $db->exec($sql);
    }

    public static function getLastInsertId() {
        $db = new DbManager();
        return $db->getLastInsertId();
    }
}
