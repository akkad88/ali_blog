<?php
 (!defined('__ADMIN__')) ? die: '';
 $id = isset($_GET['id']) ? Filter::Int($_GET['id']) : false;

$blog = is_numeric($id) ? Blog::getBlog($id) : false;

echo is_array($blog) ? '' : 'No Post Found';

is_array($blog) ? '' : die;
        if(isset($_GET['action'])):
            Blog::Dlete_post($_GET['id']);

            /*                echo("<script>location.loction = "."/posts.php';</script>");
            */                
        endif;
        header("Location: http://localhost/ali_blog/blog/admin/posts.php");
?>