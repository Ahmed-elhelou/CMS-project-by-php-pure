<?php ob_start();?>
<?php include "include/db.php";?>
<?php 
    if(isset($_GET['post_id'])){

        $post_id = $_GET['post_id'];
        $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
        $result_update_post_views_query = mysqli_query($connection, $query);
        
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $result_select_post_query = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($result_select_post_query);

        $post_id            = $post['post_id'];
        $post_author        = $post['post_author'];
        $post_title         = $post['post_title'];
        $post_cat_id        = $post['post_cat_id'];
        $post_status        = $post['post_status'];
        $post_image         = $post['post_image'];
        $post_tags          = $post['post_tags'];
        $post_comment_count = $post['post_comment_count'];
        $post_date          = $post['post_date'];
        $post_content          = $post['post_content'];
    }else{
       header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $post_title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php include "include/navigation.php" ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content; ?></p>

                <hr>
        
                <!-- Blog Comments -->

                <!-- Comments Form -->

        <?php 
            if(isset($_POST['creat_comment'])){
            $comment_post_id = $_GET['post_id'];
            $comment_author  = $_POST['comment_author'];
            $comment_email   = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];
            if( $comment_author && $comment_email && $comment_content){

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";
                    $query .= "VALUES($comment_post_id , '$comment_author','$comment_email', '$comment_content', 'unaproved', now())";
                    $result_insert_comment_query = mysqli_query($connection, $query);
        
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1  WHERE post_id = $comment_post_id";
                    $result_update_count_post_query = mysqli_query($connection, $query);
                    if(!$result_update_count_post_query){
                        die(mysqli_error($connection));
                    }
                
        
                    header("Location: post.php?post_id=$post_id");
                }else{
                    echo "<script>alert('FIELDS CONNOT BE EMPTY');</script>";
                }

            }
        ?>
        
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="post" action="" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input class="form-control" type="text" name="comment_author" id="comment_author">
                        </div>
                       <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input class="form-control" type="email" name="comment_email" id="comment_email">
                        </div>
                      
                        <div class="form-group">
                             <label for="comment_content">Your comment</label>
                            <textarea class="form-control" name="comment_content" id="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="creat_comment" class="btn btn-primary">Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php 
                    $comment_post_id = $_GET['post_id'];
                    $query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id ";
                    $query .= "AND comment_status = 'aproved' ";
                    $query .= "ORDER BY comment_id DESC";
                    $result_select_comment_query = mysqli_query($connection, $query);
                    if(!$result_select_comment_query){
                        echo die("ERROR " . mysqli_error($connection));
                    }
                    while($comment_row = mysqli_fetch_assoc($result_select_comment_query)){
                        
                        $comment_author  = $comment_row['comment_author'];
                        $comment_date   = $comment_row['comment_date'];
                        $comment_content = $comment_row['comment_content'];
                      
                    
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
                        <?php } ?>
                <!-- Comment 
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                     <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment 
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment 
                    </div> 
                </div> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "include/sidebar.php";?>


        </div>
        <!-- /.row -->

        <hr>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
