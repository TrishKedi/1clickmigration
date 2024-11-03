jQuery("#paypal-button-container").ready(function ($) {
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'checkout',
            size: 'medium',
        },
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: { value: totalAmount }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function () {
                processPayment();
            });
        },
        onError: function (err) {
            showAlert("Error processing payment.");
        }
    }).render('#paypal-button-container');
});
