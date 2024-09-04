<?php
require_once 'model/crud.php';
require_once 'model/UserModel.php';
require_once 'model/AccountModel.php';
require_once 'model/TransactionModel.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$userModel = new UserModel();
$accountModel = new AccountModel();
$transactionModel = new TransactionModel();

// Initialize CRUD for users and accounts
$userCrud = new CRUD('Users', 'id', ['username', 'email', 'password', 'role']);
$accountCrud = new CRUD('Accounts', 'account_id', ['user_id', 'balance', 'account_type', 'created_at']);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accountId = $_POST['account_id'];
    $transactionType = $_POST['transaction_type'];
    $amount = floatval($_POST['amount']);
    $accountData = $accountCrud->read($accountId);

    try {
        // Begin transaction
        $accountCrud->beginTransaction();

        // Update balance
        if ($transactionType === 'deposit') {
            $newBalance = $accountData['balance'] + $amount;
        } elseif ($transactionType === 'withdraw') {
            if ($amount > $accountData['balance']) {
                throw new Exception("Insufficient balance for this withdrawal.");
            }
            $newBalance = $accountData['balance'] - $amount;
        }

        // Update the account balance in the database
        $accountCrud->update($accountId, ['balance' => $newBalance]);

        // Record the transaction in the transactions table
        $transactionData = [
            'account_id' => $accountId,
            'transaction_type' => $transactionType,
            'amount' => $amount,
            'transaction_date' => date('Y-m-d H:i:s')
        ];
        $transactionModel->createTransaction($transactionData);

        // Commit the transaction
        $accountCrud->commit();

        // Refresh account details
        $accountData = $accountCrud->read($accountId);
        $success = "Transaction successful!";
    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        $accountCrud->rollBack();
        $error = $e->getMessage();
    }
}

// Load account data if available
if (isset($_GET['account_id']) && !empty($_GET['account_id'])) {
    $accountId = $_GET['account_id'];
    $accountData = $accountCrud->read($accountId);
} else {
    $accountData = ['account_id' => '', 'user_id' => '', 'balance' => 0.00, 'account_type' => ''];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($accountId) ? 'Edit Account' : 'Add Account'; ?></title>
</head>
<body>
    <h1><?php echo isset($accountId) ? 'Edit Account' : 'Add Account'; ?></h1>

    <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form action="add_edit_account.php" method="POST">
        <?php if (isset($accountId)): ?>
            <input type="hidden" name="account_id" value="<?php echo htmlspecialchars($accountId); ?>">
        <?php endif; ?>

        <label for="transaction_type">Transaction Type:</label>
        <select id="transaction_type" name="transaction_type" required>
            <option value="deposit">Deposit</option>
            <option value="withdraw">Withdraw</option>
        </select>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required>

        <button type="submit"><?php echo isset($accountId) ? 'Update Account' : 'Add Account'; ?></button>
    </form>

    <div id="account-details">
        <h3>Account Details</h3>
        <p>Account ID: <?php echo htmlspecialchars($accountData['account_id']); ?></p>
        <p>Account Type: <?php echo htmlspecialchars($accountData['account_type']); ?></p>
        <p>Balance: R<?php echo number_format($accountData['balance'], 2); ?></p>
    </div>
</body>
</html>
