<?php
session_start();
require_once 'model/LoanModel.php';
require_once 'model/UserModel.php'; // Assuming you have this to check if a user is logged in

// Check if the debtor is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'debtor') {
    header('Location: login.php');
    exit();
}

// Initialize LoanModel
$loanModel = new LoanModel();
$loans = $loanModel->getAllLoans(); // Fetch all loan records

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debtor Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .dashboard {
            margin: 20px;
        }
        .loan-table th, .loan-table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Debtor Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="debtor_dashboard.php">Home</a>
                </li>
                <!-- Add more links as needed -->
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container dashboard">
        <h2>Available Credit Offers</h2>
        <table class="table table-bordered loan-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Creditor ID</th>
                    <th>Amount</th>
                    <th>Interest Rate</th>
                    <th>Status</th>
                    <th>Application Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loans as $loan): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($loan['id']); ?></td>
                        <td><?php echo htmlspecialchars($loan['creditor_id']); ?></td>
                        <td><?php echo htmlspecialchars($loan['amount']); ?></td>
                        <td><?php echo htmlspecialchars($loan['interest_rate']); ?>%</td>
                        <td><?php echo htmlspecialchars($loan['status']); ?></td>
                        <td><?php echo htmlspecialchars($loan['application_date']); ?></td>
                        <td>
                            <a href="view_loan.php?id=<?php echo htmlspecialchars($loan['id']); ?>" class="btn btn-info btn-sm">View</a>
                            <a href="apply_loan.php?id=<?php echo htmlspecialchars($loan['id']); ?>" class="btn btn-primary btn-sm">Apply</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        &copy; <?php echo date('Y'); ?> Your Company
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
