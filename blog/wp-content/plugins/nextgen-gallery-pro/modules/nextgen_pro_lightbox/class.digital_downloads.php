<?php

class C_Digital_Downloads extends C_MVC_Controller
{
    static $instance = NULL;

    static function get_instance()
    {
        if (!self::$instance) {
            $klass = get_class();
            self::$instance = new $klass;
        }

        return self::$instance;
    }

    function get_i18n_strings($order)
    {
        $retval = new stdClass();
        $retval->image_header               = __('Image', 'nggallery');
        $retval->resolution_header          = __('Resolution', 'nggallery');
        $retval->item_description_header    = __('Item', 'nggallery');
        $retval->download_header            = __('Download Link', 'nggallery');
        $retval->order_info                 = sprintf(__('Digital Downloads for Order #%s', 'nggallery'), $order->ID);

        return $retval;
    }

    function index_action()
    {
       $retval = __('Oops! This page usually displays details for image purchases, but you have not ordered any images yet. Please feel free to continue browsing. Thanks for visiting.', 'nggallery');

       wp_enqueue_style('ngg-digital-downloads-page', $this->get_static_url('photocrati-nextgen_pro_lightbox#digital_downloads_page.css'));

       if (($order = C_Order_Mapper::get_instance()->find_by_hash($this->param('order'), TRUE))) {

           // Display digital downloads for verified transactions
           if ($order->status == 'verified') {
               $retval = $this->render_download_list($order);
           }

           // Display "waiting for confirmation" message
           else {
               $retval = $this->render_partial('photocrati-paypal_standard#waiting_for_confirmation', array(
                   'msg' => __("We haven't received payment confirmation yet. This may take a few minutes. Please wait...")
               ), TRUE);
           }
       }

       return $retval;
    }

    function render_download_list($order)
    {
        $cart = $order->get_cart()->to_array();
        $storage        = C_Gallery_Storage::get_instance();
        $images          = array();
        foreach ($cart['images'] as $image) {
            foreach ($image->items as $item) {
                if ($item->source == NGG_PRO_DIGITAL_DOWNLOADS_SOURCE) {

                    // Use the full resolution image
                    if ($item->resolution == 0) {
                        $image->download_url = $storage->get_original_url($image);
                    }

                    // Get the digital download
                    else {
                        $dynthumbs  = C_Dynamic_Thumbnails_Manager::get_instance();
                        $params = array(
                            'width'     =>  $item->resolution,
                            'height'    =>  $item->resolution,
                            'crop'      =>  FALSE,
                            'watermark' =>  FALSE,
                            'quality'   =>  100
                        );
                        $named_size = $dynthumbs->get_size_name($params);

                        if (!$storage->get_image_abspath($image, $named_size, TRUE)) {
                            $storage->generate_image_size($image, $named_size);
                        }

                        $image->download_url = $storage->get_image_url($image, $named_size);
                    }

                    // Set other properties
                    $image->resolution          = $item->resolution;
                    $image->item_description    = $item->title;
                    $image->thumbnail_url       = $storage->get_thumbnail_url($image);

                    array_push($images, $image);
                }
            }
        }

        return $this->render_partial('photocrati-nextgen_pro_lightbox#ecommerce/digital_downloads_list', array(
            'images' =>  $images,
            'order' =>  $order,
            'i18n'  =>  $this->get_i18n_strings($order)
        ), TRUE);
    }
}