<?php
// Placeholder for backend logic or database operations
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Debtors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">View Debtors</h2>
        <!-- Example Dummy Debtors Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Debtor ID</th>
                    <th>Name</th>
                    <th>Outstanding Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Generate 10 rows of dummy debtor data
                for ($i = 1; $i <= 10; $i++) {
                    $status = rand(0, 1) ? 'Active' : 'Inactive';
                    echo "<tr>";
                    echo "<td>DEBTOR00$i</td>";
                    echo "<td>Debtor $i</td>";
                    echo "<td>$" . rand(100, 5000) . "</td>";
                    echo "<td>$status</td>";
                    echo "<td>
                            <a href='view_debtor_details.php?id=$i' class='btn btn-info btn-sm'>View Details</a>
                            <a href='edit_debtor.php?id=$i' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_debtor.php?id=$i' class='btn btn-danger btn-sm'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
