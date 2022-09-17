<?php 
    //check whetehr the user is logged in or not
    //Authorization - access control

    if(!isset($_SESSION['user'])){
        $_SESSION['no_login'] = "<div class='error text-center'>Please login to access Admin panel</div>";
        header('location:'.home_url.'admin/login.php');
    }

?>