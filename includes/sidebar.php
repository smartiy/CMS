<?php
if(ifItIsMethod('post')) {
    if(isset($_POST['login'])) {
       if(isset($_POST['username']) && isset($_POST['password'])) {
            login_user($_POST['username'], $_POST['password']);
        } else {
            redirect('index.php');
        } 

    }

}
?>
              
               <div class="col-md-4">
                
                <?php
    
//    if(isset($_POST['submit'])) {
//        $search = $_POST['search'];
//        
//        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
//        $search_query = mysqli_query($connection, $query);
//        
//        if(!$search_query) {
//            die("QUERY FAILED" . mysqli_error($connection));
//        }
//        
//        $count = mysqli_num_rows($search_query);
//        
//        if($count == 0) {
//            echo "<h1>NO RESULT </h>";
//        } else {
//            echo "SOME RESULT";
//        }
//        
//    }
    ?>
             
              <!-- Post search -->
                <div class="well">
                    <h4>Post search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search_place" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                </div>

             <!-- Login -->
                <div class="well">
                   
                   <?php if(isset($_SESSION['user_role'])): ?>
                    <div class="form-group">
                       <h4>Logged in as <?php echo $_SESSION['username'] ?></h4>
                       <a href="includes/logout.php" class="btn btn-primary">Logout</a>
                    </div>
                   <?php else: ?>
                       <h4>Login</h4>
                            <form method="post">
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" placeholder="Enter username">
                            </div>

                            <div class="input-group">
                                <input name="password" type="password" class="form-control" placeholder="Enter password">
                                <span class="input-group-btn">
                                     <button class="btn btn-primary" name="login" type="submit">Submit</button>

                                 </span>
                            </div>
                            
                                <div class="form-group">
                                    <a href="forgot_password.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a>
                                    
                                </div>
                            
                            </form>
                   
                   <?php endif; ?>

                </div>
                
                

  
          <?php
        $query = "SELECT * FROM categories"; //LIMIT 1 lahko dodaš
        $select_categories_sidebar = mysqli_query($connection, $query);
        ?>             
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
        <?php                       
        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
        }
        ?>
                        </ul>
                        </div>
                        <!-- /.col-lg-6 -->
<!--
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
-->
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                               <!-- Side Widget Well -->
                <?php include "widget.php";?>
                  

            </div>