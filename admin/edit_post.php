<?php define('__ADMIN__', true); require_once('inc/header.php'); //echo '<pre>'; print_r($_SERVER); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>

<?php 
if(isset($_GET['action'])):
    echo $_GET['action'];
    switch($_GET['action']){
        case 'edit':
            include_once('template-parts/edit_post.php');
            break;
        case 'delete':
            include_once('template-parts/delete.php');
            break;
        case 'status':
            break;
    }
endif;
?>
<?php require_once('inc/footer.php'); ?>
