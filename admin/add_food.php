<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br/><br/>

            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" step=".01" >
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
                                    $sql = "SELECT * FROM food_category WHERE active='YES'";

                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);
                                    if($count > 0){
                                        while($row = mysqli_fetch_assoc($res)){
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?=$id?>"><?=$title?></option>
                                            <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <option value="0">No Category found</option>
                                        <?php
                                    }
                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php
                if(isset($_POST['submit'])){
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    //for radio button, have to check whether the button is selected
                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }
                    else{
                        //default value
                        $featured = 'No';
                    }
                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }
                    else{
                        //default value
                        $active = 'No';
                    }

                    if(isset($_FILES['image']['name'])){
                        //to upload image, need image name, path and destination path
                        $image_name = $_FILES['image']['name'];
                        
                        //upload the image only if image selected
                        if($image_name != ""){

                            
                            //Auto Rename Image
                            //Get the extension of image (jpg, png ..) to prevent file having same name will replace the other
                            $ext = explode('.', $image_name);
                            $ext = end($ext);
                            
                            //Remane the Image
                            $image_name = "Food_Name_".time().'.'.$ext;
                            echo $image_name;
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/food/".$image_name;
                            
                            //upload image
                            $upload = move_uploaded_file($source_path, $destination_path);
                            
                            //check whether image is uploadedor not
                            // and if the image is not uploaded -> stop it and redirect with error message
                            
                            if($upload == false){
                                $_SESSION['upload'] = "<div class='error'>Fail to upload..</div>";
                                header('location:'.home_url.'admin/add_food.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else{
                        //dont upload image and set the image name value to blank
                        $image_name = "";
                    }


                    $sql2 = "INSERT INTO food_info SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name='$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    $res2 = mysqli_query($conn, $sql2);
                
                    
                    if($res2){
                        $_SESSION['add'] = "<div class='success'>Food added</div>";
                        header('location:'.home_url.'admin/manage_food.php');
                    }
                    else{
                        
                        $_SESSION['add'] = "<div class='error'>Fail to add Food</div>";
                        header('location:'.home_url.'admin/add_food.php');
                    }

                }
            ?>


        </div>
    </div>

    
<?php include('inc/footer.php') ?>
