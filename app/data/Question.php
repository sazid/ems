<?php
require_once('db.php');

class Question {
    public static function getQuestionById(number $id) {
        $db = new DbManager();
        return $db->select('question', "id='$id'");
    }
    
    public static function getQuestions(string $filter) {
        $db = new DbManager();
        if ($filter != null && !empty($filter)) {
            return $db->select('question', "title LIKE '%$filter%' OR type LIKE '%$filter'");
        }
        return $db->select('question');
    }

    public static function getQuestionsForCourse($id) {
        $db = new DbManager();
        return $db->select('question', "course_id='$id'");
    }

    public static function getQuestionsForExam($exam_id) {
        $db = new DbManager();

        $sql = "SELECT * FROM question WHERE id in (SELECT question_id FROM question_set WHERE exam_id='$exam_id')";

        return $db->query($sql);
    }

    public static function insertQuestion($title, $type, $mcq_options, $course_id) {
        try {
            $db = new DbManager();
            $title = $db->conn->quote($title);

            $table_name = 'question';
            $column_str = "title, type, course_id";
            $values_str = "$title, '$type', '$course_id'";
            $sql = "INSERT INTO $table_name ($column_str) VALUES ($values_str)";

            $db->exec($sql);
            $last_insert_id = $db->getLastInsertId();

            foreach($mcq_options as $option) {
                $sql = "INSERT INTO answer (value, question_id) VALUES ('$option', '$last_insert_id')";
                $db->exec($sql);
            }
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }

        return true;
    }

    public static function updateQuestion($id, $title, $type, $mcq_options, $course_id) {
        try {
            $db = new DbManager();
            $title = $db->conn->quote($title);

            $table_name = 'question';

            $sql = "
                UPDATE
                    $table_name
                SET
                    title=$title,
                    type='$type',
                    course_id='$course_id'
                WHERE
                    id='$id'";

            $db->exec($sql);

            $sql = "DELETE FROM answer WHERE question_id='$id'";
            $db->exec($sql);
            
            foreach ($mcq_options as $option) {
                $sql = "INSERT INTO answer (value, question_id) VALUES ('$option', '$id')";
                $db->exec($sql);
            }
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }

        return true;
    }

    public static function getLastInsertId() {
        $db = new DbManager();
        return $db->getLastInsertId();
    }
}
