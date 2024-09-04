<?php
// Placeholder for backend logic or database operations
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Manage Tickets</h2>
        <!-- Example Dummy Tickets Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Generate 10 rows of dummy ticket data
                for ($i = 1; $i <= 10; $i++) {
                    $status = rand(0, 1) ? 'Open' : 'Closed';
                    echo "<tr>";
                    echo "<td>TICK00$i</td>";
                    echo "<td>Sample Ticket $i</td>";
                    echo "<td>Details of ticket $i</td>";
                    echo "<td>$" . rand(100, 1000) . "</td>";
                    echo "<td>$status</td>";
                    echo "<td>
                            <a href='edit_ticket.php?id=$i' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_ticket.php?id=$i' class='btn btn-danger btn-sm'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
