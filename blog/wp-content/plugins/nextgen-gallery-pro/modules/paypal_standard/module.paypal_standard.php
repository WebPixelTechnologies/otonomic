<?php
/**
{
    Module: photocrati-paypal_standard
}
**/
class M_PayPal_Standard extends C_Base_Module
{
    function define()
    {
        parent::define(
            'photocrati-paypal_standard',
            'PayPal Standard',
            'Provides integration with PayPal Standard',
            '0.2',
            'http://www.nextgen-gallery.com',
            'Photocrati Media',
            'http://www.photocrati.com'
        );

        include_once('class.paypal_standard_installer.php');
        C_Photocrati_Installer::add_handler($this->module_id, 'C_Paypal_Standard_Installer');
    }

    function _register_adapters()
    {
        $this->get_registry()->add_adapter('I_Ajax_Controller', 'A_PayPal_Standard_Ajax');
        $this->get_registry()->add_adapter('I_NextGen_Pro_Checkout', 'A_PayPal_Standard_Button');
        $this->get_registry()->add_adapter('I_Form', 'A_PayPal_Standard_Form', NGG_PRO_PAYMENT_PAYMENT_FORM);
    }

    function _register_hooks()
    {
        add_action('init', array(&$this, 'process_paypal_responses'));
    }

    function process_paypal_responses()
    {
        // Process return from PayPal
        if (isset($_REQUEST['ngg_pstd_rtn'])) {
            C_NextGen_Pro_Checkout::get_instance()->create_paypal_standard_order();
        }

        // Process cancelled PayPal order
        elseif (isset($_REQUEST['ngg_pstd_cnl'])) {
            $checkout = C_NextGen_Pro_Checkout::get_instance();
            $checkout->redirect_to_cancel_page();

        }

        // Process IPN notications
        elseif (isset($_REQUEST['ngg_pstd_nfy'])) {
            $checkout = C_NextGen_Pro_Checkout::get_instance();
            $checkout->paypal_ipn_listener();
        }

    }

    function get_type_list()
    {
        return array(
            'A_PayPal_Standard_Button'	        =>	'adapter.paypal_standard_button.php',
            'A_PayPal_Standard_Form'            =>  'adapter.paypal_standard_form.php',
            'A_PayPal_Standard_Ajax'            =>  'adapter.paypal_standard_ajax.php'
        );
    }
}

new M_PayPal_Standard;