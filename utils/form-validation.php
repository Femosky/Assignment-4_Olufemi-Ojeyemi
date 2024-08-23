<?php

// including the database connection file
include('../includes/db_connection.php');

// Setting the prices of each product
$product_prices = [
    'Amazon Gift Card' => 10,
    'Apple Gift Card' => 15,
    'Playstation Gift Card' => 20,
    'Spotify Gift Card' => 25,
];

// Initializing the global variables
$total_price = 0.0;
$tax = 0.0;

$products_database = [];

// getting submitted form data
$name = $_POST['name'] ?? "";
$email = $_POST['email'] ?? "";
$phone = $_POST['phone'] ?? "";
$postcode = $_POST['postcode'] ?? "";
$address = $_POST['address'] ?? "";
$province = $_POST['province'] ?? "";
$password = $_POST['password'] ?? "";
$confirm_password = $_POST['confirm'] ?? "";
$card = $_POST['card'] ?? "";
$month = $_POST['month'] ?? "";
$year = $_POST['year'] ?? "";

// checking if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // getting the selected products and quantities by the user
    $selected_products = $_POST['products'] ?? [];
    $quantities = $_POST['quantities'] ?? [];
    $counter = 0;

    // looping through the selected products array to calculate the total price
    foreach ($selected_products as $product) {
        $counter++;
        if (isset($product_prices[$product]) && isset($quantities[$product]) && is_numeric($quantities[$product])) {
            // Calculate product price and update total price
            $quantity = $quantities[$product];
            $product_price = $product_prices[$product];
            $total_price += $product_price * $quantity;
        }
    }

    // Calculate tax based on total price and province
    $tax = calculateTax($total_price, $province);
}

// utitlity function used above to calculate the tax
function calculateTax($total_price, $province) {
    // initializing the tax as 0.0
    $tax = 0.0;

    // Define tax rates for each province
    $tax_rates = [
        'AB' => 0.0,
        'BC' => 0.12,
        'MB' => 0.07,
        'NB' => 0.15,
        'NL' => 0.15,
        'NT' => 0.05,
        'NS' => 0.15,
        'NU' => 0.05,
        'ON' => 0.13,
        'PE' => 0.15,
        'QC' => 0.09975,
        'SK' => 0.06,
        'YT' => 0.05,
    ];

    // check if the user selected a province and calulating the tax based on it
    if (isset($tax_rates[$province])) {
        // Calculate tax based on tax rate and total price
        $tax_rate = $tax_rates[$province];
        $tax = $tax_rate * $total_price;
    }

    // returning the tax to be grabbed when called above
    return $tax;
}

// initializing the tax percentage variable to be later used in the receipt to show the user how much percentage their tax is
$taxPercentage = 0.0;

if ($total_price > 0) {
    $taxPercentage = ($tax / $total_price) * 100;
}

// calculate the final total price which includes tax
$final_total = $total_price + $tax;

// taxPrice stores the total tax of the order tio be used in the receipt
$taxPrice = calculateTax($total_price, $province);

