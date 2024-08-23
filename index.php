<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
    </head>
    <body>
        <?php include "layouts/header.php" ?>

        <!-- Main section - Consits of the form tag with all products and wrapped in for the sake of the php form validation -->
        <main>
            <section class="item-section">
                <!-- Form that submits when the "Place order" button is clicked via the "submit" type being handled by AJAX -->
                <form action="" method="post" id="order-form" class="form-container">
                    <!-- Products section -->
                    <h2>Gift Cards</h2>

                    <!-- Container to house the products -->
                    <section class="products-container">
                        <!-- Product 1 container -->
                        <div class="product-container">
                            <div class="image-container">
                                <img src="assets/product images/amazon.jpg" alt="amazon gift card">
                            </div>

                            <div class="product-text-details">
                                <div class="product-name">Amazon Gift Card</div>
                                
                                <div class="quantity">
                                    <select id="dropdown-quantity-1" name='quantities[Amazon Gift Card]'>
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <input type="checkbox" id="product1" name="products[]" value='Amazon Gift Card'>
                                </div>
                            </div>
                            
                            <p class="product-price">$10</p>
                        </div>

                        <!-- Product 2 container -->
                        <div class="product-container">
                            <div class="image-container">
                                <img src="assets/product images/apple.jpeg" alt="apple gift card">
                            </div>

                            <div class="product-text-details">
                                <div class="product-name">Apple Gift Card</div>
                                
                                <div class="quantity">
                                    <select id="dropdown-quantity-2" name='quantities[Apple Gift Card]'>
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <input type="checkbox" id="product2" name="products[]" value='Apple Gift Card'>
                                </div>
                            </div>
                            
                            <p class="product-price">$15</p>
                        </div>

                        <!-- Product 3 container -->
                        <div class="product-container">
                            <div class="image-container">
                                <img src="assets/product images/playstation.jpg" alt="playstation gift card">
                            </div>

                            <div class="product-text-details">
                                <div class="product-name">Playstation Gift Card</div>
                                
                                <div class="quantity">
                                    <select id="dropdown-quantity-3" name='quantities[Playstation Gift Card]'>
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <input type="checkbox" id="product3" name="products[]" value='Playstation Gift Card'>
                                </div>
                            </div>
                            
                            <p class="product-price">$20</p>
                        </div>

                        <!-- Product 4 container -->
                        <div class="product-container">
                            <div class="image-container">
                                <img src="assets/product images/spotify.png" alt="spotify gift card">
                            </div>

                            <div class="product-text-details">
                                <div class="product-name">Spotify Gift Card</div>
                                
                                <div class="quantity">
                                    <select id="dropdown-quantity-4" name="quantities[Spotify Gift Card]">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <input type="checkbox" id="product4" name="products[]" value='Spotify Gift Card'>
                                </div>
                            </div>
                            
                            <p class="product-price">$25</p>
                        </div>
                    </section>

                    <!-- This section consists of the customer and payment forms the user must fill -->
                    <h2>Customer and Payment Info</h2>
                    <section class="fieldsets-container">
                        <!-- This fieldset contains the user's personal information -->
                        <fieldset>
                            <legend>Customer Information</legend>

                            <div class="inputs">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required>
                                <div class="error-fullname"></div>
                            </div>
                            
                            <div class="inputs">
                                <label for="email">Email address</label>
                                <input type="text" id="email" name="email" required>
                            </div>

                            <div class="inputs">
                                <label for="phone">Phone number</label>
                                <input type="number" id="phone" name="phone" required>
                            </div>

                            <div class="inputs">
                                <label for="postcode">Postcode</label>
                                <input type="text" id="postcode" name="postcode" required>
                            </div>

                            <div class="inputs">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" required>
                            </div>

                            <div class="inputs">
                                <label for="province">Province</label>
                                <select id="province" name="province" required>
                                    <option value=""></option>
                                    <option value="AB">AB</option>
                                    <option value="BC">BC</option>
                                    <option value="MB">MB</option>
                                    <option value="NB">NB</option>
                                    <option value="NL">NL</option>
                                    <option value="NT">NT</option>
                                    <option value="NS">NS</option>
                                    <option value="NU">NU</option>
                                    <option value="ON">ON</option>
                                    <option value="PE">PE</option>
                                    <option value="QC">QC</option>
                                    <option value="SK">SK</option>
                                    <option value="YT">YT</option>
                                </select>
                            </div>

                            <div class="inputs">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                            </div>

                            <div class="inputs">
                                <label for="confirm">Confirm password</label>
                                <input type="password" id="confirm" name="confirm" required>
                            </div>
                        </fieldset>

                        <!-- This fieldset contains the payment inputs of the form -->
                        <fieldset>
                            <legend>Payment Details</legend>

                            <div class="inputs">
                                <label for="card">Card number</label>
                                <input type="text" id="card" name="card" placeholder="1111-1111-1111-1111" required>
                            </div>

                            <div class="month-year-input">
                                <div class="inputs">
                                    <label for="month">Month</label>
                                    <input type="text" id="month" name="month" placeholder="JAN" required>
                                </div>

                                <div class="inputs">
                                    <label for="year">Year</label>
                                    <input type="text" id="year" name="year" required>
                                </div>
                            </div>
                        </fieldset>
                    </section>

                    <!-- This is where messages will be displayed -->
                    <div id="error"></div>
                    <div id="messages"></div>

                    <!-- This is the submit button that submits the form to the server -->
                    <div class="submit-button-container">
                        <input type="submit" value="Place order" class="submit-button">
                    </div>
                </form>
            </section>

            <!-- The receipt is printed into this div when the user satisfies all required fields -->
            <section class="insert-receipt"></section>
        </main>

        <!-- Insert footer code -->
        <?php include "layouts/footer.php" ?>

        <script>
            // on click listener to know when the form button was clicked
            $(document).ready(function(){
                $('.form-container').on('submit', function(e){
                    // stops the default nature of submitting the form for the sake of validations in AJAX
                    e.preventDefault();

                    // form ids stored in variables for easier accessibility
                    const name  = $('#name').val();
                    const email = $('#email').val();
                    const phone = $('#phone').val();
                    const postcode = $('#postcode').val();
                    const address = $('#address').val();
                    const province = $('#province').val();
                    const password = $('#password').val();
                    const confirm = $('#confirm').val();
                    const card = $('#card').val();
                    const month = $('#month').val();
                    const year = $('#year').val();
                    
                    const submitButton = $('.submit-button-container');
                    const receiptContainer = $('.insert-receipt');

                    const error = $('#error');
                    const messages = $('#messages');
                    
                    // Fetch the selected products
                    const selectedProducts = $('input[name="products[]"]:checked').length;

                    // Check if at least two products are selected
                    if (selectedProducts < 2) {
                        error.html("<p class='error text-center margin-block'>Please select at least two products.</p>");
                        return;
                    } else {
                        error.html('');
                    }

                    // validates the retyped password
                    if (password !== confirm) {
                        error.html("<p class='error text-center margin-block'>Passwords do not match</p>");
                        return;
                    } else {
                        error.html('');
                    }

                    submitButton.html('');

                    // stringifying of the form data to send over the AJAX call
                    const formData = $(this).serialize();

                    // AJAX call
                    $.ajax({
                        type  : 'POST',
                        url   : 'utils/form-validation.php',
                        data  : formData,
                        success : function(response){
                            // If there's no response we print an error message
                            if (!response) {
                                console.error("Empty response");
                                return;
                            }

                            // Parse the JSON response
                            const jsonResponse = JSON.parse(response);

                            // if the parsed response is invalid, it throws this error.
                            if (!jsonResponse) {
                                console.error("Invalid JSON response");
                                return;
                            }
                            
                            // storing the received receipt and message data from the response
                            const receipt = jsonResponse.receipt;
                            const message = jsonResponse.message;

                            // if receipt and message is invalid, it prints an error
                            if (!receipt || !message) {
                                console.error("Missing receipt or message in response");
                                error.html("<p class='error text-center margin-block'>Error: Not receiving from Database. Setup MySQL and Refresh</p>");
                                return;
                            }

                            // displays the receipt and message on the webpage after successful order
                            receiptContainer.html(receipt);
                            messages.html(message);
                            error.html('');
                        },
                    });
                });
            });
        </script>
    </body>
</html>