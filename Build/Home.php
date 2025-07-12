<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include 'dbconnection.php';

// Fetch teachers from user table where u_type is 'Teacher'
$teachers = [];
$teacherQuery = "SELECT u_name, u_email FROM user WHERE u_type = 'Teacher'";
$teacherResult = mysqli_query($conn, $teacherQuery);
while ($teacher = mysqli_fetch_assoc($teacherResult)) {
    $teachers[] = $teacher;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home Page</title>
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
            height: 1000px;
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

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px 0;
            cursor: pointer;
            border-radius: 5px;
        }

        .teacher-list {
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .teacher-list h2 {
            text-align: center;
        }

        .teacher-list p {
            margin: 5px 0;
        }

        .teacher-button {
            display: inline-block;
            margin-top: 10px;
        }
        /* Hero Image Section */
.hero-image {
    width: 103.2%;
    height: 101%; /* Adjust the height as needed */
    background-image: url('image4.jpeg'); /* Replace with your image path */
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;

}

/* Overlay to darken the image */
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Dark overlay for better text visibility */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Hero Content (Text) Styling */
.hero-content {
    text-align: center;
    color: white;
    font-family: 'Arial', sans-serif;
    max-width: 80%;
    margin: 0 20px;
    z-index: 2;
}

/* Main Heading Styling */
.hero-content h1 {
    font-size: 3rem;
    font-weight: bold;
    margin: 0 0 15px 0;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Paragraph Styling */
.hero-content p {
    font-size: 1.2rem;
    font-weight: lighter;
    margin: 0;
    opacity: 0.8;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2rem; /* Adjusts the font size for smaller screens */
    }
    .hero-content p {
        font-size: 1rem; /* Adjusts paragraph size */
    }
}
/* Additional Information Section */
.info-section {
    width: 90%;
    max-width: 600px;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin-top: 30px;
}

.info-section h3 {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.info-section p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.info-buttons a {
    margin: 5px;
    text-decoration: none;
}
/* External Resources Section */
.resources-section {
    width: 90%;
    max-width: 600px;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

.resources-section h3 {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.resources-section ul {
    list-style-type: none;
    padding: 0;
}

.resources-section li {
    margin: 10px 0;
}

.resources-section a {
    text-decoration: none;
    color: #4CAF50;
    font-size: 1.1rem;
}

.resources-section a:hover {
    color: #333;
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
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
            <a href="register.php">Register</a>
        </div>
    </nav>

    <div class="hero-image">
        
    <div class="hero-overlay">
        
        <div class="hero-content">
        <?php
    if ($_SESSION['loggedin'] == true) {
        echo "<div class='Welcome_user' style=' margin-left: 170px; color: black; width: 90%; max-width: 600px; background-color: lightgreen; text-align: center; padding: 10px; border-radius: 5px;'>
              <p>Welcome - " . $_SESSION['username'] . "</p>
              </div>";
    }
    ?>
            <h1>Explore the World of Education</h1>
            <p>Unlock endless possibilities with our teaching platform.</p>
            <div class="teacher-button">
                    <a class="button" href="contact.php">Feedback</a>
                </div>
        </div>
    </div>
</div>


   
<br><br>
    <button class="button" onclick="document.getElementById('teacher-list').style.display='block'">View Teachers</button>

    <div id="teacher-list" class="teacher-list" style="display: none;">
        <h2>Available Teachers</h2>
        <?php if (count($teachers) > 0): ?>
            <?php foreach ($teachers as $teacher): ?>
                <p>Name: <?php echo htmlspecialchars($teacher['u_name']); ?> | Email: <?php echo htmlspecialchars($teacher['u_email']); ?></p>
                <div class="teacher-button">
                    <a class="button" href="Teacher_video.php?name=<?php echo urlencode($teacher['u_name']); ?>">View Videos</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No teachers available.</p> 
        <?php endif; ?>
    </div> 
    <!-- Additional Information Section -->
<div class="extra" style="display: flex;">

    <div class="info-section">
        <h3>Need More Help?</h3>
        <p>If you need assistance or have questions, feel free to check out our About us page or contact our support team.</p>
        <div class="info-buttons">
            <a class="button" href="aboutus.php">About us</a>
            <a class="button" href="contact.php">Contact Support</a>
    </div>
</div>
<!-- External Resources Section -->
<div class="resources-section" style="margin-left: 100px;">
    <h3>External Resources</h3>
    <ul>
        <li><a href="https://www.edx.org" target="_blank">edX - Online Courses</a></li>
        <li><a href="https://www.coursera.org" target="_blank">Coursera - Learn from Top Universities</a></li>
        <li><a href="https://www.khanacademy.org" target="_blank">Khan Academy - Free Education</a></li>
    </ul>
</div>
</div>



</body>
</html>
