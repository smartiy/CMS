<?php include"includes/admin_header.php";?>

<?php ob_start(); ?>
  
  <?php

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '{$username}'";
    }

    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
   ?>
   <?php
if(isset($_POST['edit_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
    $update_query = "UPDATE users SET ";
    $update_query .= "user_firstname = '{$user_firstname}', ";
    $update_query .= "user_lastname = '{$user_lastname}', ";
    $update_query .= "user_role = '{$user_role}', ";
    $update_query .= "username = '{$username}', ";
    $update_query .= "user_email = '{$user_email}', ";
    $update_query .= "user_password = '{$user_password}' "; 
    $update_query .= "WHERE username = {$username} ";
    $edit_user_query = mysqli_query($connection, $update_query);
}

?>
    <div id="wrapper">

        <!-- Navigation -->
<?php include"includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update profile">
<!--        create_post je isto kot submit pri ostalih-->
    </div>
    
</form>                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include"includes/admin_footer.php" ?>