<?php include('inc_front/header.php');?>

    <?php
        if(isset($_GET['category_id'])){
            $category_id = $_GET['category_id'];

            $sql = "SELECT title FROM food_category WHERE id=$category_id";

            $res = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($res);

            $category_title = $row['title'];
        }
        else{
            header('location:'.home_url);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?=$category_title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * FROM food_info WHERE category_id=$category_id";

                $res2 = mysqli_query($conn, $sql2);

                $count = mysqli_num_rows($res2);

                if($count > 0){
                    while($row2 = mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];

                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name==""){
                                        echo "<div class='error'>No Food Available</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="<?=home_url?>images/food/<?=$image_name?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?=$title?></h4>
                                <p class="food-price">$<?=$price?></p>
                                <p class="food-detail">
                                    <?=$description?>
                                </p>
                                <br>

                                <a href="<?=home_url?>order.php?food_id=<?=$id?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else{
                    echo "<div class='error'>No food available</div>";
                }
            ?>


            
          


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('inc_front/footer.php');?>