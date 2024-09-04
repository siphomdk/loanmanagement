<?php
// Dummy content for Make Payment
echo '
    <h3>Make a Payment</h3>
    <form>
        <div class="mb-3">
            <label for="loanSelect" class="form-label">Select Loan</label>
            <select class="form-select" id="loanSelect">
                <option selected>Select a Loan</option>
                <option value="1">Loan ID 001 - $5,000</option>
                <option value="2">Loan ID 002 - $3,000</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="paymentAmount" class="form-label">Payment Amount</label>
            <input type="number" class="form-control" id="paymentAmount" placeholder="Enter payment amount">
        </div>
        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
';
?>
