
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
                            case 'add_user':
                                include "add_user.php";
                                break;
                            case 'edit_user':
                                include "edit_user.php";
                                break;
                            default:
                                include "include/view_all_users.php";
                                break;
                        }


                        if(isset($_GET['delete'])){
                            $delet_user_id = $_GET['delete'];
                            $query = "DELETE FROM users WHERE ";
                            $query .= "user_id = '$delet_user_id'";
                            $result_delete_cat = mysqli_query($connection,$query);
                            header('location: users.php');
                        }
                        if(isset($_GET['change_to_admin'])){
                            $user_id = $_GET['change_to_admin'];
                            $query = "UPDATE users SET ";
                            $query .= "user_role = 'admin' WHERE user_id = $user_id ";
                            $result_update_role = mysqli_query($connection,$query);
                            header('location: users.php');
                        }
                        if(isset($_GET['change_to_sub'])){
                            $user_id = $_GET['change_to_sub'];
                            $query = "UPDATE users SET user_role = 'subscriber' ";
                            $query .= "WHERE user_id = $user_id ";
                            $result_update_role = mysqli_query($connection,$query);
                            header('location: users.php');
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
