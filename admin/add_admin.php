<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br/><br/>

            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Full Name">
                        </td>
                    </tr>
                    <tr>
                        <td>User Name:</td>
                        <td>
                            <input type="text" name="user_name" placeholder="Enter your user name">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Enter your password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>
    </div>

    
<?php include('inc/footer.php') ?>

<?php 
    //Process the value from form and save it in DB
    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password = md5($_POST['password']); //md5 is encryption function

        

        //echo $full_name . $username. $password;

        $sql = "INSERT INTO admin SET
            full_name = '$full_name',
            user_name = '$user_name',
            password = '$password'
        ";
         //echo $sql;
        
         $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

         if($res){
             //echo 'yes';
             //create a Session variable to dsplay message
             $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
             header("location:".home_url.'admin/manage_admin.php');
         }
         else{
            // echo 'no';
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
             header("location:".home_url.'admin/add_admin.php');
         }

    }
    
?>