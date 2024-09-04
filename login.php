<?php
session_start();


// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the appropriate dashboard based on the user's role
    header('Location: dashboard.php');
    /**if ($_SESSION['user_role'] === 'creditor') {
        header('Location: creditor_dashboard.php');
    } elseif ($_SESSION['user_role'] === 'debtor') {
        header('Location: debtor_dashboard.php');
    } elseif ($_SESSION['user_role'] === 'collector') {
        header('Location: collector_dashboard.php');
    }
    */
    exit(); // Stop further script execution
}

require_once 'model/UserModel.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve the form data
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (empty($email) || empty($password)) {
        $errors[] = 'Both email and password are required.';
    } else {
        // Create a UserModel instance
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user) {
            // Check if the password matches
            if ($password ==$user['password']){
                // Successful login: store user info in the session and redirect to index
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: dashboard.php');
                exit();
            } else {
                $errors[] = 'Invalid email or password.';
                // Debugging: Log the failed password verification attempt
                error_log("Password verification failed for email: $email");
            }
        } else {
            $errors[] = 'Invalid email or password.';
            // Debugging: Log when no user is found
            error_log("No user found for email: $email");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Universal Debt Collector</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <div class="container mt-5">
        <div class="login-container">
            <h2 class="text-center">Login to Your Account</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <p class="text-center mt-3">Don't have an account? <a href="user_form.php">Register here</a>.</p>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
