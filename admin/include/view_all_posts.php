<?php 
    if(isset($_POST['check_box_array'])){
        $bulk_options = $_POST['bulk_options'];
        
        foreach ($_POST['check_box_array'] as $post_id) {
            
            switch ($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status   = 'published' WHERE post_id = $post_id";
                    $result_publish = mysqli_query($connection, $query);
                    break;
                 case 'draft':
                    $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $post_id";
                    $result_publish = mysqli_query($connection, $query);
                    break;
               
                 case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $result_posts_query = mysqli_query($connection,$query);
                    if(!$result_posts_query){
                        die("ERROR" . mysqli_error($connection));
                    }

                   while($row = mysqli_fetch_array($result_posts_query)){

                       $post_author = $row['post_author'];
                       $post_title = $row['post_title'];
                       $post_cat_id = $row['post_cat_id'];
                       $post_status = $row['post_status'];
                       $post_image = $row['post_image'];
                       $post_tags = $row['post_tags'];
                       $post_comment_count = $row['post_comment_count'];
                       $post_date = $row['post_date'];

                       $query = "INSERT INTO posts(post_title, post_cat_id, post_author, post_status, post_image, post_tags, post_content, post_date) ";
        $query .= "VALUES('$post_title', $post_cat_id, '$post_author', '$post_status', '$post_image', '$post_tags', '$post_content',  now())";
        $result_add_post_query = mysqli_query($connection , $query);
                   }
                        

                    break;
               
                 case 'delete':
                    $query = "DELETE FROM posts WHERE ";
                    $query .= "post_id = '$post_id'";
                    $result_delete_post = mysqli_query($connection,$query);
                    
                    break;
                
                default:
                header('location: posts.php');
                    break;
            }
            header('location: posts.php');
        }
    }
?>

<form action="" method="post" class="">
<table class="table table-hover table-bordered table-striped">


    <div id="bulkOptionContainer"  class="col-xs-4">
        <select name="bulk_options"  id="" class="form-control">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="clone">Clone</option>
            <?php if (in_array("delete_posts", $user_roles_array)){ ?>
            <option value="delete">Delete</option>
            <?php } ?>
        </select>
    </div>
    <div class="col-xs-4">
        <input onClick=" javascript: return confirm('r u sure') " class="btn btn-success" type="submit" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>
    </div>
                        <thead>
                           
                                <th scope="col"><input type="checkbox" class="selectAll" name="selectAll" id="checkAll"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Author</th>
                                <th scope="col">Title</th>
                                <th scope="col">Categories</th>
                                <th scope="col">Status</th>
                                <th scope="col">Image</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Comments</th>
                               
                                <th scope="col">Date</th>

                                <?php if (in_array("edit_posts", $user_roles_array)){ ?>
                                <th scope="col">Edit</th>
                                <?php } ?>
                                <?php if (in_array("edit_posts", $user_roles_array)){ ?>
                                <th scope="col">Delete</th>
                                <?php } ?>
                                <th scope="col">Views</th>
                            
                        </thead>
                        <tbody>

                        <?php 
                            $query = "SELECT * FROM posts ORDER BY post_id DESC";
                            $result_posts_query = mysqli_query($connection,$query);
                            if(!$result_posts_query){
                                die("ERROR" . mysqli_error($connection));
                            }
                            while($row = mysqli_fetch_assoc($result_posts_query)){
                                $post_id = $row['post_id'];
                                $post_author = $row['post_author'];
                                $post_title = $row['post_title'];
                                $post_cat_id = $row['post_cat_id'];
                                $post_status = $row['post_status'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_views_count = $row['post_views_count'];
                                $post_date = $row['post_date'];
                                if (!in_array("see_drafts", $user_roles_array) && $post_status == "draft" ){
                                    continue;
                                }
                                echo "<tr>";
                echo "<td scope='row'><input value='$post_id' type='checkbox' class='selectPost' name='check_box_array[]' id=''></td>";
                               
                               echo "<td scope='row'>$post_id</td>";
                               echo "<td>$post_author</td>";
                               echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";
                               $query_cat = "SELECT * FROM categories WHERE cat_id = $post_cat_id";
                               $result_cat_query = mysqli_query($connection,$query_cat);
                                $row_cat = mysqli_fetch_assoc($result_cat_query); 

                                   $cat_title = $row_cat['cat_title'];
                                  echo "<td>$cat_title</td>";
                               
                               


                               echo "<td>$post_status</td>";
                               echo "<td style='width:10%;' class='w-25'><img  class='img-fluid img-thumbnail img-responsive'  src='../images/$post_image' ></td>";
                               echo "<td>$post_tags</td>";


                               $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                               $result_count_comment = mysqli_query($connection, $query);
                               $post_comment_count = mysqli_num_rows($result_count_comment);
                               
                               echo "<td>$post_comment_count</td>";
                               echo "<td>$post_date</td>";

                               if (in_array("edit_posts", $user_roles_array)){ 
                                    echo "<td><a href='posts.php?source=edit_post&post_id=$post_id'>Edit</a></td>";
                               }
                               if (in_array("delete_posts", $user_roles_array)){
                               echo "<td><a onClick=\" javascript: return confirm('r u sure') \" href='posts.php?delete=$post_id'>Delete</a></td>";
                               }
                               echo "<td>$post_views_count</td>";
                               echo "</tr>";

                            }
                         ?>
                                <a href=""></a>
                        </tbody>

                    </table>
                        </form>