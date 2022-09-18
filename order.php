<?php include('inc_front/header.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <?php
            
                if(isset($_GET['food_id'])){
                    $food_id = $_GET['food_id'];

                    $sql = "SELECT * FROM food_info WHERE id=$food_id";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);

                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                    }
                    else{
                        header('location:'.home_url);
                    }

                }
                else{
                    header('location:'.home_url);
                }
            
            ?>

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            if($image_name==""){
                                //image not available
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else{
                                ?>
                                <img src="<?=home_url?>images/food/<?=$image_name?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?=$title?></h3>
                        <input type="hidden" name="food" value="<?=$title?>">
                        <p class="food-price">$<?=$price?></p>
                        <input type="hidden" name="price" value="<?=$price?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter the full name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter the phone number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter the email" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                if(isset($_POST['submit'])){
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date('Y-m-d h:i:s');

                    $status = 'Ordered';
                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact =mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
                    
                    $sql2 = "INSERT INTO food_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";
                    
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2){
                        $_SESSION['order'] = "<div class='success text-center'>Order has been placed. </div>";
                        header('location:'.home_url);
                    }
                    else{
                        $_SESSION['order'] = "<div class='error text-center'>Fail to order the food. </div>";
                        header('location:'.home_url);
                    }

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('inc_front/footer.php');?>