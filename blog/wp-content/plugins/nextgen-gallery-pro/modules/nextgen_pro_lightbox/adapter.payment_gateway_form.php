<?php

class A_Payment_Gateway_Form extends Mixin
{
	function get_title()
	{
		return $this->get_page_heading();
	}

	function get_page_heading()
	{
		return __('Payment Gateway','nggallery');
	}

    /**
     * These should be moved to their appropriate module
     * @return array
     */
    function _get_field_names()
    {
        return array(
            'nextgen_pro_ecommerce_stripe_enable',
            'nextgen_pro_ecommerce_stripe_key_public',
            'nextgen_pro_ecommerce_stripe_key_private',
            'nextgen_pro_ecommerce_paypal_enable',
            'nextgen_pro_ecommerce_paypal_sandbox',
            'nextgen_pro_ecommerce_paypal_email',
            'nextgen_pro_ecommerce_paypal_username',
            'nextgen_pro_ecommerce_paypal_password',
            'nextgen_pro_ecommerce_paypal_signature'
        );
    }

    function save_action()
    {
        $ecommerce = $this->param('ecommerce');
        if (empty($ecommerce))
            return;
    }

    function enqueue_static_resources()
    {
        wp_enqueue_script(
            'photocrati-nextgen_pro_ecommerce_payment_gateway-settings-js',
            $this->get_static_url('photocrati-nextgen_pro_lightbox#ecommerce_payment_gateway_form_settings.js'),
            array('jquery.nextgen_radio_toggle')
        );
    }

    function _render_nextgen_pro_ecommerce_stripe_enable_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_radio_field(
            $model,
            'stripe_enable',
            __('Enable Stripe', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_stripe_enable
        );
    }

    function _render_nextgen_pro_ecommerce_stripe_sandbox_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_radio_field(
            $model,
            'stripe_sandbox',
            __('Use sandbox', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_stripe_sandbox,
            'If enabled transactions will use testing servers on which no currency is actually moved',
            !C_NextGen_Settings::get_instance()->ecommerce_stripe_enable ? TRUE : FALSE
        );
    }

    function _render_nextgen_pro_ecommerce_stripe_key_public_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_text_field(
            $model,
            'stripe_key_public',
            __('Public key', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_stripe_key_public,
            '',
            !C_NextGen_Settings::get_instance()->ecommerce_stripe_enable ? TRUE : FALSE
        );
    }

    function _render_nextgen_pro_ecommerce_stripe_key_private_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_text_field(
            $model,
            'stripe_key_private',
            __('Private key', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_stripe_key_private,
            '',
            !C_NextGen_Settings::get_instance()->ecommerce_stripe_enable ? TRUE : FALSE
        );
    }

    function _render_nextgen_pro_ecommerce_paypal_enable_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_radio_field(
            $model,
            'paypal_enable',
            __('Enable PayPal Express Checkout', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_paypal_enable
        );
    }

    function _render_nextgen_pro_ecommerce_paypal_sandbox_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_radio_field(
            $model,
            'paypal_sandbox',
            __('Use sandbox?', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_paypal_sandbox,
            'If enabled transactions will use testing servers on which no currency is actually moved',
            !C_NextGen_Settings::get_instance()->ecommerce_paypal_enable ? TRUE : FALSE
        );
    }

    function _render_nextgen_pro_ecommerce_paypal_email_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_text_field(
            $model,
            'paypal_email',
            __('Email', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_paypal_email,
            '',
            !C_NextGen_Settings::get_instance()->ecommerce_paypal_enable ? TRUE : FALSE
        );
    }

    function _render_nextgen_pro_ecommerce_paypal_username_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_text_field(
            $model,
            'paypal_username',
            __('API Username', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_paypal_username,
            '',
            !C_NextGen_Settings::get_instance()->ecommerce_paypal_enable ? TRUE : FALSE
        );
    }

    function _render_nextgen_pro_ecommerce_paypal_password_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_text_field(
            $model,
            'paypal_password',
            __('API Password', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_paypal_password,
            '',
            !C_NextGen_Settings::get_instance()->ecommerce_paypal_enable ? TRUE : FALSE
        );
    }

    function _render_nextgen_pro_ecommerce_paypal_signature_field($model)
    {
        $model = new stdClass;
        $model->name = 'ecommerce';
        return $this->_render_text_field(
            $model,
            'paypal_signature',
            __('API Signature', 'nggallery'),
            C_NextGen_Settings::get_instance()->ecommerce_paypal_signature,
            '', // Tooltip text
            !C_NextGen_Settings::get_instance()->ecommerce_paypal_enable ? TRUE : FALSE
        );
    }
}