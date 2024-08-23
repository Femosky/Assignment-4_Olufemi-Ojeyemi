<?php
    // including the connection file
    include('includes/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
    </head>
    <body>
        <?php include "layouts/header.php" ?>

        <!-- title -->
        <h1 class="title">Orders</h1>

        <!-- main section -->
        <main>            
            <div class="orders-container">
                <!-- loops through the orders table from the database and prints all available orders -->
                <?php
                    $query = "SELECT * FROM `orders`";
                    $result = mysqli_query($db, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $products = json_decode($row['products_json'], true);
                            $sub_total = $row['total_price'] - $row['tax'];
                            ?>
                                <div class="order dark-green-border">
                                    <section class="order-short">
                                        <h3>Order ID #<?php echo $row['id'] ?></h3>

                                        <div class="info-container">
                                            <div class="product">
                                                <div class="first">
                                                    <?php
                                                        $counter = 0;

                                                        // for each loop to go through all products stored in products_json array and prints their details as well
                                                        foreach ($products as $property) {
                                                            $counter++;
                                                            ?>
                                                                <aside>
                                                                    <div class="cell">
                                                                        <p class="head">Product <?php echo $counter ?>:</p>
                                                                        <p><?php echo $property['name'] ?></p>
                                                                    </div>
                                                                    <div class="cell">
                                                                        <p class="head">Price:</p>
                                                                        <p><?php echo "$". $property['price'] . "" ?></p>
                                                                    </div>
                                                                    <div class="cell">
                                                                        <p class="head">Quanity:</p>
                                                                        <p><?php echo $property['quantity'] ?></p>
                                                                    </div>
                                                                </aside>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                        
                                                <div class="second">
                                                    <div class="cell">
                                                        <p class="head">Subtotal:</p>
                                                        <p><?php echo "$". $sub_total . "" ?></p>
                                                    </div>
                                                    <div class="cell">
                                                        <p class="head">Tax (<?php echo $row['tax_percentage'] ?>%):</p>
                                                        <p><?php echo "$". $row['tax'] . "" ?></p>
                                                    </div>
                                                    <div class="cell">
                                                        <p class="head">Total (plus tax):</p>
                                                        <p><?php echo "$". $row['total_price'] . "" ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="customer-contact">
                                            <h3>Customer Contact</h3>

                                            <div class="cell">
                                                <p class="head">Customer name:</p>
                                                <p><?php echo $row['name'] ?></p>
                                            </div>
                                            <div class="cell">
                                                <p class="head">Phone:</p>
                                                <p><?php echo $row['phone'] ?></p>
                                            </div>
                                            <div class="cell">
                                                <p class="head">Email:</p>
                                                <p><?php echo $row['email'] ?></p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="order-full">
                                        <div class="address">
                                            <h3>Address</h3>
                                            <div class="cell">
                                                <p class="head">Address:</p>
                                                <p><?php echo $row['address'] ?></p>
                                            </div>
                                            <div class="cell">
                                                <p class="head">Postcode:</p>
                                                <p><?php echo $row['postcode'] ?></p>
                                            </div>
                                            <div class="cell">
                                                <p class="head">Province:</p>
                                                <p><?php echo $row['province'] ?></p>
                                            </div>
                                        </div>         

                                        <div class="payment">
                                            <h3>Payment details</h3>
                                            <div class="cell">
                                                <p class="head">Card number:</p>
                                                <p><?php echo $row['card'] ?></p>
                                            </div>
                                            <div class="cell">
                                                <p class="head">Expiry:</p>
                                                <p><?php echo "". $row['expiry_month'] ." ". $row['expiry_year'] . ""?></p>
                                            </div>
                                        </div>           
                                    </section>
                                </div>
                            <?php
                        }
                    } else {
                        // displays if there's no order in the database
                        echo "<h2>No orders received yet.</h2>";
                    }
                ?>
            </div>
        </main>

        <!-- Insert footer code -->
        <?php include "layouts/footer.php" ?>
    </body>
</html>