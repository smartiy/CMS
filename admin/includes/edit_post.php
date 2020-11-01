<?php
if(isset($_GET['p_id'])) {
    $get_id = $_GET['p_id'];
    
    $query = "SELECT * FROM posts WHERE post_id = $get_id";
    $select_post_id = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_post_id)) {
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_category_id = $row['post_category_id'];        
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_date = $row['post_date'];
        $post_comment_count = $row['post_comment_count'];
        }
    }
?>
<?php
if(isset($_POST['edit_post'])) {

    $change_author = $_POST['post_author'];
    $change_title = $_POST['post_title'];
    $change_category_id = $_POST['post_category'];
    $change_status = $_POST['post_status'];
    $change_image = $_FILES['image']['name'];
    $change_image_temp = $_FILES['image']['tmp_name'];
    $change_content = $_POST['post_content'];
    $change_tags = $_POST['post_tags'];
        
    move_uploaded_file($change_image_temp, "../images/$change_image" );
    
    if(empty($change_image)) {
        
        $query = "SELECT * FROM posts WHERE post_id = $get_id";
        $select_image = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_array($select_image)) {
            $change_image = $row['post_image'];
            
        }
    }
  
//        $post_image = $row['image']['name'];
//        $post_image_temp = $row['image']['tmp_name'];

    $update_query = "UPDATE posts SET post_title = '{$change_title}', post_category_id = '{$change_category_id}', post_date = now(), post_author = '{$change_author}', post_status = '{$change_status}', post_tags = '{$change_tags}', post_content = '{$change_content}', post_image = '{$change_image}' WHERE post_id = {$get_id} ";
    
//    $update_query = "UPDATE posts SET ";
//    $update_query .= "post_title = '{$change_title}', ";
//    $update_query .= "post_category_id = '{$change_category_id}', ";
//    $update_query .= "post_date = now(), ";
//    $update_query .= "post_author = '{$change_author}', ";
//    $update_query .= "post_status = '{$change_status}', ";
//    $update_query .= "post_tags = '{$change_tags}', ";
//    $update_query .= "post_content = '{$change_content}', "; 
//    $update_query .= "post_image = '{$change_image}' ";
//    $update_query .= "WHERE post_id = {$get_id} ";

    $update_post = mysqli_query($connection, $update_query);
//    header("Location: posts.php"); exit;
//    header("Location: http://localhost/cms/admin/posts.php?source=edit_post&p_id=$get_id");
    
//    if(!$update_post) {
//            echo ("QUERY FAILED");
//    } else {
//            echo "QUERY GREAT";
//        }
    
//    header("Location: posts.php?source=edit_post&p_id=$get_id");
    echo "<p class='bg-succes'>Post Updated. <a href='../post.php?p_id=$get_id'>View Post</a> or <a href='./posts.php'>Edit more posts</a>";
    
}
?>

<form action="" method="post" enctype="multipart/form-data">
<!--ta enctype je za uploadanja slik-->
   
   <div class="form-group">
       <label for="title">Post Title</label>
       <input value="<?php if(isset($post_author)){echo $post_title;}?>" type="text" class="form-control" name="post_title">
    </div>
    
   <div class="form-group">
      <select name="post_category" id="post_category"><?php 
          

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $the_cat_id = $row['cat_id'];
        $the_cat_title = $row['cat_title'];
        
        if($the_cat_id == $post_category_id) {
        
        echo "<option selected value='{$the_cat_id}'>{$the_cat_title}</option>";    
        
        } else {
        
        echo "<option value='{$the_cat_id}'>{$the_cat_title}</option>";
        }
        
        
    }
            
                ?>
      </select>

    </div>
    
   <div class="form-group">
       <label for="title">Post Author</label>
       <input value="<?php echo $post_author;?>" type="text" class="form-control" name="post_author">
    </div>
    
<div class="form-group">
     
      <select name="post_status" id="post_status">   
   
       <option value="post_status"><?php echo $post_status; ?></option>
        <?php

         if ($post_status == 'published') {
             echo "<option value='draft'>draft</option>";
         } elseif ($post_status == 'draft') {
             echo "<option value='published'>published</option>";
         } 
          
          ?>
   
   
    </select>
    
</div>

    
<!--
   <div class="form-group">
       <label for="post_status">Post Status</label>
       <input value="<?php echo $post_status;?>" type="text" class="form-control" name="post_status">
    </div>
-->
    
   <div class="form-group">
<!--       <label for="post_image">Post image</label>-->
       <img width='100' src="../images/<?php echo $post_image; ?>" alt="">
       <input type="file" name="image">
    </div>
    
   <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
    </div>
    
   <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php $new_string = str_replace('\r\n', '</br>', $post_content); echo strip_tags($new_string, '<br>');?></textarea>
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
<!--        create_post je isto kot submit pri ostalih-->
    </div>
    
</form>

