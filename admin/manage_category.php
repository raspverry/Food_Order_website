<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Category</h1>
            <br/><br/>

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
                if(isset($_SESSION['no_category_found'])){
                    echo $_SESSION['no_category_found'];
                    unset($_SESSION['no_category_found']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['failed_remove'])){
                    echo $_SESSION['failed_remove'];
                    unset($_SESSION['failed_remove']);
                }
            ?>
            <br><br>

            <a href="<?=home_url?>admin/add_category.php" class="btn-primary">Add Category</a>
            <br/>
            <br/>

            
            
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM food_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $sn=1;

                    if($count > 0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                            <tr>
                                <td><?=$sn++?></td>
                                <td><?=$title?></td>
                                <td><?php
                                    if($image_name!=""){

                                        ?>

                                        <img src="<?=home_url?>images/category/<?=$image_name;?>" width="100px" >

                                        <?php
                                    }
                                    else{
                                        echo "<div class='error'>No images</div>";
                                    }
                                
                                ?>
                                </td>
                                <td><?=$featured?></td>
                                <td><?=$active?></td>
                                <td>
                                    <a href="<?=home_url?>admin/update_category.php?id=<?=$id?>" class="btn-secondary">Update Category</a>
                                    <a href="<?=home_url?>admin/delete_category.php?id=<?=$id?>&image_name=<?=$image_name?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>


                            <?php
                        }
                    }
                    else{
                        //no data
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>
                        <?php
                    }
                ?>
                

                
            </table>
      
        </div>
    </div>

    
<?php include('inc/footer.php') ?>