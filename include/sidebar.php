
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form  action="search.php" method="post">
    <div class="input-group">
        <input name= "search" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
</form>
    <!-- /.input-group -->
</div>
<div class="well">
    <h4>Login</h4>
    <form  action="include/login.php" method="post">
    <div class="form-group">
        <input name= "username" placeholder="Enter Username"  type="username" class="form-control">
        
    </div>
      <div class="input-group">
          
       
        <input name= "password" type="password" placeholder="password" class="form-control">
        <span class="input-group-btn">
            <button name= "login"  class="btn btn-primary" type="submit">Login</button>
        </span>
        
      
    </div>
</form>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php
                        $query = "SELECT * FROM categories ";
                        $result_cat_side_query = mysqli_query($connection,$query);
                        if($result_cat_side_query){
                            while($row = mysqli_fetch_assoc($result_cat_side_query)){
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                               echo "<li><a href='index.php?cat_id=$cat_id'>$cat_title</a></li>";
                            }
                        }

                     ?>
                
            </ul>
        </div>
        <!-- /.col-lg-6 -->
       
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>

</div>
