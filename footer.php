	<?php wp_footer(); ?>

	<script>
		var donationAmount;

		var handler = StripeCheckout.configure({
			// key: 'pk_test_4XeVhaeYMMQeeQPayeee7e8R',
  			key: 'pk_live_ugziOTyO1E0aois2KfII38Wj',
  			// image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
  			locale: 'auto',
  			token: function(token) {
    			// You can access the token ID with `token.id`.
    			// Get the token ID to your server-side code for use.

    			// disable button
    			jQuery('#donate-form button').attr('disabled', '').addClass('m-progress');

    			jQuery.ajax({
    				url: '<?php echo admin_url('admin-ajax.php'); ?>',
    				data: {
    					action: 'process_donate',
    					amount: donationAmount,
    					token: token.id
    				},
    				type: 'post',
    				dataType: 'json',
    				success: function(result) {
    					jQuery('#donate-form button').removeAttr('disabled').removeClass('m-progress');
	    				if (result.error) {
	    					jQuery('#donate-form').append('<span class="text-danger">' + result.error + '</span>');
	    				}
	    				else {
	    					jQuery('#donate-form').append('<span class="text-success">' + result.message + '</span>');	
	    					jQuery('#donate-amount').val('');
	    				}
	    			}
    			});
  			}
		});

		jQuery('body').on('submit', '#donate-form', function(e) { 

			// remove previous error
			jQuery('#donate-form span.text-danger').remove();

			// validate
			var amount = parseFloat(jQuery('#donate-amount').val());

			if ( isNaN(amount) || amount <= 0 ) {
				jQuery('#donate-form').append('<span class="text-danger">Please enter a numeric amount greater than 0.</span>');
				return false;
			}

  			// Open Checkout with further options:
  			handler.open({
    			name: 'Shift',
    			description: 'Donation',
    			currency: 'cad',
    			amount: amount * 100
  			});
  			donationAmount = amount;
  			e.preventDefault();
		});

		// Close Checkout on page navigation:
		window.addEventListener('popstate', function() {
  			handler.close();
		});

		jQuery('body').on('click', 'a[href^="#"], a[href="/#donate"]', function(e){

			if ( !jQuery(this.hash).length )
				return true;

			e.preventDefault();

			var target = this.hash;
	    	var $target = jQuery(target);

	    	jQuery('html, body').stop().animate({
	        	'scrollTop': $target.offset().top
	    	}, 900, 'swing', function () {
	        	window.location.hash = target;
	    	});

		});
	</script>

	</body>
</html>