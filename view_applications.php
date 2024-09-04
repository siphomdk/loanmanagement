<?php
session_start();

// Check if the user is logged in and has a role of 'creditor'
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'creditor') {
    header('Location: login.php'); // Redirect to login if not authorized
    exit();
}

// Fetch application ID from query parameter
$application_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Placeholder for fetching application details from the database
// For demonstration purposes, using dummy data
$applications = [
    1 => ['debtor_name' => 'John Doe', 'requested_amount' => '$1000', 'status' => 'Pending', 'description' => 'Personal loan for home improvement.'],
    2 => ['debtor_name' => 'Jane Smith', 'requested_amount' => '$2000', 'status' => 'Approved', 'description' => 'Business loan for expansion.'],
    3 => ['debtor_name' => 'Mike Johnson', 'requested_amount' => '$1500', 'status' => 'Rejected', 'description' => 'Car loan.'],
    // Add more dummy applications as needed
];

$application = isset($applications[$application_id]) ? $applications[$application_id] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">View Application #<?php echo htmlspecialchars($application_id); ?></h2>
        <?php if ($application): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Debtor: <?php echo htmlspecialchars($application['debtor_name']); ?></h5>
                    <p class="card-text"><strong>Requested Amount:</strong> <?php echo htmlspecialchars($application['requested_amount']); ?></p>
                    <p class="card-text"><strong>Status:</strong> <?php echo htmlspecialchars($application['status']); ?></p>
                    <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($application['description']); ?></p>
                    <a href="approve_application.php?id=<?php echo htmlspecialchars($application_id); ?>" class="btn btn-success">Approve</a>
                    <a href="reject_application.php?id=<?php echo htmlspecialchars($application_id); ?>" class="btn btn-danger">Reject</a>
                    <a href="manage_applications.php" class="btn btn-secondary">Back to Applications</a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                Application not found.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
