
<?php include "include/header.php" ?>

<body>

    <!-- Navigation -->
    <?php include "include/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <?php 
               $search = $_POST['search'];
               $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'aproved'";
               $result_search_query = mysqli_query($connection,$query);
               $search_count = mysqli_num_rows($result_search_query);
               
                
             ?>
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php if($search_count == 0){
                    echo "<h1>Not Found</h1>";
                }else{
                    while($post = mysqli_fetch_assoc($result_search_query)){
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_date = $post['post_date'];
                        $post_content = substr($post['post_content'],0,180) . "...";
                        $post_image = $post['post_image'];
                      ?>
                <h2>
                    <a href='#'><?php echo $post_title; ?></a>
                </h2>
                <p class='lead'>
                    by <a href='index.php'><?php echo $post_author; ?></a>
                </p>
                <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class='img-responsive' src='images/<?php echo $post_image; ?>' alt=''>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

                <hr>



                    
              <?php  }}?>
               
               

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "include/sidebar.php";?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include "include/footer.php";?>