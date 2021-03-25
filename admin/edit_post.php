<?php
    if(isset($_GET['source'])){
        $edit_post_id = $_GET['post_id'];
        
        
        $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
        $result_edit_post_query = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result_edit_post_query);
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];

    }
 
    if(isset($_POST['update'])){
        
        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        
        $post_date = date('d-m-y');

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        move_uploaded_file($post_image_temp,"../images/$post_image");

         if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
            $result_select_image_query = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($result_select_image_query);

            $post_image = $row['post_image'];
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title    = '$post_title', ";
        $query .= "post_cat_id   = $post_cat_id, ";
        $query .= "post_date     = now(), ";
        $query .= "post_author   = '$post_author', ";
        $query .= "post_status   = '$post_status', ";
        $query .= "post_tags     = '$post_tags', ";
        $query .= "post_content  = '$post_content', ";
        $query .= "post_image    = '$post_image' ";
        $query .= "WHERE post_id = $post_id";
        
        $result_edit_post_query = mysqli_query($connection , $query);
        
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title" >Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" name="post_title"  class="form-control" >
    </div>
    <div class="form-group ">
        <label for="post_cat_id" >Post Category Id</label>
        <select name="post_cat_id" class="form-control ">
            <?php
                $query = "SELECT * FROM categories";
                $result_cat_query = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($result_cat_query)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo $cat_id;
                    if($post_cat_id == $cat_id){

                        echo "<option selected value='$cat_id'>$cat_title</option>";
                    }else{

                        echo "<option value='$cat_id'>$cat_title</option>";
                    }
                }
            ?>
         </select>
        
    </div>
    <div class="form-group">
        <label for="post_author" >Post Author</label>
        <input value="<?php echo $post_author ?>"  type="text" name="post_author" class="form-control" >
    </div>
    <div class="form-group">
        <label for="post_status" >Post Status</label>
        <select name="post_status" class="form-control ">
            <option <?php if($post_status=='draft') {echo "selected"; } ?> value='draft'>draft</option>;
            <option <?php if($post_status=='published') {echo "selected"; } ?> value='published'>publish</option>;
           
         </select>
        <!-- <input value="<?php echo $post_status ?>"  type="text" name="post_status" class="form-control" > -->
    </div>
    <div class="form-group">
        <label for="image" >Post Image</label>
        <img style='width:10%;' class=' img-thumbnail img-responsive'  src='../images/<?php echo $post_image ?>' >
        <input value="<?php echo $post_image ?>"  type="file" name="image" class="form-control-file" >
    </div>
    <div class="form-group">
        <label for="post_tags" >Post Tags</label>
        <input value="<?php echo $post_tags ?>"  type="text" name="post_tags" class="form-control" >
    </div>
    <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea  id="body" class="form-control" name="post_content" rows="3"><?php echo $post_content ?></textarea>
  </div>
  <button type="submit" name="update" class="btn btn-success mb-3 my-2" >Update</button>

</form>