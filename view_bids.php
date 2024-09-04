<?php
session_start();
$user_role = $_SESSION['user_role'];
// Check if the user is logged in
if (!isset($_SESSION['user_role']) || !isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not authorized
    exit();
}

// User role

$user_id = $_SESSION['user_id']; // Assume user ID is stored in the session

// Placeholder for fetching bids based on the user role
// In a real application, fetch from a database
if ($user_role === 'debtor') {
    // Fetch bids for the current debtor
    // For demonstration purposes, using dummy data
    $bids = [
        ['bid_id' => 1, 'offer' => '5% discount on early repayment', 'bid_amount' => '$200', 'status' => 'Pending'],
        ['bid_id' => 2, 'offer' => '2% cashback on payments over $500', 'bid_amount' => '$600', 'status' => 'Accepted'],
        // Add more dummy bids as needed
    ];
} elseif ($user_role === 'creditor') {
    // Fetch all bids related to the creditor's offers
    // For demonstration purposes, using dummy data
    $bids = [
        ['bid_id' => 1, 'debtor_id' => 101, 'offer' => '5% discount on early repayment', 'bid_amount' => '$200', 'status' => 'Pending'],
        ['bid_id' => 2, 'debtor_id' => 102, 'offer' => '2% cashback on payments over $500', 'bid_amount' => '$600', 'status' => 'Accepted'],
        // Add more dummy bids as needed
    ];
} else {
    // If the user role is neither debtor nor creditor, redirect or show an error
    header('Location: login.php');
    exit();
}

// Handle bid approval by creditor
if ($user_role === 'creditor' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve'])) {
    $bid_id = intval($_POST['bid_id']);
    // Here you would handle the bid approval process, e.g., update the database
    // For demonstration purposes, we'll just echo the approved bid ID
    echo "<div class='alert alert-success mt-3'>Bid ID $bid_id has been approved.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bids</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">View Bids</h2>

        <!-- Bids Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Bid ID</th>
                    <th>Offer</th>
                    <th>Bid Amount</th>
                    <th>Status</th>
                    <?php if ($user_role === 'creditor'): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bids as $bid): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($bid['bid_id']); ?></td>
                        <td><?php echo htmlspecialchars($bid['offer']); ?></td>
                        <td><?php echo htmlspecialchars($bid['bid_amount']); ?></td>
                        <td><?php echo htmlspecialchars($bid['status']); ?></td>
                        <?php if ($user_role === 'creditor'): ?>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="bid_id" value="<?php echo htmlspecialchars($bid['bid_id']); ?>">
                                    <button type="submit" name="approve" class="btn btn-success">Approve</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
