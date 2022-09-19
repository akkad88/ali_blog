<?php
class User {
    function __construct()
    {

    }

    public static function getUsers()
    {
        $con = DB::getConnection();
        $query = $con->prepare("SELECT * FROM `users` WHERE `user_status` != 0");
        $query->execute();
        if($query->rowCount()):
            $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
            return $fetch;
        endif;

    }
    public static function is_logged()
    {
        $logged = false;

        if(!isset($_SESSION['user'])):
            $logged = false;
        else:
            $user_id = Filter::Int($_SESSION['user']);
            $con = DB::getConnection();
            $query = $con->prepare("SELECT user_email FROM `users` WHERE user_id = :user_id LIMIT 1");
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute();
            if($query->rowCount()):
                $logged = true;
            endif;
        endif;
        return $logged;
    }
}