<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to index.php
    header('Location: index.php');
    exit();
}

require_once 'model/crud.php'; // Assuming CRUD is in the same directory
require_once 'model/TicketModel.php'; // Assuming TicketModel is in the same directory

// Initialize the TicketModel
$ticketModel = new TicketModel();

// Create a new ticket
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_ticket'])) {
    $data = [
        'creditor_id' => $_POST['creditor_id'],
        'debtor_id' => $_POST['debtor_id'],
        'amount' => $_POST['amount'],
        'status' => $_POST['status'],
    ];

    $result = $ticketModel->create($data);
    if ($result) {
        $message = "Ticket created successfully.";
    } else {
        $message = "Failed to create ticket.";
    }
}

// Update a ticket
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_ticket'])) {
    $ticket_id = $_POST['ticket_id'];
    $data = [
        'status' => $_POST['status']
    ];

    $result = $ticketModel->update($ticket_id, $data);
    if ($result) {
        $message = "Ticket updated successfully.";
    } else {
        $message = "Failed to update ticket.";
    }
}

// Delete a ticket
if (isset($_GET['delete_ticket'])) {
    $ticket_id = $_GET['delete_ticket'];

    $result = $ticketModel->delete($ticket_id);
    if ($result) {
        $message = "Ticket deleted successfully.";
    } else {
        $message = "Failed to delete ticket.";
    }
}

// Fetch all tickets for viewing
$tickets = $ticketModel->getAllRecordsWithLocation();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ticket System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Create Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">View Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Create a New Ticket</h2>
                <?php if (!empty($message)) : ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>
                <form action="ticket_management.php" method="POST">
                    <div class="form-group">
                        <label for="creditor_id">Creditor ID</label>
                        <input type="text" class="form-control" id="creditor_id" name="creditor_id" required>
                    </div>
                    <div class="form-group">
                        <label for="debtor_id">Debtor ID</label>
                        <input type="text" class="form-control" id="debtor_id" name="debtor_id" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="in-progress">In Progress</option>
                        </select>
                    </div>
                    <button type="submit" name="create_ticket" class="btn btn-primary">Create Ticket</button>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>View Tickets</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Creditor ID</th>
                            <th>Debtor ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['creditor_id']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['debtor_id']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['amount']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['status']); ?></td>
                                <td>
                                    <form action="ticket_management.php" method="POST" style="display:inline-block;">
                                        <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($ticket['id']); ?>">
                                        <select name="status" class="form-control">
                                            <option value="open" <?php if ($ticket['status'] == 'open') echo 'selected'; ?>>Open</option>
                                            <option value="closed" <?php if ($ticket['status'] == 'closed') echo 'selected'; ?>>Closed</option>
                                            <option value="in-progress" <?php if ($ticket['status'] == 'in-progress') echo 'selected'; ?>>In Progress</option>
                                        </select>
                                        <button type="submit" name="update_ticket" class="btn btn-success btn-sm mt-1">Update</button>
                                    </form>
                                    <a href="ticket_management.php?delete_ticket=<?php echo htmlspecialchars($ticket['id']); ?>" class="btn btn-danger btn-sm mt-1">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 p-4 text-center">
        &copy; 2024 Your Company Name. All Rights Reserved.
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
