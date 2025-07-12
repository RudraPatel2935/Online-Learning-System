<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include 'dbconnection.php';
$addMessage = '';

// Handle adding a teacher
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_teacher'])) {
    $teacher_name = $_POST['teacher_name'];
    $teacher_email = $_POST['teacher_email'];
    $teacher_password = $_POST['teacher_password'];

    // Check if the teacher already exists by username or email
    $check_sql = "SELECT * FROM user WHERE (u_name = '$teacher_name' OR u_email = '$teacher_email') AND u_type = 'Teacher'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $addMessage = "Teacher with this username or email already exists!";
    } else {
        // Insert new teacher if they do not exist
        $sql = "INSERT INTO user (u_name, u_email, password, u_type) VALUES ('$teacher_name', '$teacher_email', '$teacher_password', 'Teacher')";
        $sql1 = "INSERT INTO teacher (t_name, t_email, t_password) VALUES ('$teacher_name', '$teacher_email', '$teacher_password')";
        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)) {
            $addMessage = "Teacher added successfully!";
        } else {
            $addMessage = "Error adding teacher: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            /* padding: 20px; */
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
        .container {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            text-align: center;
        }
        .success { background-color: #4CAF50; }
        .error { background-color: #f44336; }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            margin-left: -10px;
        }
        button {
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
    </style>
</head>
<body>
<nav>
        <div class="nav-left">
            <a href="Admin_Home.php">Admin Home</a>
        </div>
        <div class="nav-right">
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
<div class="container">
    <h2>Admin Dashboard</h2>

    <!-- Add Teacher Form -->
    <h3>Add New Teacher</h3>
    <?php if ($addMessage): ?>
        <div class="message <?= strpos($addMessage, 'successfully') ? 'success' : 'error' ?>">
            <?= $addMessage ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="add_teacher" value="1">
        <label>Teacher Username:</label>
        <input type="text" name="teacher_name" required>
        
        <label>Email:</label>
        <input type="email" name="teacher_email" required>

        <label>Password:</label>
        <input type="password" name="teacher_password" required>
        
        <button type="submit">Add Teacher</button>
    </form>
</div>

</body>
</html>
