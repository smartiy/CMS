<?php

//echo $_POST['title'];

if(isset($_POST['create_post'])) {
    
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];

    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;
        
    move_uploaded_file($post_image_temp, "../images/$post_image" );
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";

    $query .= "VALUES('{$post_category_id}','{$post_title}', '{$post_author}',now() ,'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}')";
    $create_post_query = mysqli_query($connection, $query);
    
    $the_post_id = mysqli_insert_id($connection);
//    ta funkcija si zapomni zadnji ustvarjen id
    echo "<p class='bg-succes'>Post Created. <a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='./posts.php'>Edit more posts</a>";
    
    
}

//    $create_post_query = mysqli_query($connection, $query);
//
//confirm($create_post_query);

?>


<form action="" method="post" enctype="multipart/form-data">
<!--ta enctype je za uploadanja slik-->
   
   <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="post_title">
    </div>
    
   <div class="form-group">
      <select name="post_category" id="post_category"><?php 
          

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $the_cat_id = $row['cat_id'];
        $the_cat_title = $row['cat_title'];

        echo "<option value='{$the_cat_id}'>{$the_cat_title}</option>";
        
    }
            
                ?>
      </select>

    </div>
    
   <div class="form-group">
       <label for="title">Post Author</label>
       <input type="text" class="form-control" name="post_author">
    </div>
    
   <div class="form-group">
    <select name="post_status" id="">
        <option value="draft">Select Options</option>
        <option value="published">Published</option>
        <option value="draft">Draft</option>
    </select>
    </div>    
    
   <div class="form-group">
       <label for="post_image">Post image</label>
       <input type="file" name="image">
    </div>
    
   <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input type="text" class="form-control" name="post_tags">
    </div>
    
   <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
<!--
        <script>
        ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
-->
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
<!--        create_post je isto kot submit pri ostalih-->
    </div>
    
</form>