<?php (!defined('__ADMIN__')) ? die: '';  
$id = isset($_GET['id']) ? Filter::Int($_GET['id']) : false;

$blog = is_numeric($id) ? Blog::getBlog($id) : false;

echo is_array($blog) ? '' : 'No Post Found';

is_array($blog) ? '' : die;

// echo "<pre>";

// print_r($blog);
?>
<h2 class="mb-4">Edit Post</h2>

<!-- post_title	post_content	post_thumbnail	post_image	author_id -->
        
<div class="row">
    <div class="col-md-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <?php Blog::edit_post($id); ?>
            <div class="form-group">
                <label for="post_title" class="control-form">Post Title</label>
                <input type="text" class="form-control" value="<?php echo $blog['post_title']; ?>" name="post_title" placeholder="Post Title" required="required">
            </div>

            <div class="form-group">
                <label for="post_thumbnail" class="control-form">Post Thumbnail</label>
                <input type="file"class="form-control" name="post_thumbnail" /> <span name="old" value="<?=$blog['post_thumbnail']?>"><?php echo $blog['post_thumbnail']?></span>
                <!-- <input type="file" class="form-control" name="post_thumbnail"> -->
            </div>

            <div class="form-group">
                <label for="post_image" class="control-form">Post Image</label>
                <input type="file"class="form-control" name="post_image" /> <span name="old" value="<?=$blog['post_image']?>"><?php echo $blog['post_image']?></span>
                <!-- <input type="file" class="form-control" name="post_image"> -->
            </div>

            <div class="form-group">
                <label for="author_id" class="control-form">Author id</label>
                <?php
                $users = User::getUsers();
                if(!empty($users)  ):
                    echo '
                    <select class="form-control" name="author_id">
                    <option>--- Chose author ---</option>
                    ';
                    $author_id = $blog['author_id'];
                    foreach($users as $user){
                        $selected = '';
                        if($author_id == $user['user_id']):
                            $selected = ' selected="selected" ';
                        endif;
                        echo '<option value="'.$user['user_id'].'" '.$selected.'>'.$user['user_email'].'</option>';
                    }

                    echo '</select>';
                endif;
                ?>
                

                
            </div>


            <div class="form-group">
                <label for="post_thumbnail" class="control-form">Post Thumbnail</label>
                <textarea name="post_content" id="editor"><?php echo $blog['post_content']; ?></textarea>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_post" value="Update">
            </div>
        </form>
    </div>
</div>

<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
