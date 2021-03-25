<?php include "include/header.php" ?>

<body>

    <div id="wrapper">
    <?php 
    $session = session_id();
    $time = time();
    $timeout_in_seconds = 30;
    $time_out = $time - $timeout_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $result_select_count = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result_select_count);

    if($count == NULL){
        $query = "INSERT INTO users_online(session, time) VALUES('$session', '$time')";
        $result_insert_user_online = mysqli_query($connection, $query);
    }else{
        $query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
        $result_insert_user_online = mysqli_query($connection, $query);
        }
    $query = "SELECT * FROM users_online WHERE time > '$time_out'";
    $result_select_users_online = mysqli_query($connection, $query);
    $users_online_count = mysqli_num_rows($result_select_users_online);

    print_r( $_SESSION['user_role']);
   

?>
        <!-- Navigation -->
       
        <?php include "include/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small><?php echo $_SESSION['user_firstname']; ?></small>
                        </h1>
                        <o>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                            $query = "SELECT * FROM posts" ;
                            $result_select_posts_query = mysqli_query($connection,$query);
                            $posts_count = mysqli_num_rows($result_select_posts_query);
                        ?>
                  <div class='huge'><?php echo $posts_count; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                            $query = "SELECT * FROM comments" ;
                            $result_select_comments_query = mysqli_query($connection,$query);
                            $comments_count = mysqli_num_rows($result_select_comments_query);
                        ?>
                     <div class='huge'><?php echo $comments_count; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                            $query = "SELECT * FROM users" ;
                            $result_select_users_query = mysqli_query($connection,$query);
                            $users_count = mysqli_num_rows($result_select_users_query);
                        ?>
                     <div class='huge'><?php echo $users_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                        <?php
                            $query = "SELECT * FROM categories" ;
                            $result_select_categories_query = mysqli_query($connection,$query);
                            $categories_count = mysqli_num_rows($result_select_categories_query);
                        ?>
                     <div class='huge'><?php echo $categories_count; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
            <div class="row">
            <script type="text/javascript">
                google.charts.load("current", {packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ["Element", "count", { role: "style" } ],
                            ["Posts", <?php echo $posts_count ?>, "#337ab7"],
                            ["Comments", <?php echo $comments_count ?>, "color: #5cb85c"],
                            ["Users", <?php echo $users_count ?>, "color: #f0ad4e"],
                            ["Categories", <?php echo $categories_count ?>, "color: #d9534f"]
                        ]);

                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                                        { calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation" },
                                        2]);

                        var options = {
                            title: "",
                            width: 0,
                            height: 0,
                            bar: {groupWidth: "95%"},
                            legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                 }
  </script>
<div id="columnchart_values" style="width: 'auto'; height: 300px;"></div>
            </div>
            <!-- /.container-fluid -->

        </div>
        
        <!-- /#page-wrapper -->

        <?php include "include/footer.php" ?>
