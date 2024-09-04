<?php
session_start();
require_once 'model/offerModel.php';
require_once 'entities/offer.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$errors = [];
$success = false;
$isEdit = false;
$offer = null;
$user_id = $_SESSION['user_id']; // Retrieve user_id from session

if (isset($_GET['id'])) {
    // Edit mode: Fetch offer data based on the offer ID
    $isEdit = true;
    $offerModel = new OfferModel();
    $offer = $offerModel->getOfferById(htmlspecialchars(trim($_GET['id'])));

    if (!$offer) {
        $errors[] = 'Offer not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve the form data
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $interest_rate = htmlspecialchars(trim($_POST['interest_rate']));
    $term_length = htmlspecialchars(trim($_POST['term_length']));
    $amount_min = htmlspecialchars(trim($_POST['amount_min']));
    $amount_max = htmlspecialchars(trim($_POST['amount_max']));

    // Basic validation
    if (empty($title) || empty($description) || empty($interest_rate) || empty($term_length) || empty($amount_min) || empty($amount_max)) {
        $errors[] = 'All fields are required.';
    }

    if (empty($errors)) {
        // Create or update OfferModel instance
        $offerModel = new OfferModel();
        $offerModel->setUserId($user_id); // Set user_id from session
        $offerModel->setTitle($title);
        $offerModel->setDescription($description);
        $offerModel->setInterestRate($interest_rate);
        $offerModel->setTermLength($term_length);
        $offerModel->setAmountMin($amount_min);
        $offerModel->setAmountMax($amount_max);

        if ($isEdit) {
            if ($offerModel->update($_GET['id'])) {
                $success = true;
                // Log success
                error_log('Offer updated successfully');
            } else {
                $errors[] = 'An error occurred during the update. Please try again.';
                // Log failure
                error_log('Offer update failed');
            }
        } else {
            // Save the new offer
            if ($offerModel->save()) {
                $success = true;
                // Log success
                error_log('Offer created successfully');
            } else {
                $errors[] = 'An error occurred during the creation. Please try again.';
                // Log failure
                error_log('Offer creation failed');
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
    <title><?php echo $isEdit ? 'Edit Offer' : 'Create Offer'; ?> - Financial Services</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center"><?php echo $isEdit ? 'Edit Offer' : 'Create Offer'; ?></h2>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <?php echo $isEdit ? 'Offer updated successfully!' : 'Offer created successfully!'; ?>
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

        <form action="add_eddit_offer.php<?php echo $isEdit ? '?id=' . htmlspecialchars(trim($_GET['id'])) : ''; ?>" method="POST" class="mt-4">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $isEdit && $offer ? htmlspecialchars($offer['title']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="3" required><?php echo $isEdit && $offer ? htmlspecialchars($offer['description']) : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="interest_rate">Interest Rate (%):</label>
                <input type="number" step="0.01" name="interest_rate" id="interest_rate" class="form-control" value="<?php echo $isEdit && $offer ? htmlspecialchars($offer['interest_rate']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="term_length">Term Length (months):</label>
                <input type="number" name="term_length" id="term_length" class="form-control" value="<?php echo $isEdit && $offer ? htmlspecialchars($offer['term_length']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="amount_min">Minimum Amount:</label>
                <input type="number" step="0.01" name="amount_min" id="amount_min" class="form-control" value="<?php echo $isEdit && $offer ? htmlspecialchars($offer['amount_min']) : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="amount_max">Maximum Amount:</label>
                <input type="number" step="0.01" name="amount_max" id="amount_max" class="form-control" value="<?php echo $isEdit && $offer ? htmlspecialchars($offer['amount_max']) : ''; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block"><?php echo $isEdit ? 'Update Offer' : 'Create Offer'; ?></button>
        </form>

        <p class="text-center mt-3"><a href="offer_list.php">Back to offer list</a>.</p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
