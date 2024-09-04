<?php
// Placeholder for backend logic to reject an application
$id = $_GET['id'] ?? null;
if ($id) {
    // Simulate rejection process
    echo "Application ID $id has been rejected.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Application Rejected</h2>
        <a href="manage_applications.php" class="btn btn-primary">Back to Applications</a>
    </div>
</body>
</html>
