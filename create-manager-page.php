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

        <!-- title of the page -->
        <h1 class="title">Shop Managers</h1>

        <!-- Main section -->
        <main>
            <!-- Section 1: the create form -->
            <h2>Create a new shop manager</h2>
            <section class="create-container dark-green-border">
                <!-- form to create a new shop manager -->
                <form action="" method="post" class="form-manager-container">
                    <div class="create-manager-inputs">
                        <div class="inputs">
                            <input type="text" placeholder="Username" id="username" name="username">
                        </div>

                        <div class="inputs">
                            <input type="password" placeholder="Password" id="password" name="password">
                        </div>
                    </div>
                    
                    <!-- submits the form -->
                    <div class="create-button-container">
                        <input type="submit" value="Create" class="create-button">
                    </div>
                </form>

                <div id="formResult">
                    <!-- success or error message gets printed in here with AJAX -->
                </div>
            </section>

            <!-- Section 2: to display a list of all managers created -->
            <h2>All Shop Managers</h2>
            <section class="shop-managers-list dark-green-border">
                <!-- Refresh button to update the list -->
                <div class='w-full flex flex-column align-center gap-20 margin-block'>                    
                    <div class='submit-button-container'>
                        <button onclick="window.location.href = 'create-manager-page.php'" class='submit-button-green'>Refresh List</button>
                    </div>
                </div>

                <!-- table to show all managers -->
                <table class="shop-manager">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>User type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop to go through and print all users in the database -->
                        <?php
                            // preparing the mysql query and result
                            $query = "SELECT * FROM `users`";
                            $result = mysqli_query($db, $query);
                            $count = 0;

                            // to check if we go a result from the database
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $count++;
                                    ?>
                                        <tr>
                                            <td><?php echo $count ?></td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['password'] ?></td>
                                            <td><?php echo $row['user_type'] ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>

        <!-- Insert footer code -->
        <?php include "layouts/footer.php" ?>

        <!-- AJAX code -->
        <script>
            // event listener to check if the create button was clicked
            $(document).ready(function(){
                $('.form-manager-container').on('submit', function(e){
                    // prevents the default nature of submitting
                    e.preventDefault();

                    // get the username and password values
                    const username  = $('#username').val();
                    const password = $('#password').val();

                    // AJAX call
                    $.ajax({
                        type  : 'POST',
                        url   : 'utils/create-manager-process.php',
                        data  : {
                            username  : username,
                            password : password,
                        },
                        success : function(response){
                            // prints the response message to let the admin know it the user was created or already exists
                            $('#formResult').html(response);
                        }
                    });
                });
            });
        </script>
    </body>
</html>