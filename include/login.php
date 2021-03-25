<?php include "db.php";?>
<?php session_start(); ?>

<?php 
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($connection,$username);
        $password = mysqli_real_escape_string($connection,$password);

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result_select_user_query = mysqli_query($connection,$query);

        $row = mysqli_fetch_assoc($result_select_user_query);

        $user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_roles_array = explode(" ",$user_role);

        $query_select = "SELECT randSalt FROM users";
        $result_select_rand = mysqli_query($connection, $query_select);
        $row_salt = mysqli_fetch_array($result_select_rand);
        $salt = $row_salt['randSalt'];

       $password = crypt($password, '$2y$10$iusesomecrazystrings22');

       
        if($username == $db_username && $password == $db_password){
            $_SESSION['username'] = $username;
            $_SESSION['user_firstname'] = $user_firstname;
            $_SESSION['user_lastname'] = $user_lastname;

            $_SESSION['user_role'] = $user_roles_array;
            print_r($_SESSION['user_role']) ;

            header("Location: ../admin");
        }else{
            
           header("Location: ../index.php");

        }
        
    }

?>