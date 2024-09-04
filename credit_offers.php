<?php
session_start();

// Check if the user is logged in and has a role of 'debtor'
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'debtor') {
    header('Location: login.php'); // Redirect to login if not authorized
    exit();
}

// Placeholder for fetching creditor offers from the database
// For demonstration purposes, using dummy data
$creditor_offers = [
    ['id' => 1, 'creditor' => 'Creditor A', 'offer' => '5% discount on early repayment', 'valid_until' => '2024-12-31'],
    ['id' => 2, 'creditor' => 'Creditor B', 'offer' => '2% cashback on payments over $500', 'valid_until' => '2024-11-30'],
    ['id' => 3, 'creditor' => 'Creditor C', 'offer' => '0% interest for the first 3 months', 'valid_until' => '2024-10-15'],
    // Add more dummy offers as needed
];

// Handle application form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply'])) {
    $offer_id = intval($_POST['offer_id']);
    // Here you would handle the application process, e.g., update the database, send an email, etc.
    // For demonstration purposes, we'll just echo the applied offer ID
    echo "<div class='alert alert-success mt-3'>Applied for offer ID: $offer_id</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creditor Offers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Creditor Offers</h2>

        <!-- Creditor Offers -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Creditor</th>
                    <th>Offer</th>
                    <th>Valid Until</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($creditor_offers as $offer): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($offer['creditor']); ?></td>
                        <td><?php echo htmlspecialchars($offer['offer']); ?></td>
                        <td><?php echo htmlspecialchars($offer['valid_until']); ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="offer_id" value="<?php echo htmlspecialchars($offer['id']); ?>">
                                <button type="submit" name="apply" class="btn btn-primary">Apply</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
