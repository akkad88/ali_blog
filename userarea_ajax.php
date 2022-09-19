<?php 

$return = array();
require_once('inc/config.php');
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password']) ):

    if(empty($_POST['email']) || empty($_POST['password']) ):
        die;
    endif;

    $email = Filter::Email($_POST['email']);
    $password = Filter::Email($_POST['password']);

    $con = DB::getConnection();

    $query = $con->prepare("SELECT * FROM `users` WHERE `user_email` = :email LIMIT 1");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
   
    if( $query->rowCount() ) {
        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        if(/* password_verify($password,$fetch['user_password']) */
            $password == $fetch['user_password'] ){
            
            session_destroy();
            session_start();
            $_SESSION['user'] = $fetch['user_id'];
            $return['success'] = 1;
            $return['url'] = 'http://'. $_SERVER['SERVER_NAME'] . '/ali_blog/blog/admin/';
        } else {
            $return['error'] = 1;
            $return['message'] = 'E-mail/Password Error';
        }
    } else {
        $return['error'] = 1;
        $return['message'] = 'No E-mail matched in our system';
    }

    echo json_encode($return);
endif;