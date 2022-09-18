<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <div class="col-4 text-center">

                <?php
                    $sql = "SELECT * FROM food_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                
                ?>


                <h1><?=$count?></h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <?php
                    $sql2 = "SELECT * FROM food_info";

                    $res2 = mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2);
                
                ?>

                <h1><?=$count2?></h1>
                <br />
                Foods
            </div>

            <div class="col-4 text-center">
                <?php
                    $sql3 = "SELECT * FROM food_order";

                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3);
                
                ?>
                <h1><?=$count3?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">

                <?php
                    //calculated total income without cancelled order
                    $sql4 = "SELECT SUM(total) AS Total FROM food_order WHERE status='Delivered'";

                    $res4 = mysqli_query($conn, $sql4);

                    $row = mysqli_fetch_assoc($res4);

                    $revenue = $row['Total'];
                ?>

                <h1>$ <?=$revenue?></h1>
                <br />
                Revenue Generated
            </div>

            <div class="clearfix"></div>

        </div>
    </div>

    
<?php include('inc/footer.php') ?>