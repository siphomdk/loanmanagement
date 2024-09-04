<?php
require_once 'model/DatabaseConnection.php';
require_once 'model/UserModel.php';
require_once 'entities/User.php';
require_once 'model/crud.php';
require_once 'model/AccountModel.php';

$errors = [];
$success = false;
$isEdit = false;
$user = null;

if (isset($_GET['id'])) {
    // Edit mode: Fetch user data based on the ID
    $isEdit = true;
    $userModel = new UserModel();
    $user = $userModel->findById(htmlspecialchars(trim($_GET['id'])));

    if (!$user) {
        $errors[] = 'User not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
    $role = htmlspecialchars(trim($_POST['role']));
    $address = htmlspecialchars(trim($_POST['address']));
    $zipcode = htmlspecialchars(trim($_POST['zipcode']));

    // Basic validation
    if (empty($name) || empty($email) || ($isEdit ? false : empty($password)) || empty($confirm_password) || empty($role)) {
        $errors[] = 'All fields except Address are required.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        // Encrypt the password if it's provided (for new users or password changes)
        $hashed_password = $password ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];

        // Create or update UserModel instance
        $userModel = new UserModel();
        $userModel->setName($name);
        $userModel->setEmail($email);
        $userModel->setPassword($hashed_password);
        $userModel->setRole($role);
        $userModel->setAddress($address);
        $userModel->setZipcode($zipcode);
        $userModel->setStatus('active');
        
        // Account Model instance
        $accountModel = new AccountModel();

        if ($isEdit) {
            $userModel->setEmail(""); // Avoid updating email if in edit mode
            if ($userModel->update($_GET['id'])) {
                $success = true;
                // Log success
                error_log('User updated successfully');
            } else {
                $errors[] = 'An error occurred during the update. Please try again.';
                // Log failure
                error_log('User update failed');
            }
        } else {
            // Save the new user
            if ($userModel->save()) {
                // Create an account for the user with a zero balance
                $userId = $userModel->getLastInsertedId(); // Assuming this method exists to get the last inserted user ID
                if ($accountModel->create([
                    'user_id' => $userId,
                    'balance' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ])) {
                    $success = true;
                } else {
                    $errors[] = 'An error occurred while creating the account. Please try again.';
                }
            } else {
                $errors[] = 'An error occurred during registration. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEdit ? 'Edit User' : 'Register'; ?> - Universal Debt Collector</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center"><?php echo $isEdit ? 'Edit User' : 'Create Your Account'; ?></h2>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo $isEdit ? 'User updated successfully!' : 'Registration successful!'; ?>
                <a href="login.php">Cehck your email for verification</a>.
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="add_edit_user.php<?php echo $isEdit ? '?id=' . $_GET['id'] : ''; ?>" method="POST" class="mt-4">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $isEdit && $user ? $user['name'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $isEdit && $user ? $user['email'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password: <?php echo $isEdit ? '(Leave blank to keep current password)' : ''; ?></label>
                <input type="password" name="password" id="password" class="form-control" <?php echo $isEdit ? '' : 'required'; ?>>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" <?php echo $isEdit ? '' : 'required'; ?>>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="creditor" <?php echo $isEdit && $user && $user['role'] == 'creditor' ? 'selected' : ''; ?>>Creditor</option>
                    <option value="debtor" <?php echo $isEdit && $user && $user['role'] == 'debtor' ? 'selected' : ''; ?>>Debtor</option>
                    <option value="collector" <?php echo $isEdit && $user && $user['role'] == 'collector' ? 'selected' : ''; ?>>Collector</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control" value="<?php echo $isEdit && $user ? $user['address'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="zipcode">Zipcode:</label>
                <input type="text" name="zipcode" id="zipcode" class="form-control" value="<?php echo $isEdit && $user ? $user['zipcode'] : ''; ?>">
            </div>

            <button type="submit" class="btn btn-primary btn-block"><?php echo $isEdit ? 'Update User' : 'Register'; ?></button>
        </form>

        <p class="text-center mt-3"><a href="user_list.php">Back to user list</a>.</p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.