// Formatted html code to be printed along with all calculated data in the receipt.
$receipt = '
    <h2 class="receipt-heading">Receipt</h2>
    <div class="receipt-container">
        <div class="user-details">
            <div class="user-detail">
                <h3>Personal details:</h3>
                <div class="cell">
                    <p class="head">Name</p>
                    <p>'. $name .'</p>
                </div>
                <div class="cell">
                    <p class="head">Email</p>
                    <p>'. $email . '</p>
                </div>
                <div class="cell">
                    <p class="head">Phone number</p>
                    <p>'. $phone. '</p>
                </div>
                <div class="cell">
                    <p class="head">Address</p>
                    <p>'. $address .'</p>
                </div>
                <div class="cell">
                    <p class="head">Postcode</p>
                    <p>'. $postcode .'</p>
                </div>
            </div>
            <div class="user-detail">
                <h3>Payment details:</h3>
                <div class="cell">
                    <p class="head">Card number</p>
                    <p>'. $card .'</p>
                </div>
                <div class="cell">
                    <p class="head">Expiry</p>
                    <div class="month-year">
                        <div>'. $month .'</div>
                        <div>'. $year .'</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-details">
            <h3>Order details</h3>
            <div class="product-detail">
                <div class="receipt-product-items">';
                    // this section loops over the products selected by the user and prints their name, price, and quantity
                    $selected_products = $_POST['products'] ?? [];
                    $counter = 1;

                    foreach ($selected_products as $product) {
                        $quantity = $_POST['quantities'][$product] ?? 1;

                        $receipt .= '
                            <div class="receipt-item-container">
                                <p class="head-item">Product '. $counter . '</p>
                                <div class="receipt-product-item">
                                    <div class="cell">
                                        <p class="head">Product:</p>
                                        <p>'. $product .'</p>
                                    </div>
                                    <div class="cell">
                                        <p class="head">Quantity:</p>
                                        <p>'. $quantity .'</p>
                                    </div>
                                    <div class="cell">
                                        <p class="head">Price:</p>
                                        <p>$'. $product_prices[$product] .'</p>
                                    </div>
                                </div>
                            </div>';

                        // saving the product details into an object to be sent over to the database
                        $product_details = array(
                            'name' => $product,
                            'price' => $product_prices[$product],
                            'quantity' => $quantity
                        );

                        // pushing to the product details object into an array to house all products selected for submission to the database
                        array_push($products_database, $product_details);

                        $counter++;
                    }
                $receipt .= '
                </div>

                <div class="cell-two">
                    <p class="head">Tax ('. $taxPercentage. '%):</p>
                    <p>$'. $tax .'</p>
                </div>

                <div class="cell-two">
                    <p class="head">Total price (plus tax):</p>
                    <p>$'. $final_total .'</p>
                </div>
            </div>
        </div>
    </div>
';

// saving the all order details to an array to be ssent over to the database
$orderDetails = array(
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'postcode' => $postcode,
    'address' => $address,
    'province' => $province,
    'password' => $password,
    'card' => $card,
    'expiry_month' => $month,
    'expiry_year' => $year,
    'products_json' => json_encode($products_database),
    'tax_percentage' => $taxPercentage,
    'tax' => $taxPrice,
    'total_price' => $final_total
);

// used to prevent mysql injection
foreach ($orderDetails as &$value) {
    $value = mysqli_real_escape_string($db, $value);
}

// setting up the query
$query = "INSERT INTO orders (`name`, `email`, `phone`, `postcode`, `address`, `province`, `password`, `card`, `expiry_month`, `expiry_year`, `products_json`, `tax_percentage`, `tax`, `total_price`)
        VALUES ('{$orderDetails['name']}', '{$orderDetails['email']}', '{$orderDetails['phone']}', '{$orderDetails['postcode']}', '{$orderDetails['address']}', '{$orderDetails['province']}', '{$orderDetails['password']}', '{$orderDetails['card']}', '{$orderDetails['expiry_month']}', '{$orderDetails['expiry_year']}', '{$orderDetails['products_json']}', '{$orderDetails['tax_percentage']}', '{$orderDetails['tax']}', '{$orderDetails['total_price']}')";

// sending the data to the database to insert a new order
$result = mysqli_query($db, $query);

$messageFromDatabase = '';

// checks to see if the database submission was successful
if ($result) {
    $message = "
        <div class='w-full flex flex-column align-center gap-20 margin-block'>
            <p class='success'>Order placed! Receipt Generated Below.</p>
            
            <div class='submit-button-container'>
                <button onclick=\"window.location.href = '/'\" class='submit-button-green'>New Order?</button>
            </div>
        </div>
    ";

    $messageFromDatabase = $message;
} else {
    $message = "
        <div class='w-full flex flex-column align-center gap-20 margin-block'>
            <p class='error text-center margin-block'>Error: unable to reach database, turn on mysql</p>
            
            <div class='submit-button-container'>
                <button onclick=\"window.location.href = '/'\" class='submit-button-green'>Refresh</button>
            </div>
        </div>
    ";

    $messageFromDatabase = $message;
}

// preparing the response to be sent back to AJAX
$response = array(
    'receipt' => $receipt,
    'message' => $messageFromDatabase,
);

// encoding the response into json and sending it to AJAX
echo json_encode($response);