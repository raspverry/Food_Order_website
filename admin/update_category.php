<?php include('inc/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $sql = "SELECT * FROM food_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    $_SESSION['no_category_found'] = "<div class='error'>Category not found</div>";
                    header('location:'.home_url.'admin/manage_category.php');
                }
            }
            else{
                //redirect to Manage category
                header('location:'.home_url.'admin/manage_category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value=<?=$title?>>
                    </td>
                </tr>
                
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != ""){
                                //display the image
                                ?>
                                <img src="<?=home_url?>images/category/<?=$current_image?>" width="150px">
                                <?php
                            
                            }
                            else{
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No"){echo "Checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No"){echo "Checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?=$current_image?>">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input type="submit" name="submit" value="update_category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        
        if(isset($_POST['submit'])){
            
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //upload new img if selected
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                if($image_name != ""){
                    //Auto Rename Image
                    //Get the extension of image (jpg, png ..) to prevent file having same name will replace the other
                    $ext = end(explode('.', $image_name));
                            
                    //Remane the Image
                    $image_name = "Food_Category_".time().'.'.$ext;
                            
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;
                            
                    //upload image
                    $upload = move_uploaded_file($source_path, $destination_path);
                            
                    //check whether image is uploadedor not
                    // and if the image is not uploaded -> stop it and redirect with error message
                            
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='error'>Fail to upload</div>";
                        header('location:'.home_url.'admin/manage_category.php');
                        //Stop the process
                        die();
                    }

                    if($current_image != ""){

                        //remove old image
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);
                        
                        if($remove == false){
                            $_SESSION['failed_remove'] = "<div class='error'>Fail to remove current image</div>";
                            header('location:'.home_url.'admin/manage_category.php');
                            die();
                        }
                    }

                }
                else{
                    $image_name = $current_image;
                }
            }
            else{
                $image_name = $current_image;
            }

            $sql2 = "UPDATE food_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = $id
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2){
                $_SESSION['update'] = "<div class='success'>Category Updated</div>";
                header('location:'.home_url.'admin/manage_category.php');
            }
            else{
                $_SESSION['update'] = "<div class='error'>Failed to update Category</div>";
                header('location:'.home_url.'admin/manage_category.php');

            }
        }

        ?>

    </div>

</div>


<?php include('inc/footer.php'); ?>