<script>
       $(document).ready(function() {
            function hideDefaultContent() {
                $('#defaultContent').hide();
            }

            // Load the default page based on the role
            function loadDefaultPage() {
                var defaultPage = 'default.php';
                <?php if ($user_role == 'creditor'): ?>
                    defaultPage = 'creditor_default.php'; // Default page for creditors
                <?php elseif ($user_role == 'debtor'): ?>
                    defaultPage = 'debtor_default.php'; // Default page for debtors
                <?php endif; ?>
                $('#content').load(defaultPage);
            }
            loadDefaultPage(); // Load the default page on load

            // Load the home page
            $('#homeSidebar').click(function() {
                hideDefaultContent();
                loadDefaultPage();
            });

            // Load the create ticket page
            $('#createTicketSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('create_ticket.php');
            });

            // Load the manage applications page
            $('#manageApplicationsSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('manage_applications.php');
            });

            // Load the view debtors page
            $('#viewDebtorsSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('view_debtors.php');
            });

            // Load the view loans page (for debtors)
            $('#viewLoansSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('view_loans.php');
            });

            // Load the make payment page
            $('#makePaymentSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('make_payment.php');
            });
			
			 // Load the view credit offers
            $('#viewCreditoffersSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('credit_offers.php');
            });
			 // Load the view bids
            $('#viewBidsSidebar').click(function() {
                hideDefaultContent();
                $('#content').load('view_bids.php');
            });
			
        });
  </script>