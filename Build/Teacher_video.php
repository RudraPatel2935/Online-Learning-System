<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include 'dbconnection.php';

// Get teacher name from query parameter and escape it
$teacherName = isset($_GET['name']) ? $_GET['name'] : '';

// Fetch videos uploaded by the teacher
$videos = [];
$videoQuery = "SELECT title, description, youtube_link FROM teacher_video WHERE t_name = ?";
$stmt = $conn->prepare($videoQuery);

// Ensure we bind the parameter correctly
$stmt->bind_param("s", $teacherName); // "s" means the parameter is a string
$stmt->execute();
$result = $stmt->get_result();

while ($video = $result->fetch_assoc()) {
    $videos[] = $video;
}
$stmt->close();
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos by <?php echo htmlspecialchars($teacherName); ?></title>
    <style>
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

        .video-list {
            width: 90%;
            max-width: 1200px; 
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex; 
            flex-wrap: wrap; 
            justify-content: space-between; 
        }

        .video-item {
            margin: 10px; 
            width: calc(48% - 20px); 
            background-color: #f9f9f9; 
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .video-item h3 {
            margin: 0;
            font-size: 1.2em;
        }

        iframe {
            width: 100%;
            height: 215px;
            border: none;
        }

        .video-list h2 {
            width: 100%; 
            text-align: center; 
            margin: 0 0 20px 0; 
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-left">
        <a href="Home.php">Home</a>
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

<div class="video-list">
    <h2>Videos by <?php echo htmlspecialchars($teacherName); ?></h2>
    <?php if (count($videos) > 0): ?>
        <?php foreach ($videos as $video): ?>
            <div class="video-item">
                <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                <p><?php echo htmlspecialchars($video['description']); ?></p>
                <iframe src="<?php echo htmlspecialchars($video['youtube_link']); ?>" allowfullscreen></iframe>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No videos available for this teacher.</p>
    <?php endif; ?>
</div>

</body>
</html>
