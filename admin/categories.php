<?php include"includes/admin_header.php";?>

<?php ob_start(); ?>
   
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
                        
                        <div class="col-xs-6">
                        
                <?php insert_categories(); ?>         
                           
                         <form action="" method="post">
                        <div class="form-group">
                           <label for="cat-title">ADD Category</label>
                            <input type="text" class="form-control" name="cat_title">           
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">           
                        </div>
                    </form>               
                        
<!--            UPDATE AND INCLUDE QUERY-->
                        <?php 
                            if(isset($_GET['edit'])) {
                                $the_cat_id = $_GET['edit'];
//                                zgleda da ni treba tega zgoraj oz. sem zakomentiral v admin_update
                                
                                    
                                include"includes/admin_update_categories.php";
                            }
                            
                            ?>
                    </div>
                    <div class="col-xs-6">
                    
                    <table class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                        </thead>
                        <tbody>
<!--
                           <thead>
                            <tr>
                                <td>Baseball Category</td>
                                <td>Basketball Category</td>
                                <td>Football Category</td>
                            </tr>
                            </thead>
-->

                <!--      find all categories-->
                        <?php findAndWriteAllCategories();  ?>


                        <?php deleteCategories(); ?>

                       </tbody>
                    </table>
               
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


    
    
<?php include"includes/admin_footer.php" ?>