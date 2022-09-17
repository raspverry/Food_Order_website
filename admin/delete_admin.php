<?php

    include('../config/constants.php');

    //1. get the ID of Admin to be deleted 

    //2. create SQL querty to Delete Admin

    //3. Redirect to Manage Admin page with message (success or error)

    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res){
        //echo "Admin Deleted";
        //color not working????? 
        //
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully. </div>";

        header('location:'.home_url.'admin/manage_admin.php');

        
    }
    else{
        //echo "Failed to delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete</div>";
        header('location:'.home_url.'admin/manage_admin.php');

    }

?>