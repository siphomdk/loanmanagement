<?php
session_start();
require_once 'model/DatabaseConnection.php';
require_once 'model/UserModel.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universal Debt Collector</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-primary text-white text-center py-5">
        <h1 class="display-4">Welcome to Your One-Stop Financial Service</h1>
        <p class="lead">We bring you the financial services you need. Your next cash loan is just a click away.</p>
    </header>

    <main role="main" class="container mt-5">
        <section class="text-center">
            <p class="lead">Universal Debt Collector is designed to connect you with the financial services you require, whether it's managing debts, finding a collector, or securing a loan. Our platform provides a seamless experience for both creditors and debtors.</p>

            <h3 class="mt-4">Get Started Now</h3>
            <p>Don't miss out on the financial services you need. <a href="add_edit_user.php" class="btn btn-primary btn-lg mx-2">Register</a> or <a href="login.php" class="btn btn-secondary btn-lg mx-2">Log In</a> to access all our features.</p>
        </section>
    </main>

    <footer class="footer bg-light text-center py-3 mt-5">
        <div class="container">
            <span class="text-muted">&copy; <?php echo date("Y"); ?> Universal Debt Collector. All rights reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
