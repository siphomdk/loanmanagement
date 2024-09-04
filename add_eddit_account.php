<?php
// Account.php
require_once 'entities/Account.php'

session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Welcome to Your Account</h1>
    </header>

    <main>
        <?php $account->displayAccountDetails(); ?>

        <h3>Perform a Transaction</h3>
        <form method="POST" action="">
            <label for="transaction_type">Transaction Type:</label>
            <select name="transaction_type" id="transaction_type">
                <option value="deposit">Deposit</option>
                <option value="withdraw">Withdraw</option>
            </select>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" required>

            <button type="submit">Submit</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Financial System. All rights reserved.</p>
    </footer>
</body>
</html>

