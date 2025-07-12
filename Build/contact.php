<?php
    $successMessage = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'dbconnection.php';
        $name1 = $_POST['name'];
        $subject1 = $_POST['subject'];
        $dec1 = $_POST['description'];

        $ins1 = "INSERT INTO `contactus`(`co_name`, `co_subject`, `co_dec`) VALUES ('$name1', '$subject1', '$dec1')";
        $result = mysqli_query($conn, $ins1);
        
        if ($result) {
            $successMessage = "Thank you for contacting us! We will get back to you soon.";
        } else {
            $successMessage = "Oops! Something went wrong. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        /* Basic reset and body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f0f0f0;
            color: #333;
        }

        /* Navbar styling */
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
            transition: 0.3s;
        }

        nav .nav-left, nav .nav-right {
            display: flex;
            align-items: center;
        }

        nav a:hover {
            color: #ddd;
        }

        /* Contact form styling */
        .contact-form-container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 600px;
            margin: 40px;
            text-align: center;
            transition: all 0.3s ease;
            animation: fadeIn 1s ease-in;
        }

        .contact-form-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
            font-weight: 600;
        }

        .contact-form-container input, .contact-form-container textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .contact-form-container input:focus, .contact-form-container textarea:focus {
            border-color: #333;
            outline: none;
        }

        .contact-form-container textarea {
            resize: vertical;
            min-height: 150px;
        }

        .contact-form-container button {
            padding: 12px 25px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .contact-form-container button:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        .contact-form-container button:active {
            transform: scale(1);
        }

        /* Success message styling */
        .success-message {
            margin-top: 15px;
            color: green;
            font-weight: bold;
        }

        /* Animation for form appearance */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        <a href="aboutus.php">About Us</a>
        <a href="contact.php">Contact Us</a>
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

<!-- Contact Form -->
<div class="contact-form-container">
    <h2>Contact Us</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="description" placeholder="Describe your issue or message..." required></textarea>
        <button type="submit">Submit</button>
    </form>
    <!-- Display success or error message -->
    <?php if ($successMessage): ?>
        <p class="success-message"><?php echo $successMessage; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
