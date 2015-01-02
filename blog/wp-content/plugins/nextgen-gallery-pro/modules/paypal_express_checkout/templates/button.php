<a href="javascript:void(0)"
   id="paypal_express_checkout_button"
   class="ngg_pro_btn paypal"><?php esc_html_e($value); ?></a>
<script type="text/javascript">
	jQuery(function($){
		$('#paypal_express_checkout_button').click(function(e){
			e.preventDefault();

			// Disable the button from further clicks
			$(this).attr('disabled', 'disabled');

			// Start express checkout with PayPal
			var post_data = $('#ngg_pro_checkout').serialize();
			post_data += "&action=paypal_express_checkout";
			$.post(photocrati_ajax.url, post_data, function(response){
				if (typeof(response) != 'object') {
					response = JSON.parse(response);
				}

				// If there's an error display it
				if (typeof(response.error) != 'undefined') {
					$(this).removeAttr('disabled');
					alert(response.error);
				}

				// Redirect to PayPal
				else {
					window.location = response.redirect;
				}
			});

		});
	});
</script>