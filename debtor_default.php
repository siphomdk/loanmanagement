<?php
session_start();

// Check if the user is logged in and has a role of 'debtor'
//if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'debtor') {
   // header('Location: login.php'); // Redirect to login if not authorized
  //  exit();
//}

// Placeholder for fetching payment history from the database
// For demonstration purposes, using dummy data
$payment_history = [
    ['date' => '2024-08-15', 'amount' => '$200', 'status' => 'Paid'],
    ['date' => '2024-07-15', 'amount' => '$300', 'status' => 'Paid'],
    ['date' => '2024-06-15', 'amount' => '$150', 'status' => 'Paid'],
    // Add more dummy payments as needed
];

$outstanding_payments = [
    ['date' => '2024-09-15', 'amount' => '$250'],
    ['date' => '2024-10-15', 'amount' => '$350'],
    // Add more dummy outstanding payments as needed
];

$next_payments = [
    ['date' => '2024-09-15', 'amount' => '$250'],
    ['date' => '2024-10-15', 'amount' => '$350'],
    // Add more dummy next payments as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debtor Default</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Debtor Dashboard</h2>

        <!-- Payment History -->
        <h4>Payment History</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payment_history as $payment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['date']); ?></td>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                        <td><?php echo htmlspecialchars($payment['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Outstanding Payments -->
        <h4>Outstanding Payments</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outstanding_payments as $payment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['date']); ?></td>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Next Payments -->
        <h4>Next Payments</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($next_payments as $payment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($payment['date']); ?></td>
                        <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
