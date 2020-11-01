                    <table class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
<!--                                <th>Edit</th>-->
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                    <?php
                            
                    $query = "SELECT * FROM comments";
                    $select_comments = mysqli_query($connection, $query);


                    while ($row = mysqli_fetch_assoc($select_comments)) {
                        $comment_id = $row['comment_id'];
                        $comment_post_id = $row['comment_post_id'];
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_email = $row['comment_email'];
                        $comment_status = $row['comment_status'];
                        $comment_date = $row['comment_date'];
                        
                        echo "<tr>";
                        echo "<td>$comment_id</td>";
                        echo "<td>$comment_author</td>";
                        echo "<td>$comment_content</td>";
                        
//                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
//                    $select_categories_id = mysqli_query($connection,$query);
//
//                    while($row = mysqli_fetch_assoc($select_categories_id)) {
//                        $the_cat_id = $row['cat_id'];
//                        $the_cat_title = $row['cat_title'];                         
//
//                        
//                        echo "<td>$the_cat_title</td>";
//                        }
                        
                        echo "<td>$comment_email</td>";
                        echo "<td>$comment_status</td>";
                        
                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                        $select_post_id = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_assoc($select_post_id)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            
                        }
                        
                        echo "<td>$comment_date</td>"; 
                        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
//                        echo "<td><a href='posts.php?source=edit_post&p_id={post_id}'>Edit post</a></td>";
                        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

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
                            
            if(isset($_GET['approve'])) {
                $the_comment_id = $_GET['approve'];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
                $approve_comment_query = mysqli_query($connection,$query);
                header("Location: comments.php");
                //                        header osveži stran
                }                            
                            
            if(isset($_GET['unapprove'])) {
                $the_comment_id = $_GET['unapprove'];
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
                $unapprove_comment_query = mysqli_query($connection,$query);
                header("Location: comments.php");
                //                        header osveži stran
                }
                            
                            
            if(isset($_GET['delete'])) {
                $tha_post_id = $_GET['delete'];
                $query = "DELETE FROM comments WHERE comment_id = {$tha_post_id}";
                $delete_query = mysqli_query($connection,$query);
                header("Location: comments.php");
                //                        header osveži stran
                }
                            
                //if(isset($_GET['edit_post'])) {
                //    $post_id = $_GET['edit_post'];
                ?>                                                   
                        </tbody>
                    </table>
                        