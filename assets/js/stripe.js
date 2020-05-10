var stripe = Stripe('pk_test_6tl1ar1earwJ7fB4k0snAmFy00BBLPR2oa');
var elements = stripe.elements();
// Set up Stripe.js and Elements to use in checkout form
var style = {
    base: {
      color: "#32325d",
    }
  };
  
var card = elements.create("card", { style: style });
  card.mount("#card-element");

  card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
    if (error) {
      displayError.textContent = error.message;
    } else {
      displayError.textContent = '';
    }
  });

// Évènement pour le submit 
var form = document.getElementById('payment-form');
var clientSecret = form.dataset.secret;

console.log(form);


form.addEventListener('submit', function(ev) {
  ev.preventDefault();

var name      = document.getElementById('name').value
var firstname = document.getElementById('firstname').value

var fullname  = firstname + ' ' + name
  stripe.confirmCardPayment(clientSecret, {
    payment_method: {
      card: card,
      billing_details: {
        name: fullname
      }
    }
  })
  .then(function(result) {
    if (result.error) {
      // Show error to your customer (e.g., insufficient funds)
      console.log(result.error.message);
    } else {
      // The payment has been processed!
    if (result.paymentIntent.status === 'succeeded') {
        console.log(result.paymentIntent.status);
        // document.getElementById('token')= result.paymentIntent.Id

        // Show a success message to your customer
        // There's a risk of the customer closing the window before callback
        // execution. Set up a webhook or plugin to listen for the
        // payment_intent.succeeded event that handles any business critical
        // post-payment actions.
        form.submit();
      }
    }
  });
});