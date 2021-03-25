
<?php include "include/header.php";?>
<?php include "functions.php";?>
<?php
if(isset($_SESSION['username'])){
      
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result_select_user_query = mysqli_query($connection, $query);
    
    $row = mysqli_fetch_assoc($result_select_user_query);
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
    $user_email = $row['user_email'];
}


 if(isset($_POST['update'])){
      
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    
    move_uploaded_file($user_image_temp,"../images/$user_image");

     if(empty($user_image)){
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result_select_image_query = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result_select_image_query);

        $user_image = $row['user_image'];
    }

    $query = "UPDATE users SET ";
    $query .= "username    = '$username', ";
    $query .= "user_firstname   = '$user_firstname', ";
    $query .= "user_lastname   = '$user_lastname', ";
    $query .= "user_role   = '$user_role', ";
    $query .= "user_email     = '$user_email', ";
    $query .= "user_image    = '$user_image' ";
    $query .= "WHERE username = '$username'";
    
    $result_edit_user_query = mysqli_query($connection , $query);
    if(!$result_edit_user_query){
       echo die(mysqli_error($connection));
    }
    

  }
  

 
 ?>

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
                <form action="" method="post" enctype="multipart/form-data">
              <?php  echo  $user_id; ?>

                    <div class="form-group">
                        <label for="username" >Username</label>
                        <input value="<?php echo $username ?>" type="text" name="username"  class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="user_firstname" >First Name</label>
                        <input value="<?php echo $user_firstname ?>" type="text" name="user_firstname"  class="form-control" >
                        
                        <!-- <input type="text" name="post_cat_id" class="form-control" > -->
                    </div>
                    <div class="form-group">
                        <label for="user_lastname" >Last Name</label>
                        <input value="<?php echo $user_lastname ?>" type="text" name="user_lastname" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="user_email" >Email</label>
                        <input value="<?php echo $user_email ?>" type="email" name="user_email" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="user_role" >Role</label>
                        <select name="user_role" class="form-control ">
                            <option <?php if($user_role=='admin'){echo 'selected';} ?> value='admin'>admin</option>;
                            <option <?php if($user_role=='subscriber'){echo 'selected';} ?> value='subscriber'>subscriber</option>
                        
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="user_password" >Password</label>
                        <input type="password" name="user_password" class="form-control" >
                    </div>
                
                    <div class="form-group">
                        <label for="user_image" >User Image</label>
                        <input type="file" name="user_image" class="form-control-file" >
                    </div>
                    
                    
                <button type="submit" name="update" class="btn btn-success mb-3 my-2" >Update</button>

                </form>

        </div>
    
    
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "include/footer.php" ?>
