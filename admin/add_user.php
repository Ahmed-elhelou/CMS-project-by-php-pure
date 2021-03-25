<?php 
    if(isset($_POST['submit'])){
       
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = implode(" ",$_POST['check_box_array']);
        
        
        $user_password = $_POST['user_password'];
        
        $query = "SELECT randSalt FROM users";
            $result_select_rand = mysqli_query($connection, $query);
            $row_salt = mysqli_fetch_array($result_select_rand);
            $salt = $row_salt['randSalt'];
        $user_password = crypt($user_password, $salt);
        
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        
        move_uploaded_file($user_image_temp,"../images/$user_image");

    $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_image, user_role, user_password) ";
    $query .= "VALUES ('$username', '$user_firstname', '$user_lastname', '$user_email', '$user_image', '$user_role', '$user_password')";
        $result_add_user_query = mysqli_query($connection , $query);
        if(!$result_add_user_query){
            die(mysqli_error($connection));
        }
       // header("Location: users.php");


    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username" >Username</label>
        <input type="text" name="username"  class="form-control" >
    </div>
    <div class="form-group">
        <label for="user_firstname" >First Name</label>
        <input type="text" name="user_firstname"  class="form-control" >
        
        <!-- <input type="text" name="post_cat_id" class="form-control" > -->
    </div>
    <div class="form-group">
        <label for="user_lastname" >Last Name</label>
        <input type="text" name="user_lastname" class="form-control" >
    </div>
    <div class="form-group">
        <label for="user_email" >Email</label>
        <input type="email" name="user_email" class="form-control" >
    </div>
   <?php $premessions = ["add_posts","edit_posts","delete_posts","add_users","delete_users","edit_users","add_cats","edit_cats","delete_cats","see_drafts","see_comments","aprove_comments"] ;?>
    <div class="form-group">
        <label for="user_role" >Role</label>
        <select multiple  class="selectpicker " data-actions-box="true" data-size="5">
        <?php 
            foreach ($premessions as  $premession) {
               echo " <option  value='$premession'>$premession</option>";
               //echo " <input value='$post_id' type='checkbox' class='selectPost' name='check_box_array[]' id=''>";
            }
        ?>
            
           
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