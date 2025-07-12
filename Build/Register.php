<?php
$showAlert = false;
$showError = false;
$showError1 = false;
$exists = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'dbconnection.php';
    $username = $_POST["username"];
    $email = $_POST['email'];
    $password = $_POST["password"];
    $cpassword = $_POST["confirm-password"];
    $u_type = "Student";
    // $password = hash_algos($password);
    if(empty($username)) {
        $showError1 = "Username is required";
    }
    elseif(empty($password))
    {
        $showError1 = "Password is required";
    }
    else {
        // CHECK USERNAME EXISTS OR NOT
        $existsSQL = "SELECT * FROM `user` WHERE u_name = '$username'";
        $result = mysqli_query($conn, $existsSQL);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0)
        {
            $exists = "Username Already Exists";
        }
        else{
            $sql = "INSERT INTO `user` (`u_name`, `u_type`, `u_email`, `password`) VALUES ('$username', '$u_type', '$email', '$password')";
            $sql1 = "INSERT INTO `student` (`s_name`, `s_email`, `s_password`) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            $result1 = mysqli_query($conn, $sql1);
            if ($result && $result1)
            {
                $showAlert = true;
            } 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        /* Navbar styling */
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
        .form-container input[type="email"],
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
    </style>
    <script>
        function check(event) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm-password").value;

            if (password !== confirmPassword) {
                alert("Confirm password does not match the password.");
                event.preventDefault(); // Prevents form submission if passwords do not match
            }
        }
    </script>
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
            <a href="Login.php">Login</a>
            <a href="Logout.php">Logout</a>
        </div>
    </nav>
<?php
if($showAlert)
{
    echo '<div class="alert" role="alert" style="background-color: lightgreen; width: 400px; padding: 10px; border-radius:10px; margin-top: 10px; margin-left:10px;">
    <strong>Success!</strong> Your accound will be created.
    </div>';
}
if($showError)
{

    echo '<div class="alert" role="alert" style="background-color: rgb(244, 61, 61);;color: #ddd; width: 400px; padding: 10px; border-radius:10px; margin-top: 10px; margin-left:10px;">
    <strong>Error!</strong> '. $showError.' 
    </div>';
}
if($showError1)
{

    echo '<div class="alert" role="alert" style="background-color: rgb(244, 61, 61);;color: #ddd; width: 400px; padding: 10px; border-radius:10px; margin-top: 10px; margin-left:10px;">
    <strong>Error!</strong> '. $showError1.' 
    </div>';
}
if($exists)
 {
     echo '<div class="alert" role="alert" style="background-color: rgb(244, 61, 61);;color: #ddd; width: 400px; padding: 10px; border-radius:10px; margin-top: 10px; margin-left:10px;">
     <strong>Error!</strong> '. $exists.' 
     </div>';

 }
?>

    <!-- Registration Form -->
    <div class="form-container">
        <h2>Register</h2>
        <hr>
        <form action="#" onsubmit="check(event)" method = "post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <button type="submit">Register</button>
        </form>
    </div>

</body>
</html>
