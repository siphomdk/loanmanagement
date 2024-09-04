<?php
// view_loans.php

// For demonstration purposes, we'll create an array of dummy loan applications.
// In a real application, this data would come from a database.

$loan_applications = [
    [
        'application_id' => 'APP001',
        'creditor' => 'Creditor A',
        'amount' => 'R10,000',
        'interest_rate' => '5%',
        'term' => '12 months',
        'status' => 'Approved',
        'applied_on' => '2024-01-15'
    ],
    [
        'application_id' => 'APP002',
        'creditor' => 'Creditor B',
        'amount' => 'R5,000',
        'interest_rate' => '4.5%',
        'term' => '6 months',
        'status' => 'Pending',
        'applied_on' => '2024-02-10'
    ],
    [
        'application_id' => 'APP003',
        'creditor' => 'Creditor C',
        'amount' => 'R7,500',
        'interest_rate' => '6%',
        'term' => '9 months',
        'status' => 'Rejected',
        'applied_on' => '2024-03-05'
    ],
    // Add more dummy applications as needed
];
?>

<div>
    <h4>Your Loan Applications</h4>
    <?php if (!empty($loan_applications)) { ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Application ID</th>
                        <th>Creditor</th>
                        <th>Amount</th>
                        <th>Interest Rate</th>
                        <th>Term</th>
                        <th>Status</th>
                        <th>Applied On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($loan_applications as $application) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($application['application_id']); ?></td>
                            <td><?php echo htmlspecialchars($application['creditor']); ?></td>
                            <td><?php echo htmlspecialchars($application['amount']); ?></td>
                            <td><?php echo htmlspecialchars($application['interest_rate']); ?></td>
                            <td><?php echo htmlspecialchars($application['term']); ?></td>
                            <td>
                                <?php
                                    // Apply different badge colors based on status
                                    $status = strtolower($application['status']);
                                    if ($status == 'approved') {
                                        echo '<span class="badge badge-success">Approved</span>';
                                    } elseif ($status == 'pending') {
                                        echo '<span class="badge badge-warning">Pending</span>';
                                    } elseif ($status == 'rejected') {
                                        echo '<span class="badge badge-danger">Rejected</span>';
                                    } else {
                                        echo htmlspecialchars($application['status']);
                                    }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($application['applied_on']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <p>You have no loan applications.</p>
    <?php } ?>
</div>
