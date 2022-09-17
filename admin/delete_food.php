<?php

    include('../config/constants.php');

    // check id and image name

    if(isset($_GET['id']) && isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove image file
        if($image_name != ""){
            //image is available
            $path = "../images/food/".$image_name;

            //remove image
            $remove = unlink($path);

            //if failed to remove image, then add an error message and stop the process
            if($remove == false){
                //set the session message
                //redirect to maanage category page and stop the process
                $_SESSION['remove'] = "<div class='error'>Failed to remove food image</div>";

                header('location:'.home_url.'admin/manage_food.php');

                die();
            }

        }


        //delete data from db
        $sql = "DELETE FROM food_info WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        //redirect to manage category page with message
        if($res){
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
            header('location:'.home_url.'admin/manage_food.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete Food</div>";
            header('location:'.home_url.'admin/manage_food.php');
        }


    }
    else{
        //redirect to manage food page
        $_SESSION['delete'] = "<div class='error'>Unauthorized Access</div>";

        header('location:'.home_url.'admin/manage_food.php');

        
    }

?>