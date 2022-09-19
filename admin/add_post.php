<?php define('__ADMIN__', true); require_once('inc/header.php'); //echo '<pre>'; print_r($_SERVER); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>


<h2 class="mb-4">Add Post</h2>

<!-- post_title	post_content	post_thumbnail	post_image	author_id -->
        
<div class="row">
    <div class="col-md-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <?php Blog::add_new(); ?>
            <div class="form-group">
                <label for="post_title" class="control-form">Post Title</label>
                <input type="text" class="form-control" name="post_title" placeholder="Post Title" required="required">
            </div>

            <div class="form-group">
                <label for="post_thumbnail" class="control-form">Post Thumbnail</label>
                <input type="file" class="form-control" name="post_thumbnail">
            </div>

            <div class="form-group">
                <label for="post_image" class="control-form">Post Image</label>
                <input type="file" class="form-control" name="post_image">
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

                    foreach($users as $user){
                        echo '<option value="'.$user['user_id'].'">'.$user['user_email'].'</option>';
                    }

                    echo '</select>';
                endif;
                ?>
                

                
            </div>


            <div class="form-group">
                <label for="post_content" class="control-form">Post Thumbnail</label>
                <textarea name="post_content" id="editor"></textarea>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="add_post" value="Add">
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

<?php require_once('inc/footer.php'); ?>
