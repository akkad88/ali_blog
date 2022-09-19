<?php
class Blog {
    function __construct()
    {
        if(!User::is_logged()):
            die();
        endif;
    }

    public static function getBlog($id)
    {
        $con = DB::getConnection();
        $query = $con->prepare("SELECT * FROM `posts` WHERE post_id = '{$id}' LIMIT 1");
        $query->execute();
        if($query->rowCount()):
            $fetch = $query->fetch(PDO::FETCH_ASSOC);
            return $fetch;
        endif;
    }
    public static function add_new()
    {
        if(isset($_POST['add_post'])):
            $con = DB::getConnection();
            $images = ['post_thumbnail', 'post_image'];
            $inputs = array('post_title', 'post_content', 'post_thumbnail',	'post_image',	'author_id'   );
            $data = array();
            $insert_query = "INSERT INTO `posts` (";
            $paramquery = '(';
            foreach( $inputs as $input ):
                $value = '';
                if( isset($_POST[$input]) || isset($_FILES[$input]) ):
                    if(in_array($input, $images) ):
                        $value = Filter::File($input);
                        if(!empty($value) && strlen($value) > 3):
                            Helper::uploadFile($input, '../images/'.$value);
                        endif;
                    else:
                        // if post content make it the filter with HTML, check the filters.php
                        if($input == 'post_content'){
                            $value = Filter::String($_POST[$input], true);
                        } else {
                            $value = Filter::String($_POST[$input]);
                        }
                    endif;
                endif;
                $data[$input] = $value;
                $insert_query .= ' `'.$input.'`, ';  
                $paramquery .= " '{$value}', ";
            endforeach;
    
    
            $insert_query = substr($insert_query, 0, strlen($insert_query)-2);
            $paramquery = substr($paramquery, 0, strlen($paramquery)-2);
            $insert_query .= ')';
            $paramquery .= ')';
    
            $all_query = $insert_query . ' VALUES ' . $paramquery;

            $insert_post = $con->prepare($all_query);

    
            $insert_post->execute();
            $inserted_id = $con->lastInsertId();
            
            echo '<div class="alert bg bg-success"><p class="text-white">Your Post has Added</p> <a class="text-white" href="edit_post.php?action=edit&id='.$inserted_id.'"> Edit Here </a></div>';
            
        endif;
    }
    public static function edit_post($id)
    {
        if(isset($_POST['update_post'])):
        $con = DB::getConnection();
        $images = ['post_thumbnail', 'post_image'];
        $inputs = array('post_title', 'post_content', 'post_thumbnail',
                        'post_image','author_id' );
        $data = array();
        $insert_query = "UPDATE `posts` SET ";
        $paramquery = '';
        foreach( $inputs as $input ):
            $value = '';
            if( isset($_POST[$input]) || isset($_FILES[$input]) ):
                if(in_array($input, $images) ):
                    $value = Filter::File($input);
                    if(!empty($value) && strlen($value) > 3):
                        Helper::uploadFile($input, '../images/'.$value);
                    else:
                        
                    endif;
                    echo $value;    
                else:
                    if($input == 'post_content'){
                        $value = Filter::String($_POST[$input],$html = true);
                    }else{
                    $value = Filter::String($_POST[$input]);
                }
                endif;
            endif;
            $insert_query .= ' `'.$input .'`'.'=' ."'{$value}'" .', '; 
        endforeach;
        $insert_query = substr($insert_query, 0, strlen($insert_query)-2); 
        $all_query = $insert_query . ' WHERE ' . '`post_id`=' . $id ;
        $insert_post = $con->prepare($all_query);
        $insert_post->execute();
        /* header("Location: http://localhost/ali_blog/blog/admin/posts.php"); */
    endif;
    }     

    public static function Dlete_post($id)
    {
        if(isset($_GET['action'])):
        $con = DB::getConnection();
        /* DELETE FROM `cm_employee_courses` WHERE `employee_id` = 1; */
        $insert_query = "DELETE FROM `posts` WHERE `post_id`=";
        $all_query = $insert_query . $id;
        $delet_post = $con->prepare($all_query);
        echo $all_query;
        $delet_post->execute();
        endif;
    } 
}