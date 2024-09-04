<?php
// Placeholder for backend logic or database operations
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Create Ticket</h2>
        <form action="create_ticket_process.php" method="POST">
            <div class="mb-3">
                <label for="ticketTitle" class="form-label">Ticket Title</label>
                <input type="text" class="form-control" id="ticketTitle" name="ticketTitle" required>
            </div>
            <div class="mb-3">
                <label for="ticketDescription" class="form-label">Description</label>
                <textarea class="form-control" id="ticketDescription" name="ticketDescription" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="ticketAmount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="ticketAmount" name="ticketAmount" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Ticket</button>
        </form>
    </div>
</body>
</html>
