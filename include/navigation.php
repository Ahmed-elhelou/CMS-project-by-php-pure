<?php session_start(); ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Project</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $query_cat = "SELECT * FROM categories";
                        $result_cat_query = mysqli_query($connection,$query_cat);
                        if($result_cat_query){
                            while($row = mysqli_fetch_assoc($result_cat_query)){
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                               echo "<li><a href='index.php?cat_id=$cat_id'>$cat_title</a></li>";
                            }
                        }

                     ?>

                    <li>
                        <a href="admin">Admin</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['user_role']) && $_SESSION['user_role']==='admin' && isset($_GET['post_id'])){
                            
                            $post_id = $_GET['post_id'];
                           
                            echo "<li><a href='admin/posts.php?source=edit_post&post_id=$post_id'>Edit</a></li>";
                        }
                    ?>
                    
                    <!-- <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>