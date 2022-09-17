<?php
    include('../config/constants.php');
    //Destroy session
    //redirect to login page

    session_destroy();
    header('location:'.home_url.'admin/login.php');

?>
