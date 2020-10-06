@extends('layouts.dashboard_sidebar_and_navbar')
@section('content')


<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}
</style>
    
    <!-- Credit Card Payment Form - START -->
    
    <div class="container">
        <script src="https://js.stripe.com/v3/"></script>
        
        <br>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <a href="{{ route('collections.show', $collection->id) }}" class="btn btn-primary">Go back</a>

                <form action="{{ route('charge') }}" method="POST" id="payment-form" class="form-group">
                    @csrf
                    <div class="form-row">
                        <label for="card-element">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ Auth()->user()->name }}" required>
                    </div>
                    <div class="form-row">
                        <label for="card-element">Surname</label>
                        <input type="text" name="surname" id="surname" value="{{ Auth()->user()->surname }}" class="form-control" required>
                    </div>
                    <div class="form-row">
                        <label for="card-element">Email</label>
                        <input type="text" name="email" id="email" value="{{ Auth()->user()->email }}" class="form-control" required>
                    </div>

                    <div class="form-row">
                        <label for="card-element">Amount (in Rands)</label>
                        <input type="integer" name="amount" id="amount" value="{{ $material_price }}" class="form-control" required>
                    </div>

                    <input type="hidden" name="collection_id" id="collection_id" value="{{ $collection->id }}">
                    <div class="form-row">
                        <label for="card-element">
                        Credit or debit card
                        </label>
                        <div id="card-element" class="form-control">
                        <!-- A Stripe Element will be inserted here. -->
                        </div>
        
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
        
                    <br>
                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                </form>
            </div>
        </div>
    </div>
    
    <style>
        .cc-img {
            margin: 0 auto;
        }
    </style>
    <!-- Credit Card Payment Form - END -->
    
    </div>

<script>
        // Create a Stripe client.
var stripe = Stripe('pk_test_mdYrq3SvV6nEuN7Or7ZNRikG00ptq1TDto');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');



form.addEventListener('submit', function(event) {
  event.preventDefault();

  var options = {
      name:document.getElementById('name').value,
      surname:document.getElementById('surname').value
  }

  
  stripe.createToken(card, options).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection