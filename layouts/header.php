<?php
    /* HEADER CODE TO BE INSERTED IN EVERY PAGE, MAINLY USED TO CHECK IF A USER IS LOGGED IN OR NOT */

    // getting the url of the current page the user is currently in
    $currentPage = basename($_SERVER['PHP_SELF']);

    // getting the session status
    $session_status = session_status();

    // if the session is not started, we start the session
    if ($session_status != PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Boolean variable to store the login state of the user
    $isLoggedIn;

    // Check if the username session variable is set
    if (isset($_SESSION['username'])) {
        // setting the login state to true
        $isLoggedIn = true;

        // if the user is already logged in and trying to access the login page, they're redirected out
        if ($currentPage == "login-page.php") {
            header("Location: index.php");
        }

        // if the user is already logged in but not an admin and is trying to access the create manager page, they're redirected out
        if ($currentPage == "create-manager-page.php" && $_SESSION['userType'] != "admin") {
            header("Location: index.php");
        }
    } else {
        // setting the login state to false
        $isLoggedIn = false;

        // if the user is not logged and trying to access the restricted pages, they're redirected back to the login page
        if ($currentPage != "login-page.php") {
            if ($currentPage == "orders-page.php" || $currentPage == "create-manager-page.php") {
                header("Location: login-page.php");
                exit;
            }
        }
    }
?>

<header>
    <!-- Logo -->
    <a href="/" class="logo-link">
        <div class="logo">
            <p class="logo-black">Gift Mania</p>
            <div class="logo-image-container">
                <img src="assets/icons/logo.png" alt="logo image">
            </div>
        </div>
    </a>

    <!-- Search form -->
    <div class="user-type">
        <?php
            // used to know if the user is an admin and manager, and a custom welcome message is printed based on that
            if (isset($_SESSION['username'])) {
                if ($_SESSION['userType'] == "admin") {
                    echo "Welcome back, Admin!";
                } else {
                    $manager = $_SESSION['username'];
                    $managerCapitalized = ucfirst($manager);
                    echo "Welcome back, " . $managerCapitalized .  "!";
                }
            }
        ?>
    </div>

    <!-- Navbar -->
    <nav>
        <ul>
            <a href="index.php">
                <li>
                    <img src="assets/icons/cart.svg" alt="cart icon" />
                    Products
                </li>
            </a>
            <a href="orders-page.php">
                <li>
                    <img src="assets/icons/package.svg" alt="orders icon" />
                    Orders
                </li>
            </a>
            <?php
                // hides the link to the create manager page if the user is not logged in and an admin
                if ($isLoggedIn && $_SESSION['userType'] == "admin") {
                    echo "
                        <a href='create-manager-page.php'>
                            <li>
                                <img src='assets/icons/create.svg' alt='account icon' />
                                Create Shop Manager
                            </li>
                        </a>
                    ";
                }
            ?>
        </ul>

        <div class="login-logout">
            <?php
                // hides the login button if the user is already logged in
                if (!$isLoggedIn) {
                    echo '
                        <a href="login-page.php">
                            <button name="login" class="login-button">Login</button>
                        </a>
                    ';
                }
            ?>

            <?php
                // shows the logout button if the user is logged in
                if ($isLoggedIn) {
                    echo "
                        <form action='../utils/logout.php' method='post'>
                            <button type='submit' name='logout' class='logout-button'>Logout</button>
                        </form>
                    ";
                } 
            ?>
        </div>
    </nav>
</header>