<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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

        /* Content styling */
        .content {
            max-width: 800px;
            padding: 30px;
            margin: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            animation: fadeIn 1s ease-in;
        }

        /* Hover effect for content */
        .content:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        h1 {
            font-size: 36px;
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 15px;
            padding: 0 20px;
        }

        .content p:last-child {
            margin-bottom: 0;
        }

        /* Image styling */
        .image-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .image-container img {
            width: 100%;
            max-width: 180px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .image-container img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Animation */
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

<div class="content">
    <h1>About Us</h1>
    <p>Welcome to our platform! We are dedicated to providing students with a comprehensive online learning experience, 
    offering access to educational videos uploaded by qualified teachers. Our goal is to make learning accessible, 
    interactive, and efficient for all students, helping them expand their knowledge and reach their academic goals.</p>
    
    <p>Our team is passionate about education and committed to fostering a community of curious learners and supportive educators. 
    Whether you're here to learn, teach, or connect with others, we strive to offer a seamless and engaging environment for everyone. 
    Join us on our mission to make quality education available to all, anywhere, anytime.</p>
    
    <p>Thank you for choosing us as your learning partner. Together, let's unlock the potential within every student!</p>

    <!-- Image Section -->
    <div class="image-container">
        <img src="image1.jpeg" alt="Team Member 1">
        <img src="image2.jpeg" alt="Team Member 2">
        <img src="image3.jpeg" alt="Team Member 3">
    </div>
</div>

</body>
</html>
