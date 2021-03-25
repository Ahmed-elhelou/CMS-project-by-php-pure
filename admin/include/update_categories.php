<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update</label> 
        <?php 
            if(isset($_GET['update'])){
                $cat_id = $_GET['update'];
                $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                $result_cat_update_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($result_cat_update_query)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                ?> 
                    <input value='<?php if(isset($cat_title)){echo $cat_title;}  ?>' class="form-control" type="text" name="update_cat_title"> 

                    <?php }} ?>

                    
         <?php            
        if(isset($_POST['update_cat'])){
            $new_title = $_POST['update_cat_title'];
            $query = "UPDATE categories SET cat_title = '$new_title' WHERE cat_id = $cat_id";
            $result_update = mysqli_query($connection,$query);
            header("Location: categories.php");
        }?>
        </div>
    <div class="form-group">
        <input name="update_cat" class= "btn btn-success" type="submit" value="Update">
        </div>
</form>