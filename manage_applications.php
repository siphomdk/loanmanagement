<?php
session_start();

// Check if the user is logged in and has a role of 'creditor'
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'creditor') {
    header('Location: login.php'); // Redirect to login if not authorized
    exit();
}

// Placeholder for fetching applications from the database
// For demonstration purposes, using dummy data
$applications = [
    1 => ['debtor_name' => 'John Doe', 'requested_amount' => '$1000', 'status' => 'Pending'],
    2 => ['debtor_name' => 'Jane Smith', 'requested_amount' => '$2000', 'status' => 'Approved'],
    3 => ['debtor_name' => 'Mike Johnson', 'requested_amount' => '$1500', 'status' => 'Rejected'],
    // Add more dummy applications as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Manage Applications</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Debtor Name</th>
                    <th>Requested Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $id => $application): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($id); ?></td>
                        <td><?php echo htmlspecialchars($application['debtor_name']); ?></td>
                        <td><?php echo htmlspecialchars($application['requested_amount']); ?></td>
                        <td><?php echo htmlspecialchars($application['status']); ?></td>
                        <td>
                            <a href="view_application.php?id=<?php echo htmlspecialchars($id); ?>" class="btn btn-info btn-sm">View</a>
                            <a href="view_application.php?id=<?php echo htmlspecialchars($id); ?>" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
