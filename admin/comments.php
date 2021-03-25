
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
                                include "include/view_all_comments.php";
                                break;
                        }


                        if(isset($_GET['delete'])){
                            $delet_comment_id = $_GET['delete'];
                            $query = "DELETE FROM comments WHERE ";
                            $query .= "comment_id = '$delet_comment_id'";
                            $result_delete_cat = mysqli_query($connection,$query);
                            
            $query = "UPDATE posts SET post_comment_count = post_comment_count - 1  WHERE post_id = $comment_post_id";
            $result_update_count_post_query = mysqli_query($connection, $query);
          
                            header('location: comments.php');
                        }
                    if(isset($_GET['aprove'])){
                            $aprove_comment_id = $_GET['aprove'];
                            $query = "UPDATE comments SET comment_status = 'aproved' ";
                            $query .= "WHERE comment_id = $aprove_comment_id ";
                            $result_aprove_comment = mysqli_query($connection,$query);
                            header('location: comments.php');
                        }
                    if(isset($_GET['unaprove'])){
                        $unaprove_comment_id = $_GET['unaprove'];
                        $query = "UPDATE comments SET comment_status = 'unaproved' ";
                        $query .= "WHERE comment_id = $unaprove_comment_id ";
                        $result_unaprove_comment = mysqli_query($connection,$query);
                        header('location: comments.php');
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
