<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
    </head>
    <body>
        <?php include "layouts/header.php" ?>

        <h1 class="title">Login</h1>

        <!-- Main section - Consits of the form tag with all products and wrapped in for the sake of the php form validation -->

        <main>
            <!-- form to submit the username and password -->
            <form action="" method="post" class="form-container">
                <fieldset>
                    <div class="inputs">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="inputs">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <!-- prints the error using -->
                    <div id="formResult">
                        <!-- success or error message gets printed in here with AJAX -->
                    </div>

                    <div class="submit-button-container">
                        <input type="submit" value="Login" class="submit-button">
                    </div>
                </fieldset>
            </form>
        </main>

        <!-- Insert footer code -->
        <?php include "layouts/footer.php" ?>

        <!-- AJAX code -->
        <script>
            // event listener to check if the create button was clicked
            $(document).ready(function(){
                $('.form-container').on('submit', function(e){
                    // prevents the default nature of submitting
                    e.preventDefault();

                    // get the username and password values
                    const username  = $('#username').val();
                    const password = $('#password').val();

                    // AJAX call
                    $.ajax({
                        type  : 'POST',
                        url   : 'utils/login.php',
                        data  : {
                            username  : username,
                            password : password,
                        },
                        success : function(response){
                            // Parse the JSON response
                            const jsonResponse = JSON.parse(response);

                            // storing the received user type and message data from the response
                            const type = jsonResponse.type;
                            const message = jsonResponse.message;
                            const error = jsonResponse.error;

                            // prints the response message to let the admin know it the user was created or already exists
                            if (error === 'password' || error === 'username') {
                                $('#formResult').html(jsonResponse.message);
                                return;
                            }

                            // redirects the user to their respective allowed pages
                            if (type === 'admin') {
                                window.location.href = "create-manager-page.php";
                            } else {
                                window.location.href = "orders-page.php";
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>