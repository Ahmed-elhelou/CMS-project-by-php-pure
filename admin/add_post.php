<?php 
    if(isset($_POST['submit'])){
        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        move_uploaded_file($post_image_temp,"../images/$post_image");

        $query = "INSERT INTO posts(post_title, post_cat_id, post_author, post_status, post_image, post_tags, post_content, post_date) ";
        $query .= "VALUES('$post_title', $post_cat_id, '$post_author', '$post_status', '$post_image', '$post_tags', '$post_content',  now())";
        $result_add_post_query = mysqli_query($connection , $query);


    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title" >Post Title</label>
        <input type="text" name="post_title"  class="form-control" >
    </div>
    <div class="form-group">
        <label for="post_cat_id" >Post Category Id</label>
        <select name="post_cat_id" class="form-control ">
            <?php
                $query = "SELECT * FROM categories";
                $result_cat_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($result_cat_query)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo $cat_id;
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
            ?>
         </select>
        <!-- <input type="text" name="post_cat_id" class="form-control" > -->
    </div>
    <div class="form-group">
        <label for="post_author" >Post Author</label>
        <input type="text" name="post_author" class="form-control" >
    </div>
    <div class="form-group">
        <label for="post_status" >Post Status</label>
        <select name="post_status" class="form-control ">
            <option value='draft'>draft</option>;
            <option value='published'>publish</option>;
           
         </select>
    </div>
    <div class="form-group">
        <label for="image" >Post Image</label>
        <input type="file" name="image" class="form-control-file" >
    </div>
    <div class="form-group">
        <label for="post_tags" >Post Tags</label>
        <input type="text" name="post_tags" class="form-control" >
    </div>
    <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" rows="3" id="body"></textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary mb-3 my-2" >Create</button>

</form>