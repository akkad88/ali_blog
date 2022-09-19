<?php define('__ADMIN__', true); require_once('inc/header.php'); ?>
<div class="table-responsive-lg d-flex justify-content-center">
<table class="table table-bordered">
	<thead>
		<tr>
			<th  scope="col" >post_title</th>
			<th  scope="col" >post_content</th>
			<th  scope="col" >post_thumbnail</th>
                        <th  scope="col" >post_image</th>
                        <th  scope="col" >author_id</th>
			<th  scope="col" >post_added</th>
			<th  scope="col" >post_modified</th>
		</tr>
	</thead>
	
		
                <?php 
                $con = DB::getConnection();
                $all_query = "SELECT * FROM posts";
                $show_post = $con->prepare($all_query);
                $show_post->execute();
                $fetch = $show_post->fetchAll(PDO::FETCH_ASSOC);
                $i=0;
                while($i <= $show_post->rowCount()-1):
/*                         echo "<pre> 4";
                        print_r($fetch);
                        echo "</pre>";  */?>
                        <tr>
                        <td><?php echo $fetch[$i]['post_title']; ?></td>
			<td><?php echo $fetch[$i]['post_content']; ?></td>
                        <td><?php echo $fetch[$i]['post_thumbnail']; ?></td>
			<td><?php echo $fetch[$i]['post_image']; ?></td>
                        <td><?php echo $fetch[$i]['author_id']; ?></td>
			<td><?php echo $fetch[$i]['post_added']; ?></td>
                        <td><?php echo $fetch[$i]['post_modified']; ?></td>
			<td>
				<a class="btn btn-primary" href="edit_post.php?action=edit&id=<?php echo $fetch[$i]['post_id']; ?>" >Edit</a>
                               <?php Blog::getBlog($fetch[$i]['post_id']);?>
                        </td>
			<td>
				<a class="btn btn-danger" href="edit_post.php?action=delete&id=<?php echo $fetch[$i]['post_id']; ?>">Delete</a>
                        </td>
                        <?php $i++;?>
                        </tr>
                    
                    <?php
                    endwhile;?> 
 
</table>
</div>
<form>   
 
<?php require_once('inc/footer.php'); ?>
