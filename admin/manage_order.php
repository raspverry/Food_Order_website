<?php  include('inc/header.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>order</h1>

            <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            

            <br/><br/>
            <a href="#" class="btn-primary">Add Order</a>
            <br/>
            <br/>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php
            
                    $sql = "SELECT * FROM food_order ORDER BY id DESC";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count > 0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status =$row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>

                            <tr>
                                <td><?=$sn++?></td>
                                <td><?=$food?></td>
                                <td><?=$price?></td>
                                <td><?=$qty?></td>
                                <td><?=$total?></td>
                                <td><?=$order_date?></td>

                                <td>
                                    <?php
                                        switch($status){
                                            case "Ordered":
                                                echo "<label>$status</label>";
                                                break;
                                            case "On Delivery":
                                                echo "<label style='color: orange'>$status</label>";
                                                break;
                                            case "Delivered":
                                                echo "<label style='color: green'>$status</label>";
                                                break;
                                            case "Cancelled":
                                                echo "<label style='color: red'>$status</label>";
                                                break;
                                                

                                        }
                                    ?>
                                </td>

                                <td><?=$customer_name?></td>
                                <td><?=$customer_contact?></td>
                                <td><?=$customer_email?></td>
                                <td><?=$customer_address?></td>
                                <td>
                                    <a href="<?=home_url?>admin/update_order.php?id=<?=$id?>" class="btn-secondary">Update Order</a>
                                </td>
                            </tr>

                            <?php

                        }
                    }
                    else{
                        echo "<tr><td colspan='12' class='error'>Order Not Available.</td><tr>";
                    }
            
                ?>

                

                
            </table>

      
        </div>
    </div>

    
<?php include('inc/footer.php') ?>