
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
                    <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source ='';
                        }

                        switch($source){
                            case 'add_post':
                                include "add_post.php";
                                break;
                            case 'edit_post':
                                include "edit_post.php";
                                break;
                            default:
                                include "include/view_all_posts.php";
                                break;
                        }


                        if(isset($_GET['delete'])){
                            $delet_post_id = $_GET['delete'];
                            $query = "DELETE FROM posts WHERE ";
                            $query .= "post_id = '$delet_post_id'";
                            $result_delete_cat = mysqli_query($connection,$query);
                            header('location: posts.php');
                        }
                        
                    ?>

                    </div>
               
                
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "include/footer.php" ?>
