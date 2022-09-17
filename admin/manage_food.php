<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>food</h1>

            <br/><br/>
            <a href="<?=home_url?>admin/add_food.php" class="btn-primary">Add Food</a>
            <br/>
            <br/>

            <?php
            
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['no_food_found'])){
                    echo $_SESSION['no_food_found'];
                    unset($_SESSION['no_food_found']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['failed_remove'])){
                    echo $_SESSION['failed_remove'];
                    unset($_SESSION['failed_remove']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            
            ?>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM food_info";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                            <tr>
                                <td><?=$sn++?></td>
                                <td><?=$title?></td>
                                <td><?=$price?></td>
                                <td>
                                    <?php
                                        if($image_name == ""){
                                            echo "<div class='error'>No image</div>";
                                        }
                                        else{
                                            ?>
                                            <img src="<?=home_url?>/images/food/<?=$image_name?>" width="100px">
                                            <?php
                                        }
                                
                                
                                    ?>
                                </td>
                                <td><?=$featured?></td>
                                <td><?=$active?></td>
                                <td>
                                    <a href="<?=home_url?>admin/update_food.php?id=<?=$id?>" class="btn-secondary">Update food</a>
                                    <a href="<?=home_url?>admin/delete_food.php?id=<?=$id?>&image_name=<?=$image_name?>" class="btn-danger">Delete food</a>
                                </td>
                            </tr>
                            <?php

                        }
                    }
                    else{
                        echo "<tr><td colspan='7' class='error'>Food not added Yet.</td></tr>";
                    }
                
                ?>

                

                

                
            </table>

      
        </div>
    </div>

    
<?php include('inc/footer.php') ?>