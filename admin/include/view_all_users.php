<table class="table table-hover table-striped table-bordered">
                        <thead>
                           
                                <th scope="col">Id</th>
                                <th scope="col">username</th>
                                <th scope="col">first name</th>
                                <th scope="col">last name</th>
                                <th scope="col">email</th>
                                <th scope="col">Image</th>
                                <th scope="col">Role</th>
                               <?php if (in_array("delete_users", $user_roles_array)){
                                echo '<th scope="col">Delete</th>';
                                }
                                ?>
                              
                            
                        </thead>
                        <tbody>

                        <?php 
                            $query = "SELECT * FROM users";
                            $result_users_query = mysqli_query($connection,$query);
                            if(!$result_users_query){
                                die("ERROR" . mysqli_error($connection));
                            }
                            while($row = mysqli_fetch_assoc($result_users_query)){
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
                                
                                echo "<tr>";
                               echo "<td scope= 'row' >$user_id</td>";
                               echo "<td>$username</td>";
                               echo "<td><a href='../user.php?user_id=$user_id'>$user_firstname</a></td>";
                               
                               


                               echo "<td>$user_lastname</td>";
                               echo "<td>$user_email</td>";
                               echo "<td style='width:10%;' class='w-25'><img  class='img-fluid img-thumbnail img-responsive'  src='../images/$user_image' ></td>";
                               echo "<td>$user_role</td>";
                               if (in_array("edit_users", $user_roles_array)){
                               echo "<td><a href='users.php?source=edit_user&user_id=$user_id'>Edit</a></td>";

                               echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
                               echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
                               }
                               if (in_array("delete_users", $user_roles_array)){

                                   echo "<td><a onClick=\" javascript: return confirm('r u sure') \" href='users.php?delete=$user_id'>Delete</a></td>";
                               }
                               echo "</tr>";

                            }
                         ?>
                        </tbody>
                    </table>