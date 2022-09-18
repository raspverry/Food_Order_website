<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br/><br/>

            <?php 
                $id = $_GET['id'];
                $sql = "SELECT * FROM admin WHERE id=$id";

                $res = mysqli_query($conn, $sql);
                
                if($res){
                    $count = mysqli_num_rows($res);
                    if($count == 1){
                        //echo "Admin Available";
                        $row=mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $user_name = $row['user_name'];
                        
                    }
                    else{
                        header('location:'.home_url.'admin/manage_admin.php');
                    }
                }
                
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Full Name" value="<?=$full_name?>">
                        </td>
                    </tr>
                    <tr>
                        <td>User Name:</td>
                        <td>
                            <input type="text" name="user_name" placeholder="Enter your user name" value="<?=$user_name?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?=$id?>">
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
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $id = $_POST['id'];

        //echo $full_name . $username. $id;

        $sql = "UPDATE admin SET
            full_name = '$full_name',
            user_name = '$user_name'
            WHERE id='$id'
        ";
         //echo $sql;
        
         $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

         if($res){
             //echo 'yes';
             //create a Session variable to dsplay message
             $_SESSION['update'] = "<div class='success'>Admin udpated Successfully</div>";
             header("location:".home_url.'admin/manage_admin.php');
         }
         else{
            // echo 'no';
            $_SESSION['update'] = "<div class='error'>Failed to audpatedd admin</div>";
             header("location:".home_url.'admin/manage_admin.php');
         }

    }
    
?>