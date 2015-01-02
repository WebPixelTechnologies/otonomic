<?php

class C_NextGen_Pro_Lightbox_Installer
{
    function install_ecommerce_settings($settings)
    {
        $settings->set_default_value('ecommerce_currency', 840); // 'USD'
        $settings->set_default_value('ecommerce_home_country', 840); // 'United States'
        $settings->set_default_value('ecommerce_page_checkout', '');
        $settings->set_default_value('ecommerce_page_thanks', '');
        $settings->set_default_value('ecommerce_page_cancel', '');
        $settings->set_default_value('ecommerce_page_digital_downloads', '');
        $settings->set_default_value('ecommerce_enable_email_notification', TRUE);
        $settings->set_default_value('ecommerce_email_notification_subject', 'New Purchase!');
        $settings->set_default_value('ecommerce_email_notification_recipient', get_bloginfo('admin_email'));
        $settings->set_default_value('ecommerce_enable_email_receipt', TRUE);
        $settings->set_default_value('ecommerce_email_receipt_subject', "Thank you for your purchase!");
        $settings->set_default_value('ecommerce_email_receipt_body', "Thank you for your order, %%customer_name%%.\n\nYou ordered %%item_count%% items, and have been billed a total of %%total_amount%%.\n\nTo review your order, please go to %%order_details_page%%.\n\nThanks for shopping at %%site_url%%!");
        $settings->set_default_value('ecommerce_email_notification_body', "You received a payment of %%total_amount%% from %%customer_name%%. For more details, visit: %%order_details_page%%");
        $settings->set_default_value('ecommerce_not_for_sale_msg', "Sorry, this image is not currently for sale.");
    }

    function install_pro_lightbox_settings($settings)
    {
        $defaults   = array(
            'background_color'          =>  1,
            'enable_routing'            =>  1,
            'icon_color'                =>  '',
            'icon_background'           =>  '',
            'icon_background_enabled'   =>  0,
            'icon_background_rounded'   =>  1,
            'overlay_icon_color'        =>  '',
            'sidebar_button_color'      =>  '',
            'sidebar_button_background' =>  '',
            'router_slug'               =>  'gallery',
            'carousel_background_color' =>  '',
            'carousel_text_color'       =>  '',
            'enable_comments'           =>  1,
            'enable_sharing'            =>  1,
            'display_comments'          =>  0,
            'display_captions'          =>  0,
            'display_carousel'          =>  1,
            'image_crop'                =>  0,
            'image_pan'                 =>  0,
            'interaction_pause'         =>  1,
            'sidebar_background_color'  =>  '',
            'slideshow_speed'           =>  5,
            'style'                     =>  '',
            'touch_transition_effect'   =>  'slide',
            'transition_effect'         =>  'slide',
            'transition_speed'          =>  0.4
        );

        if (!$settings->ngg_pro_lightbox) {
            $settings->ngg_pro_lightbox = array();
        }
        $ngg_pro_lightbox = $settings->get('ngg_pro_lightbox');
        foreach ($defaults as $key => $value) if (!array_key_exists($key, $settings->ngg_pro_lightbox)) {
            $ngg_pro_lightbox[$key] = $value;
        }
        $settings->set('ngg_pro_lightbox', $ngg_pro_lightbox);
    }

    function install($reset=FALSE)
    {
        $settings   = C_NextGen_Settings::get_instance();

        $this->install_pro_lightbox_settings($settings);
        $this->install_ecommerce_settings($settings);
    }
}
