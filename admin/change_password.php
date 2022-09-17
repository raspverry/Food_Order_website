<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br/><br/>

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                
                
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Currrent Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";

        $res = mysqli_query($conn,$sql);

        if($res){
            $count=mysqli_num_rows($res);
            if($count == 1){
                //echo 'found';
                if($new_password == $confirm_password){
                    $sql2 = "UPDATE admin SET
                        password = '$new_password'
                        WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2){
                        $_SESSION['pwd_change'] = "<div class='success'>Password change Success</div>";
                        header("location:".home_url.'admin/manage_admin.php');
                    }
                    else{
                        $_SESSION['pwd_change'] = "<div class='error'>Password change failed</div>";
                        header("location:".home_url.'admin/manage_admin.php');
                    }
                }
                else{
                    $_SESSION['pwd_wrong'] = "<div class='success'>Password not match</div>";
                    header("location:".home_url.'admin/manage_admin.php');
                }
            }
            else{
                $_SESSION['pwd_wrong'] = "<div class='success'>User Not Found</div>";
                header("location:".home_url.'admin/manage_admin.php');
            }
        }

        // $sql = "UPDATE admin SET
        //     full_name = '$full_name',
        //     user_name = '$user_name'
        //     WHERE id='$id'
        // ";
        //  //echo $sql;
        
        //  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //  if($res){
        //      //echo 'yes';
        //      //create a Session variable to dsplay message
        //      $_SESSION['update'] = "<div class='success'>Admin udpated Successfully</div>";
        //      header("location:".home_url.'admin/manage_admin.php');
        //  }
        //  else{
        //     // echo 'no';
        //     $_SESSION['update'] = "<div class='error'>Failed to audpatedd admin</div>";
        //      header("location:".home_url.'admin/manage_admin.php');
        //  }

    }
    
?>