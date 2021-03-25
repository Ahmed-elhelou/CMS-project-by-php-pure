 <?php  include "include/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    <?php 
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            $username = mysqli_real_escape_string($connection, $username);
            $user_email = mysqli_real_escape_string($connection, $user_email);
            $user_password = mysqli_real_escape_string($connection, $user_password);

            $query = "SELECT randSalt FROM users";
            $result_select_rand = mysqli_query($connection, $query);
            $row_salt = mysqli_fetch_array($result_select_rand);
            $salt = $row_salt['randSalt'];
            

            $user_password = crypt($user_password, $salt);
            
            if($username && $user_email && $user_password){

                $query = "INSERT INTO users (username, user_email, user_role, user_password) ";
                $query .= "VALUES ('$username',  '$user_email', 'subscriber', '$user_password')";
                $result_add_user_query = mysqli_query($connection , $query);
                if(!$result_add_user_query){
                    die(mysqli_error($connection));
                }
                $messege = "Your request have been submited";
            }else{
                $messege = "This fields cannot be empty";
            }

        }else{
            $messege ="";
        }
    ?>
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <h6 class = "text-center"><?php echo $messege; ?></h6>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="user_email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="user_password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
