<?php include('inc/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $sql = "SELECT * FROM food_info WHERE id=$id";
                
                $res = mysqli_query($conn, $sql);

                $count2 = mysqli_num_rows($res);

                if($count2 == 1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $current_category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    $_SESSION['no_food_found'] = "<div class='error'>Food not found</div>";
                    header('location:'.home_url.'admin/manage_food.php');
                }
            }
            else{
                //redirect to Manage category
                $_SESSION['no_food_found'] = "<div class='error'>Unauthorized Access</div>";

                header('location:'.home_url.'admin/manage_food.php');
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
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5" ><?=$description?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" step=".01" value="<?=$price?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image == ""){
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?=home_url ?>images/food/<?=$current_image;?>" width="100px">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category" >

                                <?php
                                    //create php code to display categories
                                    $sql2 = "SELECT * FROM food_category WHERE active='Yes'";

                                    $res2 = mysqli_query($conn, $sql2);

                                    $count = mysqli_num_rows($res2);
                                    if($count > 0){
                                        while($row2 = mysqli_fetch_assoc($res2)){
                                            $category_id = $row2['id'];
                                            $category_title = $row2['title'];
                                            
                                            ?>
                                            <option <?php if($current_category == $category_id){echo "Selected";} ?> value="<?=$category_id?>"><?=$category_title?></option>
                                            <?php
                                        }
                                    }
                                    else{
                                        echo "<option value='0'>Category Not Available. </option>";
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="current_image" value="<?=$current_image?>">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>

            </table>
        </form>

        <?php
        
        if(isset($_POST['submit'])){
            
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //upload new img if selected
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                if($image_name != ""){
                    //Auto Rename Image
                    //Get the extension of image (jpg, png ..) to prevent file having same name will replace the other
                    $ext = explode('.', $image_name);
                    $ext = end($ext);
                            
                    //Remane the Image
                    $image_name = "Food_Name_".time().'.'.$ext;
                            
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/".$image_name;
                            
                    //upload image
                    $upload = move_uploaded_file($source_path, $destination_path);
                            
                    //check whether image is uploadedor not
                    // and if the image is not uploaded -> stop it and redirect with error message
                            
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='error'>Fail to upload</div>";
                        header('location:'.home_url.'admin/manage_food.php');
                        //Stop the process
                        die();
                    }

                    if($current_image != ""){

                        //remove old image
                        $remove_path = "../images/food/".$current_image;
                        $remove = unlink($remove_path);
                        
                        if($remove == false){
                            $_SESSION['failed_remove'] = "<div class='error'>Fail to remove current image</div>";
                            header('location:'.home_url.'admin/manage_food.php');
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

            $sql3 = "UPDATE food_info SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id = $id
            ";

            $res3 = mysqli_query($conn, $sql3);
            
            if($res3){
                $_SESSION['update'] = "<div class='success'>Food Updated</div>";
                header('location:'.home_url.'admin/manage_food.php');
            }
            else{
                
                $_SESSION['update'] = "<div class='error'>Failed to update Food</div>";
                //header('location:'.home_url.'admin/manage_food.php');

            }
        }

        ?>

    </div>

</div>


<?php include('inc/footer.php'); ?>