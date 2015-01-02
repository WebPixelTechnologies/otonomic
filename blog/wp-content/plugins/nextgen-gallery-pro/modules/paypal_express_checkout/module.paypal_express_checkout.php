<?php
/**
{
	Module: photocrati-paypal_express_checkout
}
**/
class M_PayPal_Express_Checkout extends C_Base_Module
{
	function define()
	{
		parent::define(
			'photocrati-paypal_express_checkout',
			'PayPal Express Checkout',
			'Provides integration with PayPal Express Checkout',
			'0.2',
			'http://www.nextgen-gallery.com',
			'Photocrati Media',
			'http://www.photocrati.com'
		);

        include_once('class.paypal_express_checkout_installer.php');
        C_Photocrati_Installer::add_handler($this->module_id, 'C_Paypal_Express_Checkout_Installer');
	}

	function _register_adapters()
	{
		$this->get_registry()->add_adapter('I_NextGen_Pro_Checkout', 'A_PayPal_Express_Checkout_Button');
		$this->get_registry()->add_adapter('I_Ajax_Controller', 	 'A_PayPal_Express_Checkout_Ajax');
	}

	function _register_hooks()
	{
		add_action('init', array(&$this, 'process_paypal_responses'));
	}

	function process_paypal_responses()
	{
        // Process return from PayPal
		if (isset($_REQUEST['ngg_ppxc_rtn'])) {
            $checkout = C_NextGen_Pro_Checkout::get_instance();
            if (($order_hash = $checkout->create_paypal_express_order())) {
                $checkout->redirect_to_thank_you_page($order_hash);
            }
		}

        // Process cancelled PayPal order
		elseif (isset($_REQUEST['ngg_ppxc_ccl'])) {
            $checkout = C_NextGen_Pro_Checkout::get_instance();
            $checkout->redirect_to_cancel_page();
		}
	}

	function get_type_list()
	{
		return array(
			'A_PayPal_Express_Checkout_Button'	=>	'adapter.paypal_express_checkout_button.php',
			'A_PayPal_Express_Checkout_Ajax'	=>	'adapter.paypal_express_checkout_ajax.php',
		);
	}
}

new M_PayPal_Express_Checkout;