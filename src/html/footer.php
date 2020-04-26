<!-- ======= Footer ======= -->
<footer id="footer">

    <?php
    global $showDonate;

    ?>

    <?php if ($showDonate): ?>

    <div class="footer-top">

        <div class="container">

            <div class="row  justify-content-center">
                <div class="message-right">
                    <p>Thank you for your support!</p>
                </div>
                <div class="col-lg-6">
                    <h3>Thanks for stopping by this website! You're awesome!</h3>
                    <h5 class="mt-4 mb-4">Please consider donating to help pay for the monthly server costs, my time programming this, or simply to show your support! Or you can donate to tip me, that's accepted as well! Thank You!</h5>
                    <ul class="list-group">
                        <li class="mb-2">
                            <button data-value="0.50" class="btn btn-dark set-value"><span class="money">50&cent; (.50 USD)</span>  <q>Thank you for creating this game! But I don't think I'll spend much time playing.</q></button>
                        </li>
                        <li class="mb-2">
                            <button data-value="2.50" class="btn btn-secondary set-value"><span class="money">$2.50</span> <q>I'm having fun, and I want to support this website.</q></button>
                        </li>
                        <li class="mb-2">
                            <button data-value="5.00" class="btn btn-primary set-value"><span class="money">$5</span> <q>This website is amazing, and I want you to keep it running! Here is some server money!</q></button>
                        </li>
                        <li class="mb-2">
                            <button data-value="10.00" class="btn btn-success set-value"><span class="money">$10</span> <q>This website should be shared with the world! Please advertise it with this money!</q></button>
                        </li>
                        <li class="mb-2">
                            <button data-value="" class="btn btn-warning set-value"><span class="money">Other</span> <q>Really spectacular! I'd like to spare no expense!</q></button>
                        </li>
                        <li class="mt-4 mb-4">
                            <label for="amount-donating">I want to donate this much:</label>
                            <input type="text" class="form-control money-input" id="amount-donating" placeholder="Donate Amount:" value="5.00">
                        </li>
                    </ul>

                    <div id="paypal-button-container"></div>
                    <script src="https://www.paypal.com/sdk/js?client-id=AeWVxNggF0TE9Ldc76RhSKt91tINan3nr1tRzz-PoksFDFt0--y8kPJ242xD-_v9FvqhGwzAVh6mHtYo&currency=USD" data-sdk-integration-source="button-factory"></script>
                    <script>

                        window.onload = function () {

                            $(document).on("click", '.set-value', function (e) {
                                $("#amount-donating").val($(this).data('value'));

                            });
                        };

                        function getValue() {

                            let amount = document.getElementById('amount-donating').value;
                            amount = Number.parseFloat(amount);

                            if (isNaN(amount)) {
                                return '5.00';
                            } else {
                                return amount;
                            }
                        }

                        paypal.Buttons({
                            style: {
                                shape: 'rect',
                                color: 'gold',
                                layout: 'vertical',
                                label: 'paypal',

                            },
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: getValue()
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                                });
                            }
                        }).render('#paypal-button-container');
                    </script>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Copyright <strong><span>Connect4Friends.com</span></strong>. All Rights Reserved
            <BR>This website was written by <a target="_blank" href="https://www.linkedin.com/in/keith-becker-224ab287/">Keith Becker</a> with a number of technologies.
        </div>
    </div>
</footer><!-- End Footer -->