<?php

class C_NextGen_Pro_Ecommerce_Trigger extends C_NextGen_Pro_Lightbox_Trigger
{
    static function is_renderable($name, $displayed_gallery)
    {
        $retval = FALSE;

        if (self::is_pro_lightbox_enabled()) {
            if (self::does_source_return_images($displayed_gallery)) {
                if (isset($displayed_gallery->display_settings['is_ecommerce_enabled'])) {
                    $retval = $displayed_gallery->display_settings['is_ecommerce_enabled'];
                }
                elseif (isset($displayed_gallery->display_settings['original_settings']) && isset($displayed_gallery->display_settings['original_settings']['is_ecommerce_enabled'])) {
                    $retval = $displayed_gallery->display_settings['original_settings']['is_ecommerce_enabled'];
                }
            }
        }

        return $retval;
    }

    function get_attributes()
    {
        $attrs = parent::get_attributes();
        $attrs['data-nplmodal-show-cart'] = 1;
        $attrs['data-nplmodal-gallery-id'] = $this->displayed_gallery->transient_id;

        if ($this->view->get_id() == 'nextgen_gallery.image')
        {
            $image = $this->view->get_object();
            $attrs['data-image-id'] = $image->{$image->id_field};
        }

        return $attrs;
    }

    function get_css_class()
    {
        return 'fa ngg-trigger nextgen_pro_lightbox fa-shopping-cart';
    }
}