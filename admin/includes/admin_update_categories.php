                    <form action="#" method="post">

            <div class="form-group">
               <label for="cat-title">Update Category</label>

            <?php                   
//            if(isset($_GET['edit'])) {
//                $the_cat_id = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = $the_cat_id";
            $select_categories_id = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $the_cat_id = $row['cat_id'];
                $the_cat_title = $row['cat_title'];


            ?>                        
                <input value="<?php if(isset($the_cat_title)){echo $the_cat_title;}?>" type="text" class="form-control" name="cat_title">
            <?php }    ?>

               <?php
            //update query
        if(isset($_POST['edit_submit'])) {

            $changed_cat_title = $_POST['cat_title'];
            
//            $update_query = "UPDATE categories SET ";
//            $update_query .= "cat_title = '{$changed_cat_title}' ";
//            $update_query .= "WHERE cat_id = {$the_cat_id} ";
//            $result = mysqli_query($connection, $update_query);
            
            $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ?");
            mysqli_stmt_bind_param($stmt1, "si", $changed_cat_title, $the_cat_id);
            mysqli_stmt_execute($stmt1);

                if(!$stmt) {
                    die("QUERY FAILED!" . mysqli_error($connection));
                }
                mysqli_stmt_close($stmt);    
                redirect("categories.php");
                
            }
                        ?>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_submit" value="Update Category">  
                        </div>
                    </form>