<?php
// Include necessary files
require_once 'config.php'; // Database connection
require_once 'TicketModel.php';

// Check if user is logged in
/**
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
*/

// Initialize variables
$ticketModel = new TicketModel();
$filter_status = $_GET['status'] ?? 'all'; // Default to showing all tickets

// Fetch tickets based on the filter
if ($filter_status === 'open') {
    $tickets = $ticketModel->fetchTicketsByStatus('open');
} elseif ($filter_status === 'closed') {
    $tickets = $ticketModel->fetchTicketsByStatus('closed');
} else {
    $tickets = $ticketModel->fetchAllTickets();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tickets</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>View Tickets</h1>

        <!-- Filter options -->
        <div class="filter">
            <a href="viewticket.php?status=all" class="<?php echo $filter_status === 'all' ? 'active' : ''; ?>">All Tickets</a>
            <a href="viewticket.php?status=open" class="<?php echo $filter_status === 'open' ? 'active' : ''; ?>">Open Tickets</a>
            <a href="viewticket.php?status=closed" class="<?php echo $filter_status === 'closed' ? 'active' : ''; ?>">Closed Tickets</a>
        </div>

        <!-- Tickets Table -->
        <table>
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Creditor ID</th>
                    <th>Debtor ID</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tickets)): ?>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?php echo $ticket['ticket_id']; ?></td>
                            <td><?php echo $ticket['creditor_id']; ?></td>
                            <td><?php echo $ticket['debtor_id']; ?></td>
                            <td><?php echo $ticket['amount']; ?></td>
                            <td><?php echo $ticket['description']; ?></td>
                            <td><?php echo ucfirst($ticket['status']); ?></td>
                            <td><?php echo $ticket['created_at']; ?></td>
                            <td>
                                <a href="viewbids.php?ticket_id=<?php echo $ticket['ticket_id']; ?>">View Bids</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No tickets found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
