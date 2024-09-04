<?php
// Dummy content for Loan Application
echo '
    <h3>Loan Application</h3>
    <form>
        <div class="mb-3">
            <label for="creditorSelect" class="form-label">Select Creditor</label>
            <select class="form-select" id="creditorSelect">
                <option selected>Select a Creditor</option>
                <option value="1">Creditor A</option>
                <option value="2">Creditor B</option>
                <option value="3">Creditor C</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="loanAmount" class="form-label">Loan Amount</label>
            <input type="number" class="form-control" id="loanAmount" placeholder="Enter amount">
        </div>
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
';
?>
