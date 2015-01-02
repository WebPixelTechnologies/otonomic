<?php

class C_NextGen_Pro_Add_To_Cart
{
    function enqueue_static_resources()
    {
        global $wp_scripts;
        wp_enqueue_script('jquery-ui-accordion');
        M_NextGen_Pro_Lightbox::enqueue_cart_resources();
    }

    function get_sources()
    {
        return array(
            NGG_PRO_DIGITAL_DOWNLOADS_SOURCE    =>  $this->_render_digital_download_template(),
            NGG_PRO_MANUAL_PRICELIST_SOURCE     =>  $this->_render_manual_pricelist_template(),
        );
    }

    function get_i18n_strings()
    {
        $i18n = new stdClass();
        $i18n->add_to_cart  = __('Add To Cart', 'nggallery');
        $i18n->qty_add_desc = __('Change quantities to update your cart.');
        $i18n->checkout     = __('View Cart / Checkout', 'nggallery');
        $i18n->not_for_sale = __('This image is not for sale', 'nggallery');
        $i18n->quantity     = __('Quantity', 'nggallery');
        $i18n->description  = __('Description', 'nggallery');
        $i18n->price        = __('Price', 'nggallery');
        $i18n->total        = __('Total', 'nggallery');
        return $i18n;
    }

    function _render_manual_pricelist_template()
    {
        $heading    = __('Prints & Products', 'nggallery');
        $id         = NGG_PRO_MANUAL_PRICELIST_SOURCE;

        return "<h3>{$heading}</h3><div class='source_contents' id='{$id}'></div>";
    }

    function _render_digital_download_template()
    {
        $heading        = __('Digital Downloads', 'nggallery');
        $license_terms  = __('View license terms', 'nggallery');
        $id             = NGG_PRO_DIGITAL_DOWNLOADS_SOURCE;

        return "<h3><span id='ngg_digital_downloads_header'>{$heading}</span></h3><div class='source_contents' id='{$id}'></div>";
    }

    function render()
    {
        $template = new C_MVC_View('photocrati-nextgen_pro_lightbox#ecommerce/add_to_cart', array(
            'not_for_sale_msg'  =>  C_NextGen_Settings::get_instance()->ecommerce_not_for_sale_msg,
            'sources'           =>  $this->get_sources(),
            'i18n'              =>  $this->get_i18n_strings()
        ));
        return $template->render(TRUE);
    }
}