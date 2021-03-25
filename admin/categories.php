<?php include "include/header.php";?>
<?php include "functions.php";?>


<body>

    <div id="wrapper">

        <!-- Navigation -->
       
        <?php include "include/navigation.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome To Admin<small>Author</small></h1>
                        <ol>     </ol>
                           <?php if (in_array("add_cats", $user_roles_array)){ ?>
                        <div class="col-xs-6">
                            <?php insertCategories(); ?>
                            
                             <!-- Add form -->
                            <form action="categories.php" method="post">

                                <div class="form-group">
                                    <label for="cat_title">Add Category</label> 
                                    <input class="form-control" type="text" name="cat_title"> 
                                </div>
                                <div class="form-group">
                                    <input name="submit" class= "btn btn-primary" type="submit" value="Add">
                                </div>
                            </form>
                            <?php } ?>
                             <!-- Update form -->
                            <?php 
                            if(isset($_GET['update'])){
                                $cat_id = $_GET['update'];
                                include "include/update_categories.php";
                            }
                            ?>

                        </div>

                        <div class="col-xs-6">
                            <!-- Add Dynamic Table -->
                            <?php include "include/table_categories.php" ?>
                        </div>
                   
                    </div>
               
                
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "include/footer.php" ?>
