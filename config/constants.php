<?php 
    ob_start();
    //session
    session_start();


    //Create constants to store non-repeating values
    define('home_url', 'http://localhost/foodOrder/');
    define('HOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food_order');
    

    $conn = mysqli_connect(HOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

    

?>