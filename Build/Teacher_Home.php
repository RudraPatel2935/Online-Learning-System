<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get video details from the form
    $title = $_POST['title'];
    $youtubeLink = $_POST['youtube_link'];
    $description = $_POST['description']; // New description field
    $teacherName = $_SESSION['username']; // Assuming username is the teacher's name

    // Check if the video already exists
    $checkSql = "SELECT * FROM teacher_video WHERE title = '$title' AND t_name = '$teacherName'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) == 0) {
        // Insert video into the database
        $insertSql = "INSERT INTO teacher_video (title, youtube_link, description, t_name) VALUES ('$title', '$youtubeLink', '$description', '$teacherName')";
        if (mysqli_query($conn, $insertSql)) {
            $successMessage = "Video added successfully!";
        } else {
            $errorMessage = "Error adding video: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "This video already exists for the teacher.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Home Page</title>
    <style>
        /* Body and Navbar styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
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

        .form-container {
            width: 90%;
            max-width: 600px; /* Increased width for a better layout */
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }

        .form-container input[type="text"],
        .form-container input[type="url"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical; /* Allow vertical resizing for textarea */
            margin-left: -10px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #555;
        }

        .alert {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: lightgreen;
        }

        .error {
            background-color: rgb(244, 61, 61);
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="nav-left">
            <a href="Teacher_Home.php">Teacher Home</a>
        </div>
        <div class="nav-right">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
            <a href="register.php">Register</a>
        </div>
    </nav>

    <?php
    if ($_SESSION['loggedin'] == true) {
        echo "<div class='Welcome_user' style='width: 1349px; background-color: lightgreen;'>
                <p style='margin-top: 0px;'>Welcome - " . $_SESSION['username'] . " </p>
              </div>";
    }

    // Display success or error messages
    if (isset($successMessage)) {
        echo "<div class='alert success'>$successMessage</div>";
    }
    if (isset($errorMessage)) {
        echo "<div class='alert error'>$errorMessage</div>";
    }
    ?>

    <!-- Video Submission Form -->
    <div class="form-container">
        <h2>Add YouTube Video</h2>
        <form action="" method="post">
            <label for="title">Video Title</label>
            <input type="text" id="title" name="title" required>

            <label for="youtube_link">YouTube Link</label>
            <input type="url" id="youtube_link" name="youtube_link" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <button type="submit">Add Video</button>
        </form>
    </div>

</body>
</html>
