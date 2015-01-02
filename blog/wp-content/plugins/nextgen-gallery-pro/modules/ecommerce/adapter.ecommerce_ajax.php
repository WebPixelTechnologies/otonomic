<?php

class A_Ecommerce_Ajax extends Mixin
{
    function get_digital_download_settings_action()
    {
        $retval = array();
        if (($pricelist = C_Pricelist_Mapper::get_instance()->find_for_image($this->param('image_id')))) {
            $retval = $pricelist->digital_download_settings;
            $retval['header'] = esc_html(__('Digital Downloads', 'nggallery'));
            if (intval($retval['show_licensing_link']) > 0) {
                $retval['licensing_link'] = get_page_link($retval['licensing_page_id']);
                $view_licensing_terms = __('View license terms', 'nggallery');
                $retval['header'] .= " <a href='{$retval['licensing_link']}'>($view_licensing_terms)</a>";
            }
        }
        return $retval;
    }

	function get_cart_items_action()
	{
        $cart = new C_NextGen_Pro_Cart($this->param('cart'));
        return $cart->to_array();
	}

    function get_shipping_amount_action()
    {
        $cart = new C_NextGen_Pro_Cart($this->param('cart'));
        return array('shipping' => $cart->get_shipping($this->param('use_home_country')));
    }

    function get_image_items_action()
    {
        $retval = array();
        if (($image_id = $this->param('image_id'))) {
            $cart = $this->param('cart');
            if (($pricelist = C_Pricelist_Mapper::get_instance()->find_for_image($image_id, TRUE))) {
                $retval = $pricelist->get_items($image_id);

                // Determine if the item is in the cart. If so, set the item's quantity
                if (isset($cart['images'][$image_id])) {
                    foreach ($retval as &$item) {
                        foreach ($cart['images'][$image_id]['items'] as $item_id => $item_props) {
                            if ($item->{$item->id_field} == $item_id) {
                                $item->quantity = $item_props['quantity'];
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $retval;
    }

    function is_order_verified_action()
    {
        $retval = array('verified' => FALSE);

        if (($order = C_Order_Mapper::get_instance()->find_by_hash($this->param('order')))) {
            if ($order->status == 'verified') {
                $retval['verified'] = TRUE;
                $checkout = C_NextGen_Pro_Checkout::get_instance();
                $retval['thank_you_page_url'] = $checkout->get_thank_you_page_url($order->hash, TRUE);
            }
        }
        else $retval['error'] = __("We're sorry, but we couldn't find your order.", 'nggallery');

        return $retval;
    }
}