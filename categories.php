<?php include('inc_front/header.php');?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            
                $sql = "SELECT * FROM food_category WHERE active='Yes' ";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>

                        <a href="category-foods.html">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name ==""){
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?=home_url?>images/category/<?=$image_name?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?=$title?></h3>
                        </div>
                        </a>
                        <?php
                    }
                }
                else{
                    echo "<div class='error'>No category available</div>";
                }

            ?>


            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('inc_front/footer.php');?>