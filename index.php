<?php include"includes/header.php";?>
<?php include"includes/navbar.php";?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <!-- Tukaj sem dodal komentar -->
            <?php
                
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }
                
            if($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * 5) - 5;
            }
                
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                $post_query_count = "SELECT * FROM posts";

            } else {
                $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
            }
                
            
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
                
            $count = ceil($count / 5);
                
            if ($count === 0) {
                echo "<h1 class='text-center'>No posts available</hq>";
            } else {
                
            $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, 5";
            $select_all_posts_query = mysqli_query($connection, $query);

            WHILE ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,100);
                $post_status = $row['post_status'];
            
//                if($post_status == 'published') {
//                    echo "<h1 class='text-center'> NO POST SORRY </h1>";
//                } else {
                
            ?>
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                <img width='250' src="images/<?php echo $post_image;?>" alt="">
<!--                class="img-responsive" v zgornji zbrisano-->
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
                }
                }
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
                
            <?php include"includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
        
        <?php
            
        for($i = 1; $i <= $count; $i++)     {
            if($i == $page || ($page == '' && $i == 1)) {
                
            echo"<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";    
                
            } else {
                
            echo"<li><a href='index.php?page={$i}'>{$i}</a></li>";    
            }
        }
  
        ?>

        </ul>

        <!-- Footer -->
        <?php include"includes/footer.php";?>
        
