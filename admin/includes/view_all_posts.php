<?php
if(isset($_POST['checkBoxArray'])) {
    
    foreach($_POST['checkBoxArray'] as $postValueId) {
    
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options) {
            case 'published':
                
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connection, $query);
                
                break;
                
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                $update_to_draft_status = mysqli_query($connection, $query);
                
                break;
                
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $delete_query = mysqli_query($connection,$query);
                break;
                
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
                $select_post_query = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_array($select_post_query)) {
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    
                        
                    
                $query = "INSERT INTO posts(post_title, post_category_id, post_date, post_author, post_status, post_image, post_tags, post_content)";
                $query .= "VALUES('{$post_title}','{$post_category_id}','{$post_date}','{$post_author}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
                $copy_query = mysqli_query($connection, $query);
                }
                
    
                if(!$copy_query ) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                
                break;
                
            case 'reset_views':
                $reset_views_query = "UPDATE posts SET post_views_counts = '{0}' WHERE post_id = {$postValueId} ";
                $Reset_views = mysqli_query($connection, $reset_views_query);

        }
  
        }
}
?>
                   <form action="" method='post'>   
                    <table class="table table-bordered table-hover">
                       
                       <div id="bulkOptionContainer" class="col-xs-4">
                           <select class="form-control" name="bulk_options" id="">
                               
                               <option value="">Select Options</option>
                               <option value="published">Publish</option>
                               <option value="draft">Draft</option>
                               <option value="delete">Delete</option>
                               <option value="clone">Clone</option>
                               <option value="reset_views">reset views</option>
                           </select>
 
                       </div>
                       <div class="col-xs-4">
                           <input type="submit" name="submit" class="btn btn-success" value="Apply">
                           <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
                       </div>
                        <thead>
                            <tr>
                                <th><input id="selectAllBoxes" type="checkbox"></th>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>View Post</th>
                                <th>Edit Post</th>
                                <th>Delete</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                    <?php
                            
//                    $query = "SELECT * FROM posts";
                            
                    $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
                    $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_counts, categories.cat_id, categories.cat_title ";
                    $query .= "FROM posts ";
                    $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC ";
                    $select_posts = mysqli_query($connection, $query);


                    while ($row = mysqli_fetch_assoc($select_posts)) {
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_views_counts = $row['post_views_counts'];
                        
                        $the_cat_id = $row['cat_id'];
                        $the_cat_title = $row['cat_title'];     
                        
                        echo "<tr>";
//                        ?>
                        
                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                        
                        <?php
                        echo "<td>$post_id</td>";
                        echo "<td>$post_author</td>";
                        echo "<td>$post_title</td>";
                        
//                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
//                    $select_categories_id = mysqli_query($connection,$query);
//
//                    while($row = mysqli_fetch_assoc($select_categories_id)) {
//                        $the_cat_id = $row['cat_id'];
//                        $the_cat_title = $row['cat_title'];                         
//                        }
                        
                        echo "<td>$the_cat_title</td>";
                        echo "<td>$post_status</td>";
                        echo "<td><img width='100' class='img-responsive' src='../images/$post_image' alt='image'></td>";
                        echo "<td>$post_tags</td>";
                        
//                        link do vseh komentarjev naaa
//                        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
//                        $send_comment_query = mysqli_query($connection, $query);
//                        $row = mysqli_fetch_array($send_comment_query);
//                        $comment_id = $row['comment_id'];  
                        
                        
                        echo "<td><a href='post_comments.php?id=$post_id'>$post_comment_count</a></td>";
//                        echo "<td>$post_comment_count</td>";
                        echo "<td>$post_date</td>";
                        echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                        echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit post</a></td>";
                        
                        ?>
                        
                        <form method="post" action="">
                           
                            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                       <?php     
                            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
                        ?>    
                            
                            
                        </form>
                        
                        
                        <?php
                        
//                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                        echo "<td>$post_views_counts</td>";
                        echo "</tr>";
                    }
                            
                    ?>
<!--
                            <td>10</td>
                            <td>Samo Lorencic</td>
                            <td>Bootstrap framework</td>
                            <td>Bootstrap</td>
                            <td>Status</td>
                            <td>Image</td>
                            <td>Tags</td>
                            <td>Comments</td>
                            <td>Date</td>
-->
            <?php
//            if(isset($_GET['delete'])) {
//                $post_delete_id = $_GET['delete'];
//                $query = "DELETE FROM posts WHERE post_id = {$post_delete_id}";
//                $delete_query = mysqli_query($connection,$query);
//                header("Location: posts.php");
                //                        header osveži stran
                            
                            
            if(isset($_POST['post_id'])) {
                $the_post_id = $_POST['post_id'];
                $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";            
                $delete_query = mysqli_query($connection,$query);
                header("Location: posts.php");
                }
                            
                //if(isset($_GET['edit_post'])) {
                //    $post_id = $_GET['edit_post'];
                ?>                                                   
                        </tbody>
                    </table>
                </form>       
                       
                        