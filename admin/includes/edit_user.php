<?php

//echo $_POST['title'];

if(isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $the_user_id";
        $select_users_query = mysqli_query($connection, $query);


        while ($row = mysqli_fetch_assoc($select_users_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
}

if(isset($_POST['edit_user'])) {


    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 12));
    $post_date = date('d-m-y');
//    $post_comment_count = 4;
        
    move_uploaded_file($post_image_temp, "../images/$post_image" );
    
    if(!empty($user_password)) {
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
        $get_user_query = mysqli_query($connection, $query_password);
        confirmQUery($get_user_query);
        
        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];
    }
    
    if($db_user_password != $user_password) {
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    }
    
//    $query = "SELECT randSalt FROM users";
//    $select_randsalt_query = mysqli_query($connection, $query);
//    if(!$select_randsalt_query) {
//        die("Query Failed" . mysqli_error($connection));
//    }
//    
//    $row = mysqli_fetch_array($select_randsalt_query)
//    $salt = $row['randSalt'];
//    $hashed_password = = crypt($password, $salt);
    
    
    $update_query = "UPDATE users SET ";
    $update_query .= "user_firstname = '{$user_firstname}', ";
    $update_query .= "user_lastname = '{$user_lastname}', ";
//    $update_query .= "post_date = now(), ";
    $update_query .= "user_role = '{$user_role}', ";
    $update_query .= "username = '{$username}', ";
    $update_query .= "user_email = '{$user_email}', ";
    $update_query .= "user_password = '{$hashed_password}' "; 
//    $update_query .= "post_image = '{$change_image}' ";
    $update_query .= "WHERE user_id = {$the_user_id} ";
    $edit_user_query = mysqli_query($connection, $update_query);
}
    echo 'user updated';

//    confirm($create_user_query);

?>


<form action="" method="post" enctype="multipart/form-data">
<!--ta enctype je za uploadanja slik-->
   
    <div class="form-group">
       <label for="title">Firstname</label>
       <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    
   <div class="form-group">
       <label for="post_status">Lastname</label>
       <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    
   <div class="form-group">
     
      <select name="user_role" id="post_category"> 
      
   
          
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        <?php

         if ($user_role == 'admin') {
             echo "<option value='subscriber'>subscriber</option>";
         } elseif ($user_role == 'subscriber') {
             echo "<option value='admin'>admin</option>";
         }
          
          ?>
          
<!--
       <option value='subscriber'>Select options</option>
        <option value='admin'>admin</option>
        <option value='subscriber'>subscriber</option>
-->

    }

      </select>
    
    </div>
   
    
<!--
   <div class="form-group">
       <label for="post_image">Post image</label>
       <input type="file" name="image">
    </div>
-->
    
   <div class="form-group">
       <label for="post_tags">Username</label>
       <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    
   <div class="form-group">
       <label for="post_content">Email</label>
       <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    
   <div class="form-group">
       <label for="post_content">Password</label>
       <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>
    
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update user">
<!--        create_post je isto kot submit pri ostalih-->
    </div>
    
</form>