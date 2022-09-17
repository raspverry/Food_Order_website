<?php

    include('../config/constants.php');

    // check id and image name

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove image file
        if($image_name != ""){
            //image is available
            $path = "../images/category/".$image_name;

            //remove image
            $remove = unlink($path);

            //if failed to remove image, then add an error message and stop the process
            if($remove == false){
                //set the session message
                //redirect to maanage category page and stop the process
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";

                header('location:'.home_url.'admin/manage_category.php');

                die();
            }

        }


        //delete data from db
        $sql = "DELETE FROM food_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res){
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
            header('location:'.home_url.'admin/manage_category.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category</div>";
            header('location:'.home_url.'admin/manage_category.php');
        }


        //redirect to manage category page with message
    }
    else{
        //redirect to manage category page
        header('location:'.home_url.'admin/manage_category.php');

        
    }

?>