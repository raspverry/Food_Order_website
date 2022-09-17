<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Admin</h1>
            <br/><br/>

            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); //remove session
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']); 
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']); 
                }
                if(isset($_SESSION['pwd_wrong'])){
                    echo $_SESSION['pwd_wrong'];
                    unset($_SESSION['pwd_wrong']); 
                }
                if(isset($_SESSION['pwd_change'])){
                    echo $_SESSION['pwd_change'];
                    unset($_SESSION['pwd_change']); 
                }
            ?>
            <br/><br/><br/>

            <a href="add_admin.php" class="btn-primary">Add Admin</a>
            <br/>
            <br/>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    $sql = "SELECT * FROM admin";
                    $res = mysqli_query($conn,$sql);
                    
                    if($res){
                        //Count rows to check whetheer we have data in db
                        $rows = mysqli_num_rows($res);
                        
                        $sn = 1;

                        //check num of rows
                        if($rows > 0){
                            //we have data in db
                            while($rows=mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $user_name = $rows['user_name'];
                                //display value in the table
                                ?>

                                <tr>
                                    <td><?=$sn++?></td>
                                    <td><?=$full_name?></td>
                                    <td><?=$user_name?></td>
                                    <td>
                                        <a href="<?=home_url?>admin/change_password.php?id=<?=$id?>" class="btn-primary">Change Password</a>
                                        <a href="<?=home_url?>admin/update_admin.php?id=<?=$id?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?=home_url?>admin/delete_admin.php?id=<?=$id?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else{
                            //no data in db
                        }
                    }
                ?>

       
            </table>
      
        </div>
    </div>

    
<?php include('inc/footer.php') ?>