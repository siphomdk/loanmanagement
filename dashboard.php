<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_role'])) {
    header('Location: login.php'); // Redirect to login if not authorized
    exit();
}
$user_role = $_SESSION['user_role'];
// Fetch user role and name from the session
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Debt Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto"> <!-- Center the nav items -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, <?php echo htmlspecialchars($user_name); ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="add_edit_user.php?id=<?php echo htmlspecialchars($user_id); ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="edit_account.php">Account</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
                </ul>
                
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4 content">
        <div class="row">
            <?php if ($user_role == 'debtor'): ?>
                <!-- Left Navigation Bar for Debtors -->
                <div class="col-12 col-md-3 mb-4 mb-md-0 left-nav">
                    <div class="list-group">
                        <a href="#" id="homeSidebar" class="list-group-item list-group-item-action">Home</a>
                        <a href="add_eddit_offer.php" id="viewCreditoffersSidebar" class="list-group-item list-group-item-action">View Offers</a>
                        <a href="#" id="viewLoansSidebar" class="list-group-item list-group-item-action">View Loan Applications</a>
                        <a href="#" id="makePaymentSidebar" class="list-group-item list-group-item-action">Make Payment</a>
                        <a href="#" id="viewBidsSidebar" class="list-group-item list-group-item-action">View Bids</a>
                    </div>
                </div>

                <!-- Main Content for Debtors -->
                <div class="col-12 col-md-9">
                    <!-- Content Div for Loading Pages -->
                    <div id="content" class="mt-4"></div>
                </div>

            <?php elseif ($user_role == 'creditor'): ?>
                <!-- Left Navigation Bar for Creditors -->
                <div class="col-12 col-md-3 mb-4 mb-md-0 left-nav">
                    <div class="list-group">
                        <a href="#" id="homeSidebar" class="list-group-item list-group-item-action">Home</a>
                             <a href="add_eddit_offer.php" id="viewCreditoffersSidebar" class="list-group-item list-group-item-action">View Offers</a>
                        <a href="#" id="createTicketSidebar" class="list-group-item list-group-item-action">Create Ticket</a>
                        <a href="#" id="viewBidsSidebar" class="list-group-item list-group-item-action">View Bids</a>
                        <a href="#" id="manageApplicationsSidebar" class="list-group-item list-group-item-action">Manage Applications</a>
                        <a href="#" id="viewDebtorsSidebar" class="list-group-item list-group-item-action">View Debtors</a>
                    </div>
                </div>

                <!-- Main Content for Creditors -->
                <div class="col-12 col-md-9">
                    <!-- Content Div for Loading Pages -->
                    <div id="content" class="mt-4"></div>
                </div>
            <?php endif; ?>
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
            function hideDefaultContent() {
                $('#defaultContent').hide();
            }

            // Load the default page based on the role
            function loadDefaultPage() {
                var defaultPage = 'default.php';
                <?php if ($user_role == 'creditor'): ?>
                    defaultPage = 'creditor_default.php'; // Default page for creditors
                <?php elseif ($user_role == 'debtor'): ?>
                    defaultPage = 'debtor_default.php'; // Default page for debtors
                <?php endif; ?>
                $('#content').load(defaultPage);
            }
            loadDefaultPage(); // Load the default page on load

            // Load the home page
            $('#homeSidebar').click(function() {
                hideDefaultContent();
                loadDefaultPage();
            });

            // Load the create ticket page
            $('#createTicketSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('create_ticket.php');
            });

            // Load the manage applications page
            $('#manageApplicationsSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('manage_applications.php');
            });

            // Load the view debtors page
            $('#viewDebtorsSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('view_debtors.php');
            });

            // Load the view loans page (for debtors)
            $('#viewLoansSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('view_loans.php');
            });

            // Load the make payment page
            $('#makePaymentSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('make_payment.php');
            });

            // Load the view credit offers
            $('#viewCreditoffersSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('credit_offers.php');
            });

            // Load the view bids
            $('#viewBidsSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('view_bids.php');
            });


        });
    </script>
</body>
</html>
