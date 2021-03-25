<?php
    session_start();
   if(isset($_SESSION['username'])){
       
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = $username";
        $result_select_user_query = mysqli_query($connection, $query);
        if(!$result_select_user_query){
            die(mysqli_error($connection));
        }
        $row = mysqli_query($result_select_user_query);
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
   }
?>
<form action="" method="post" enctype="multipart/form-data">
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
    
    
  <button type="submit" name="submit" class="btn btn-primary mb-3 my-2" >Create</button>

</form>