<!-- dashboard.php -->
<?php
session_start();

  $pageTitle = "Dashboard";
  $customCssFile = '../Styles/dashboard.css';
  // Fetch $userRole and $userId from your session
  $userRole = isset($_SESSION['userRole']) ? $_SESSION['userRole'] : '';
  $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';

// Fetch username from the database based on user ID (Assuming your database connection is already established)
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "etutor_database";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch username based on user ID
$sql = "SELECT username FROM users WHERE id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    $username = "Unknown"; // Default username if not found
}



  include('../Header/head.php');
  include('../Header/header.html');
  
?>

<body>
<div class="dashboard-container">
  <?php
    // Check user role and display role-specific content
    echo "Welcome $username ! You are logged in as ";
    if ($userRole == '1') {
        echo "Student";
      include('student_dashboard_content.php');
    } elseif ($userRole == '2') {
        echo "Lecture";
      include('teacher_dashboard_content.php');
    } elseif ($userRole == '3') {
        echo "Admin";
      include('admin_dashboard_content.php');
    }
  ?>
</div>
</body>
</html>
