
<?php include "include/header.php" ?>

<body>

    <!-- Navigation -->
    <?php include "include/navigation.php" ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <?php
                $POSTS_PER_PAGE = 4;
                $query_all_posts = "SELECT * FROM posts WHERE post_status = 'published'";
                $result_all_post_query = mysqli_query($connection, $query_all_posts);

                $all_posts_count = mysqli_num_rows($result_all_post_query);
                 
                $pages_count = ceil($all_posts_count / $POSTS_PER_PAGE);
                
                if(isset($_GET['current_page'])){
                    $current_page = $_GET['current_page'];
                }else{
                    $_GET['current_page']=1;
                    $current_page = 1;
                }
                $first_post =  ($current_page - 1) * $POSTS_PER_PAGE;
             if(isset($_GET['cat_id'])){
                    $cat_id = $_GET['cat_id'];
                    $query_posts = "SELECT * FROM posts WHERE post_cat_id = $cat_id AND";
                    $result_post_query = mysqli_query($connection, $query_posts);
                 }else if(isset($_GET['author'])){
                    $author = $_GET['author'];
                    $query_posts = "SELECT * FROM posts WHERE post_author = '$author' AND post_status = 'published'";
                    $result_post_query = mysqli_query($connection, $query_posts);
                 }else{

                     $query_posts = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $first_post, $POSTS_PER_PAGE";
                     $result_post_query = mysqli_query($connection, $query_posts);
                 }

                 
                 
                 


                
             ?>
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php if($result_cat_query){
                    while($post = mysqli_fetch_assoc($result_post_query)){
                        $post_id = $post['post_id'];
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_date = $post['post_date'];
                        $post_content = substr($post['post_content'],0,180) . "...";
                        $post_image = $post['post_image'];
                      ?>
                <h2>  
                    <a href='post.php?post_id=<?php echo $post_id; ?>'><?php echo $post_title; ?></a>
                </h2>
                <p class='lead'>
                    by <a href='index.php?author=<?php echo $post_author ?>'><?php echo $post_author; ?></a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href='post.php?post_id=<?php echo $post_id; ?>'> <img class='img-responsive' src='images/<?php echo $post_image; ?>' alt=''></a>
               
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class='btn btn-primary' href='post.php?post_id=<?php echo $post_id; ?>'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

                <hr>



                    
              <?php  }}?>
               
               

                <!-- Pager -->
                <nav aria-label="Page navigation example">
              
                <ul class="pagination justify-content-center">
                <?php 
                       if($current_page != 1){
                        $prev = $current_page-1;
                           echo "<li class='previous'>
                           <a href='index.php?current_page=$prev'>&larr; previous</a>
                       </li>";
                       }
                    
                    ?>
                   
                    <?php
                        for ($i=1; $i <= $pages_count ; $i++) { 
                            
                              if($current_page == $i){
                                 echo"<li class='page-item active'>
                                 <a class='page-link' href='#'>$i <span class='sr-only'>(current)</span></a>
                              </li>";
                              }else{

                                  echo "<li class='page-item'><a class='page-link active' href='index.php?current_page=$i'>$i</a></li>";
                              }
                            
                        }
                        ?>
                         <?php 
                         $next = $current_page+1;
                    if($current_page != $pages_count){
                        echo "<li class='next'>
                        <a href='index.php?current_page=$next'>next &rarr;</a>
                    </li>";
                    }
                ?>
                      
                </ul>
                </nav>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "include/sidebar.php";?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include "include/footer.php";?>