<?php
session_start();
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnection.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to fetch user details including u_type based on username and password
    $sql = "SELECT * FROM user WHERE u_name='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['u_type'] = $row['u_type']; // Fetch user type directly from the query result

        // Redirect based on the user's type
        if ($_SESSION['u_type'] == 'Admin') {
            header("Location: Admin_Home.php");
        } elseif ($_SESSION['u_type'] == 'Teacher') {
            header("Location: Teacher_Home.php");
        } elseif ($_SESSION['u_type'] == 'Student') {
            header("Location: Home.php");
        }
    } else {
        $showError = "Invalid Credentials";
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Body and Navbar styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f0f0f0;
        }

        nav {
            width: 100%;
            background-color: #333;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
            transition: 0.5s;
        }

        nav .nav-left a:hover, nav .nav-right a:hover {
            color: #999;
        }

        .nav-left, .nav-right {
            display: flex;
            align-items: center;
        }

        /* Form container */
        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Form styling */
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 16px;
            margin-left: -10px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.5s;
        }

        .form-container button:hover {
            background-color: #111;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="nav-left">
            <a href="Home.php">Home</a>
        </div>
        <div class="nav-right">
            <a href="aboutus.php">About us</a>
            <a href="contact.php">Contact Us</a>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<a href="Logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
            <a href="register.php">Register</a>
        </div>
    </nav>
        
    <?php
    if ($login) {
        echo '<div class="alert" role="alert" style="background-color: lightgreen; width: 400px; padding: 10px; border-radius:10px; margin-top: 10px;">
        <strong>Success!</strong> You are logged in.
        </div>';
    }
    if ($showError) {
        echo '<div class="alert" role="alert" style="background-color: rgb(244, 61, 61); color: #ddd; width: 400px; padding: 10px; border-radius:10px; margin-top: 10px;">
        <strong>Error!</strong> '. $showError .'
        </div>';
    }
    ?>

    <!-- Login Form -->
    <div class="form-container">
        <h2>Login</h2>
        <hr>
        <form action="#" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <div id="error-message" class="error"></div>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
