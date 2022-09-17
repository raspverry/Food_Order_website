<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>

        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no_login'])){
                echo $_SESSION['no_login'];
                unset($_SESSION['no_login']);
            }
        ?>
        <br><br>

        <form action="" method="POST" class="text-center">
        Username:<br>
        <input type="text" name="user_name" placeholder="Enter User Name"><br><br>
        Password:<br>
        <input type="password" name="password" placeholder="Enter Password"><br><br>
        
        <input type="submit" name="submit" value="login" class="btn-primary"><br><br>


        </form>


        <p class="text-center">Created by - <a href="https://github.com/raspverry">Hansol</a></p>
    </div>
    
</body>
</html>

<?php 
    if(isset($_POST['submit'])){
        $user_name = $_POST['user_name'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admin WHERE user_name='$user_name' and password='$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
            $_SESSION['login'] = "<div class='success'>Login Successful. </div>";
            $_SESSION['user'] = $user_name; // to check the user is logged in or not 
            
            
            header('location:'.home_url.'admin/');
        }
        else{
            $_SESSION['login'] = "<div class='error text-center'>Login Failed. </div>";
            header('location:'.home_url.'admin/login.php');
        }

    }



?>