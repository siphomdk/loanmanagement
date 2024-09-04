<?php
session_start();

// Check if the user is logged in


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debtors Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        .content {
            min-height: calc(100vh - 56px - 60px); /* Adjust based on your header and footer height */
        }
        footer {
            background-color: #f8f9fa;
            padding: 1rem;
        }
        .navbar-nav {
            margin: auto; /* Centers the navigation items */
        }
        .navbar-nav .nav-link.active {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Debtor's Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto"> <!-- Center the nav items -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" id="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
				<ul>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4 content">
        <div class="row">
            <!-- Left Navigation Bar -->
            <div class="col-12 col-md-3 mb-4 mb-md-0">
                <div class="list-group">
                    <a href="#" id="homeSidebar" class="list-group-item list-group-item-action">Home</a>
                    <a href="#" id="viewLoansSidebar" class="list-group-item list-group-item-action">View Loan Applications</a>
                    <a href="#" id="makePaymentSidebar" class="list-group-item list-group-item-action">Make Payment</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-12 col-md-9">
                <!-- Content Div for Loading Pages -->
                <div id="content" class="mt-4"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="container p-4">
            <p>&copy; 2024 Debt Management System</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hide default content when navigating
            function hideDefaultContent() {
                $('#defaultContent').hide();
            }

            // Load the home page
            $('#home, #homeSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('default.php');
            });

            // Load the view loans page
            $('#viewLoans, #viewLoansSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('view_loans.php');
            });

            // Load the make payment page
            $('#makePayment, #makePaymentSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('make_payment.php');
            });
        });
    </script>
</body>
</html>
