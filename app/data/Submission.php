<?php
require_once('db.php');

class Submission
{
    public static function getSubmissionById(number $id)
    {
        $db = new DbManager();
        return $db->select('submission', "id='$id'");
    }

    public static function getSubmissions()
    {
        $db = new DbManager();
        return $db->select('submission');
    }

    public static function getSubmissionsForExam($exam_id)
    {
        $db = new DbManager();
        return $db->select('submission', "exam_id='$exam_id'");
    }

    public static function getSubmissionsForUser($user_id)
    {
        $db = new DbManager();
        return $db->select('submission', "user_id='$user_id'");
    }

    public static function insertSubmission($type, $value, $submission_time, $user_id, $question_id, $exam_id)
    {
        try {
            $db = new DbManager();

            $table_name = 'submission';
            $column_str = "type, value, submission_time, user_id, question_id, exam_id";
            $values_str = "'$type', '$value', '$submission_time', '$user_id', '$question_id', '$exam_id'";
            $sql = "INSERT INTO $table_name ($column_str) VALUES ($values_str)";

            $db->exec($sql);
            $db->getLastInsertId();
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }

        return true;
    }

    public static function updateSubmission($id, $type, $value, $submission_time, $user_id, $question_id, $exam_id)
    {
        try {
            $db = new DbManager();

            $table_name = 'submission';

            $sql = "
                UPDATE
                    $table_name
                SET
                    type=$type,
                    value='$value',
                    submission_time='$submission_time',
                    user_id='$user_id',
                    question_id='$question_id',
                    exam_id='$exam_id'
                WHERE
                    id='$id'";

            $db->exec($sql);
        } catch (PDOException $exc) {
            echo $exc;
            return false;
        }

        return true;
    }

    public static function getLastInsertId()
    {
        $db = new DbManager();
        return $db->getLastInsertId();
    }
}
