<?php
 function insertCategories(){
     global $connection;
    if(isset($_POST['submit'])){
        $new_cat = $_POST['cat_title'];
    
        if($new_cat){
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('$new_cat')";
            $result_add_cat = mysqli_query($connection,$query);
            header("Location: categories.php");
        }else{
            echo "This field is empty";
            }
        }
}

