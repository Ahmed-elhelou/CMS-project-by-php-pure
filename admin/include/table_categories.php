<table class="table table-hover table-border">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Caregory</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                        if(isset($_GET['delete'])){
                                            $delet_cat_id = $_GET['delete'];
                                            $query = "DELETE FROM categories WHERE ";
                                            $query .= "cat_id = '$delet_cat_id'";
                                            $result_delete_cat = mysqli_query($connection,$query);
                                            header('location: categories.php');
                                        }

                                   
                                    $query_cat = "SELECT * FROM categories";
                                    $result_cat_query = mysqli_query($connection,$query_cat);
                                    if($result_cat_query){
                                        while($row = mysqli_fetch_assoc($result_cat_query)){
                                            $cat_title = $row['cat_title'];
                                            $cat_id = $row['cat_id'];
                                        
                                       

                                
                                        echo "<tr>";
                                        echo "<td>$cat_id </td>";
                                        echo "<td>$cat_title </td>";
                                        if (in_array("delete_cats", $user_roles_array)){

                                        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
                                        }
                                        if (in_array("edit_catss", $user_roles_array)){

                                        echo "<td><a href='categories.php?update= $cat_id '>edit</a></td>";
                                        }
                                        echo "</tr>";
                                     }
                                    } 
?>
                                    
                                </tbody>
                            </table>