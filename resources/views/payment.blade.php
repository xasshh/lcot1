@include('layouts.header') 

<section class="checkout">
    <div class="container2">
        <h2>Customer Information</h2>
        <form class="checkout-form" id=".checkout-form">
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required>
            </div>
            <h3>Billing Details</h3>
            <div class="form-group">
                <label for="firstName">First Name *</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name *</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <h3>Payment</h3>
            <div class="form-group">
                <label for="cardNumber">Card Number *</label>
                <input type="text" id="cardNumber" name="cardNumber" required>
            </div>
            <div class="form-group">
                <label for="expiryDate">Expiry Date *</label>
                <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV *</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <button type="submit" class="submit-btn" id="payNow" disabled>Pay Now</button>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.checkout-form');
        const payNowButton = document.getElementById('payNow');
        const inputs = form.querySelectorAll('input[required]');

        function checkFormCompletion() {
            let allFilled = true;
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    allFilled = false;
                }
            });
            payNowButton.disabled = !allFilled;
        }

        inputs.forEach(input => {
            input.addEventListener('input', checkFormCompletion);
        });

        checkFormCompletion(); // Initial check
    });

   

payNowButton.addEventListener('click', function(e) {
    e.preventDefault();
    let handler = PaystackPop.setup({
        key: 'pk_test_232263e4309600125b35da4bfa9d4246795c3ac2', // Replace with your public key
        email: document.getElementById('email').value,
        amount: document.getElementById('amount').value * 100, // Amount in kobo
        currency: "NGN",
        callback: function(response) {
            alert('Payment successful. Transaction ref is ' + response.reference);
        },
        onClose: function() {
            alert('Transaction was not completed, window closed.');
        }
    });
    handler.openIframe();
});


</script>

</body>
</html>
@include('layouts.footer') 