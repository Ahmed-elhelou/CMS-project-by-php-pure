<table class="table table-hover table-bordered">
                        <thead>
                           
                                <th>Id</th>
                                <th>Post Title</th>
                                <th>Author</th>
                                <th>Email</th>
                                <th>content</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Aprove</th>
                                <th>Unaprove</th>
                                <th></th>
                            
                        </thead>
                        <tbody>

                        <?php 
                            $query = "SELECT * FROM comments";
                            $result_comments_query = mysqli_query($connection,$query);
                            if(!$result_comments_query){
                                die("ERROR" . mysqli_error($connection));
                            }
                            while($row = mysqli_fetch_assoc($result_comments_query)){
                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];

                                $select_post_query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                $result_select_post_query = mysqli_query($connection,$select_post_query);

                                $current_post = mysqli_fetch_assoc($result_select_post_query);
                                $current_post_title = $current_post['post_title'];

                                $comment_author = $row['comment_author'];
                                $comment_email = $row['comment_email'];
                                $comment_content = $row['comment_content'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];

                                echo "<tr>";
                               echo "<td >$comment_id</td>";
                               echo "<td><a href='../post.php?post_id=$comment_post_id'>$current_post_title</a></td>";
                               echo "<td>$comment_author</td>";
                               echo "<td>$comment_email</td>";
                               echo "<td>$comment_content</td>";
                               echo "<td>$comment_status</td>";
                               echo "<td>$comment_date</td>";
                               //echo "<td><a href='comments.php?source=edit_comment&comment_id=$comment_id'>Edit</a></td>";
                               if (in_array("aprove_comments", $user_roles_array)){

                                   echo "<td><a href='comments.php?aprove=$comment_id'>Aprove</a></td>";
                                   echo "<td><a href='comments.php?unaprove=$comment_id'>Unaprove</a></td>";
                                }
                                echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                               echo "</tr>";

                            }
                         ?>
                                <a href=""></a>
                        </tbody>
                    </table>