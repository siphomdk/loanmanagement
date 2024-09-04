<?php
session_start(); // Start the session
    $title = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'User';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {

    // If not logged in, redirect to index.php
    header('Location: index.php');
    exit();
}


// Rest of your code...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title><?php echo htmlspecialchars($title); ?> Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="script/style.js" defer></script>
    <!-- Custom JavaScript for Dashboard -->
    <script src="script/dashboard.js" defer></script>
    
</head>
<body>
    <div id="navbar">
        <img src="image/logo.png" alt="Logo"> <!-- Replace with the path to your logo image -->
        <div>
            <a href="index.php">Home</a>
            <a href="contact_us.php">Contact Us</a>
            <a href="news_update.php">News Update</a>
            <a href="about_us.php">About Us</a>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="add_edit_user.php?id=<?php echo htmlspecialchars($_SESSION['user_id']); ?>">Profile</a>
                    <a class="dropdown-item" href="edit_account.php">Account</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div id="container">
        <div id="left-column">
            <nav>
                <ul>
                    <li><a href="#" onclick="loadContent('create_ticket.php')">Create Ticket</a></li>
                    <li><a href="#" onclick="loadContent('view_tickets.php')">View Tickets</a></li>
                    <li><a href="#" onclick="loadContent('view_bids.php')">View Bids</a></li>
                    <li><a href="#" onclick="loadContent('view_debtors.php')">View Debtors</a></li>
                    <li><a href="#" onclick="loadContent('dashboard_overview.php')">Dashboard Overview</a></li>
                </ul>
            </nav>
        </div>
        <?php


// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the session variable exists
if (isset($_SESSION['user_role'])) {
    $role = $_SESSION['user_role'];

    // Include the appropriate file based on the user role
    switch ($role) {
        case 'creditor':
            include 'content/creditor_graphs.php'; // Load the file for creditors
            break;
        case 'debtor':
            include 'content/debtor_dashboard.php'; // Load the file for debtors
            break;
        case 'collector':
            include 'content/collector_dashboard.php'; // Load the file for collectors
            break;
        default:
            include 'content/default_dashboard.php'; // Load a default file if the role does not match
            break;
    }
} else {
    // Handle the case where the user role is not set
    include 'content/error.php'; // Load an error file or handle accordingly
}
?>

        <div id="info-column">
            <h4>Additional Information</h4>
            <p>Here you can add notices, alerts, or any other information relevant to the user.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</body>
</html>
