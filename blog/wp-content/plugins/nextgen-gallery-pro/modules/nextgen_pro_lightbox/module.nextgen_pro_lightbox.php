<?php
/*
{
    Module: photocrati-nextgen_pro_lightbox,
    Depends: { photocrati-lightbox }
}
 */

define('NGG_PRO_LIGHTBOX', 'photocrati-nextgen_pro_lightbox');
define('NGG_PRO_LIGHTBOX_TRIGGER', NGG_PRO_LIGHTBOX);
define('NGG_ECOMMERCE_TRIGGER', 'photocrati-ecommerce');
define('NGG_PRO_LIGHTBOX_COMMENT_TRIGGER', 'photocrati-nextgen_pro_lightbox_comments');
define('NGG_PRO_PRICELIST_SOURCE_PAGE', 'ngg-pricelist-source-page');
define('NGG_PRO_ECOMMERCE_OPTIONS_PAGE', 'ngg_ecommerce_options');
define('NGG_PRO_MANUAL_PRICELIST_SOURCE', 'ngg_manual_pricelist');
define('NGG_PRO_DIGITAL_DOWNLOADS_SOURCE', 'ngg_digital_downloads');
define('NGG_PRO_PAYMENT_PAYMENT_FORM', 'ngg-payment-gateways');
define('NGG_PRO_ECOMMERCE_OPTIONS_FORM', 'ngg-ecommerce-options');
define('NGG_PRO_ECOMMERCE_INSTRUCTIONS_FORM', 'ngg-ecommerce-instructions');
define('NGG_PRO_MAIL_FORM', 'ngg-mail');

class M_NextGen_Pro_Lightbox extends C_Base_Module
{
    function define($context=FALSE)
    {
        parent::define(
            NGG_PRO_LIGHTBOX,
            'NextGEN Pro Lightbox',
            'Provides a lightbox with integrated commenting, social sharing, and e-commerce functionality',
            '0.20',
            'http://www.photocrati.com',
            'Photocrati Media',
            'http://www.photocrati.com',
            $context
        );

        include_once('class.nextgen_pro_lightbox_installer.php');
        C_Photocrati_Installer::add_handler($this->module_id, 'C_NextGen_Pro_Lightbox_Installer');
    }

    function initialize()
    {
        parent::initialize();

        // Add triggers
        $triggers = C_Displayed_Gallery_Trigger_Manager::get_instance();
        $triggers->add(NGG_PRO_LIGHTBOX_TRIGGER,           'C_NextGen_Pro_Lightbox_Trigger');
        $triggers->add(NGG_PRO_LIGHTBOX_COMMENT_TRIGGER,   'C_NextGen_Pro_Lightbox_Trigger');
        $triggers->add(NGG_ECOMMERCE_TRIGGER,              'C_NextGen_Pro_Ecommerce_Trigger');

        // Add pricelist sources
        $sources = C_Pricelist_Source_Manager::get_instance();
        $sources->register(NGG_PRO_MANUAL_PRICELIST_SOURCE, array(
            'title'              =>  'Manual Pricelist',
            'shipping_method'    =>  'C_NextGen_Pro_Flat_Rate_Shipping_Calculator',
            'settings_field'     =>  'manual_settings',
        ));
        $sources->register(NGG_PRO_DIGITAL_DOWNLOADS_SOURCE, array(
            'title'             =>  'Digital Downloads',
            'shipping_method'   =>  NULL,
            'settings_field'    =>  'digital_download_settings'
        ));

        // Add shortcodes
        C_NextGen_Shortcode_Manager::add('ngg_pro_cart_count', array(&$this, 'render_cart_count'));
        C_NextGen_Shortcode_Manager::add('ngg_pro_checkout', array(&$this, 'render_checkout_form'));
        C_NextGen_Shortcode_Manager::add('ngg_pro_digital_downloads', array(&$this, 'render_digital_downloads'));
        C_NextGen_Shortcode_Manager::add('ngg_pro_order_details', array(&$this, 'render_order_details'));
    }

    function _register_adapters()
    {
        // factory methods
        $this->get_registry()->add_adapter('I_Component_Factory', 'A_NextGen_Pro_Lightbox_Factory');

        // controllers & their helpers
        $this->get_registry()->add_adapter('I_Display_Type_Controller', 'A_NextGen_Pro_Lightbox_Effect_Code');

        // routes & rewrites
        $this->get_registry()->add_adapter('I_Router', 'A_NextGen_Pro_Lightbox_Routes');

        if (is_admin()) {
            // settings forms
            $this->get_registry()->add_adapter('I_Display_Type_Form', 'A_NextGen_Pro_Lightbox_Triggers_Form');
            $this->get_registry()->add_adapter('I_Display_Type_Form', 'A_Display_Type_Ecommerce_Form');
            $this->get_registry()->add_adapter('I_Form', 'A_Manual_Pricelist_Form', NGG_PRO_MANUAL_PRICELIST_SOURCE);
            $this->get_registry()->add_adapter('I_Form', 'A_Digital_Downloads_Form', NGG_PRO_DIGITAL_DOWNLOADS_SOURCE);
            $this->get_registry()->add_adapter('I_Form', 'A_Ecommerce_Instructions_Form', NGG_PRO_ECOMMERCE_INSTRUCTIONS_FORM);
            $this->get_registry()->add_adapter('I_Form', 'A_Ecommerce_Options_Form', NGG_PRO_ECOMMERCE_OPTIONS_FORM);
            $this->get_registry()->add_adapter('I_Form', 'A_Payment_Gateway_Form', NGG_PRO_PAYMENT_PAYMENT_FORM);
            $this->get_registry()->add_adapter('I_Form', 'A_NextGen_Pro_Lightbox_Mail_Form', NGG_PRO_MAIL_FORM);
            $this->get_registry()->add_adapter('I_Form', 'A_NextGen_Pro_Lightbox_Form', NGG_PRO_LIGHTBOX);
        }

        // e-commerce stuff
        $this->_get_registry()->add_adapter('I_Gallery_Mapper', 'A_Ecommerce_Gallery');
        $this->_get_registry()->add_adapter('I_Image_Mapper',   'A_Ecommerce_Image');
        $this->_get_registry()->add_adapter('I_Page_Manager',   'A_NextGen_Pro_Lightbox_Pages');
        $this->_get_registry()->add_adapter('I_Ajax_Controller','A_Ecommerce_Ajax');

        $this->get_registry()->add_adapter('I_Router', 'A_Image_Protection_Routes');
        $this->get_registry()->add_adapter('I_GalleryStorage_Driver', 'A_Image_Protection_Storage_Driver');
        $this->get_registry()->add_adapter('I_Form', 'A_Reset_Ecommerce_Settings_Form', 'reset');
    }

    function _register_utilities()
    {
        // The second controller is for handling lightbox display
        $this->get_registry()->add_utility('I_NextGen_Pro_Lightbox_Controller', 'C_NextGen_Pro_Lightbox_Controller');
        $this->get_registry()->add_utility('I_OpenGraph_Controller', 'C_OpenGraph_Controller');

        $this->get_registry()->add_utility('I_Image_Protection_Manager', 'C_Image_Protection_Manager');
        $this->get_registry()->add_utility('I_Image_Protection_Controller', 'C_Image_Protection_Controller');

        $this->get_registry()->add_utility('I_Nextgen_Mail_Manager', 'C_Nextgen_Mail_Manager');
    }

    function _register_hooks()
    {
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_resources'));
        add_action('init', array(&$this, 'register_post_types'));
        add_filter('ngg_manage_gallery_fields', array(&$this, 'add_gallery_pricelist_field'), 20, 2);
        add_filter('ngg_manage_images_number_of_columns', array(&$this, 'add_ecommerce_column'));
        add_filter('get_edit_post_link', array(&$this, 'edit_pricelist_link'));
        add_action('admin_menu', array(&$this, 'add_manage_pricelist_page'), PHP_INT_MAX-1);
        add_action('admin_init', array(&$this, 'redirect_to_manage_pricelist_page'));
        add_filter('the_posts', array(&$this, 'serve_ecommerce_pages'));
        add_action('ngg_registered_default_lightboxes', array(&$this, 'register_lightbox'));
        add_action('admin_init', array(&$this, 'register_form'));

        // Flush the cart when the order is complete
        if (isset($_REQUEST['ngg_order_complete']))
            add_filter('the_posts', array(&$this, 'flush_cart'));

        C_NextGen_Shortcode_Manager::add('ngg_pro_cart_count', array(&$this, 'render_cart_count'));
        C_NextGen_Shortcode_Manager::add('ngg_pro_checkout', array(&$this, 'render_checkout_form'));
        C_NextGen_Shortcode_Manager::add('ngg_pro_digital_downloads', array(&$this, 'render_digital_downloads'));
        C_NextGen_Shortcode_Manager::add('ngg_pro_order_details', array(&$this, 'render_order_details'));
        C_NextGen_Shortcode_Manager::add('ngg_pro_verify_order', array(&$this, 'render_order_verification'));

        // If we're on the "Manage Pricelists" page, then we need to hide the "Quick Edit" button
        if (strpos($_SERVER['SCRIPT_NAME'], '/wp-admin/edit.php') !== FALSE &&
            isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'ngg_pricelist') {
            add_filter('post_row_actions', array(&$this, 'hide_quick_edit_link'));
        }
    }

    function register_form()
    {
        $forms = C_Form_Manager::get_instance();
        $forms->add_form(NGG_LIGHTBOX_OPTIONS_SLUG, NGG_PRO_LIGHTBOX);
        $forms->add_form(NGG_PRO_ECOMMERCE_OPTIONS_PAGE, NGG_PRO_ECOMMERCE_INSTRUCTIONS_FORM);
        $forms->add_form(NGG_PRO_PRICELIST_SOURCE_PAGE, NGG_PRO_MANUAL_PRICELIST_SOURCE);
        $forms->add_form(NGG_PRO_PRICELIST_SOURCE_PAGE, NGG_PRO_DIGITAL_DOWNLOADS_SOURCE);
        $forms->add_form(NGG_PRO_ECOMMERCE_OPTIONS_PAGE, NGG_PRO_ECOMMERCE_OPTIONS_FORM);
        $forms->add_form(NGG_PRO_ECOMMERCE_OPTIONS_PAGE, NGG_PRO_MAIL_FORM);
        $forms->add_form(NGG_PRO_ECOMMERCE_OPTIONS_PAGE, NGG_PRO_PAYMENT_PAYMENT_FORM);
    }

    function register_lightbox()
    {
        $router             = C_Router::get_instance();
        $settings           = C_NextGen_Settings::get_instance()->get('ngg_pro_lightbox', array());
        $lightboxes         = C_Lightbox_Library_Manager::get_instance();

        // Add lightbox components
        $lightbox_controller = C_NextGen_Pro_Lightbox_Controller::get_instance();
        $lightbox_controller->add_component('photocrati-add_to_cart', 'C_NextGen_Pro_Add_To_Cart');

        // Define the Pro Lightbox
        $lightbox           = new stdClass();
        $lightbox->title    = __('NextGEN Pro Lightbox', 'nggallery');
        $lightbox->code     = "class='nextgen_pro_lightbox' data-nplmodal-gallery-id='%PRO_LIGHTBOX_GALLERY_ID%'";
        $lightbox->styles   = array(
            'photocrati-nextgen_pro_lightbox#style.css'
        );
        $lightbox->scripts  = array(
            'wordpress#underscore',
            'wordpress#backbone',
            'photocrati-nextgen_pro_lightbox#jquery.velocity.min.js',
            'photocrati-nextgen_pro_lightbox#jquery.mobile_browsers.js',
            "photocrati-nextgen_pro_lightbox#nextgen_pro_lightbox.js"
        );

        // Set lightbox display properties
        $settings['is_front_page']  = is_front_page() ? 1 : 0;
        $settings['gallery_url']    = $router->get_url('/nextgen-pro-lightbox-gallery/{gallery_id}/');
        $settings['gallery_url']    = $router->get_url('/nextgen-pro-lightbox-gallery/{gallery_id}/');
        $settings['share_url']      = $router->get_url('/nextgen-share/{gallery_id}/{image_id}/{named_size}');
        $settings['wp_site_url']    = $router->get_base_url();
        $settings['theme']          = $router->get_static_url('photocrati-nextgen_pro_lightbox#theme/galleria.nextgen_pro_lightbox.js');
        $lightbox->values = array('nplModalSettings' => $settings);

        // Register the lightbox
        $lightboxes->register(NGG_PRO_LIGHTBOX, $lightbox);
    }

    /**
     * Hides the quick edit button to avoid users changing the post_status of a pricelist
     * @param $actions
     * @return mixed
     */
    function hide_quick_edit_link($actions)
    {
        return array(
            'edit'  =>  $actions['edit'],
            'trash' =>  $actions['trash']
        );
    }


    function flush_cart($posts)
    {
        // Ensure that this filter only executes once during the request
        remove_filter('the_posts', array(&$this, 'flush_cart'));

        // Append to the post a JavaScript statement to delete the cart
        if ($posts) {
            $post = $posts[0];
            $post->post_content = "<script type='text/javascript'>jQuery(function(){Ngg_Store.del('ngg_pro_cart');Ngg_Store.save()});</script>".$post->post_content;
        }

        return $posts;
    }

    function serve_ecommerce_pages($posts)
    {
        $serving = FALSE;

        if (isset($_REQUEST['ngg_pro_digital_downloads_page'])) {
            $post = new stdClass;
            $post->name = 'ngg_pro_digital_downloads_page';
            $post->post_title = __('Digital Downloads', 'nggallery');
            $post->post_parent = 0;
            $post->post_content = "[ngg_pro_digital_downloads]";
            $post->post_type = 'page';
            $posts = array($post);
            $serving = TRUE;
        }
        elseif (isset($_REQUEST['ngg_pro_checkout_page'])) {
            $post = new stdClass;
            $post->name = 'ngg_pro_checkout_page';
            $post->post_title = __('Checkout', 'nggallery');
            $post->post_parent = 0;
            $post->post_content = "[ngg_pro_checkout]";
            $post->post_type = 'page';
            $post->comment_status = 'closed';
            $posts = array($post);
            $serving = TRUE;
        }
        elseif (isset($_REQUEST['ngg_pro_return_page'])) {
            $post = new stdClass;
            $post->name = 'ngg_pro_return_page';
            $post->post_title = __('Order Details', 'nggallery');
            $post->post_parent = 0;
            $post->post_content = "[ngg_pro_order_details]";
            $post->post_type = 'page';
            $post->comment_status = 'closed';
            $posts = array($post);
            $serving = TRUE;
        }
        elseif (isset($_REQUEST['ngg_pro_cancel_page'])) {
            $post = new stdClass;
            $post->name = 'ngg_pro_return_page';
            $post->post_title = __('Order Cancelled', 'nggallery');
            $post->post_parent = 0;
            $post->post_content = __('Your order was cancelled', 'nggallery');
            $post->post_type = 'page';
            $post->comment_status = 'closed';
            $posts = array($post);
            $serving = TRUE;
        }
        elseif (isset($_REQUEST['ngg_pro_verify_page'])) {
            $post = new stdClass;
            $post->name = 'ngg_pro_verifying_order_page';
            $post->post_title = __('Verifying order', 'nggallery');
            $post->post_parent = 0;
            $post->post_content = '[ngg_pro_verify_order]';
            $post->post_type = 'page';
            $post->comment_status = 'closed';
            $posts = array($post);
            $serving = TRUE;
        }

        remove_filter('the_posts', array(&$this, 'serve_ecommerce_pages'));

        return $posts;
    }

    function render_cart_count()
    {
        self::enqueue_cart_resources();
        return "<script type=text/javascript'>document.write(Ngg_Pro_Cart.get_instance().length);</script>";
    }

    function render_checkout_form()
    {
        $checkout = C_NextGen_Pro_Checkout::get_instance();
        return $checkout->checkout_form();
    }

    function render_digital_downloads()
    {
        $controller = C_Digital_Downloads::get_instance();
        return $controller->index_action();
    }

    function render_order_verification()
    {
        $controller = C_NextGen_Pro_Order_Verification::get_instance();
        return $controller->render($_REQUEST['order']);
    }

    function render_order_details($attrs=array(), $inner_content='')
    {
        $retval = __('Oops! This page usually displays details for image purchases, but you have not ordered any images yet. Please feel free to continue browsing. Thanks for visiting.', 'nggallery');

        // Get the order to display
        $order_id   = FALSE;
        $method     = FALSE;
        if     (isset($attrs['order'])) {
            $order_id = $attrs['order'];
            $method = 'find_by_hash';
        }
        elseif (isset($_REQUEST['order'])) {
            $order_id = $_REQUEST['order'];
            $method = 'find_by_hash';
        }
        elseif (isset($attrs['order_id'])) {
            $order_id = $attrs['order_id'];
            $method = 'find';
        }

        // If we have an order, continue...
        if ($method && (($order = C_Order_Mapper::get_instance()->$method($order_id, TRUE)))) {

            // If no inner connect has been added, then use our own
            if (!$inner_content) $inner_content = "Thank you for your order, [customer_name].
                <br/>
                You ordered the following items:
                [items]

                [if_ordered_shippable_items]
                <p>
                We will be shipping your items to:<br/>
                [shipping_street_address]<br/>
                [shipping_city], [shipping_state] [shipping_zip]<br/>
                [shipping_country]
                </p>
                [/if_ordered_shippable_items]

                [if_ordered_digital_downloads]
                <p>You may download your digital products <a href='[digital_downloads_page_url]'>here.</a></p>
                [/if_ordered_digital_downloads]
            ";

            $retval = $inner_content;

            // Substitute placeholders for each variable of the order
            foreach (get_object_vars($order->get_entity()) as $key => $value) {
                switch ($key) {
                    case 'ID':
                        $key = 'order_id';
                        break;
                    case 'post_date':
                        $key = 'order_date';
                        break;
                    case 'post_author':
                    case 'post_title':
                    case 'post_excerpt':
                    case 'post_status':
                    case 'comment_status':
                    case 'ping_status':
                    case 'post_name':
                    case 'to_ping':
                    case 'pinged':
                    case 'post_content_filtered':
                    case 'post_content':
                    case 'menu_order':
                    case 'post_type':
                        continue;
                        break;
                    case 'meta_value':
                        $key = 'order_hash';
                        break;
                    case 'total_amount':
                        // return formatted version;
                        break;
                }
                if (!is_array($value)) $retval = str_replace("[{$key}]", esc_html($value), $retval);
            };

            // Parse [if_ordered_shippable_items]
            $open_tag   = preg_quote("[if_ordered_shippable_items]", '#');
            $close_tag  = preg_quote("[/if_ordered_shippable_items]", '#');
            $regex      = "#{$open_tag}(.*){$close_tag}#ms";
            if (preg_match_all($regex, $retval, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $replacement = $order->get_cart()->has_shippable_items() ? $match[1] : '';
                    $retval = str_replace($match[0], $replacement, $retval);
                }
            }

            // Parse [if_ordered_digital_downloads]
            $open_tag   = preg_quote("[if_ordered_digital_downloads]", '#');
            $close_tag  = preg_quote("[/if_ordered_digital_downloads]", '#');
            $regex      = "#{$open_tag}(.*){$close_tag}#ms";
            if (preg_match_all($regex, $retval, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $replacement = $order->get_cart()->has_digital_downloads() ? $match[1] : '';
                    $retval = str_replace($match[0], $replacement, $retval);
                }
            }

            // Digital downloads page url
            $retval = str_replace(
                '[digital_downloads_page_url]',
                $this->get_digital_downloads_url($order->hash),
                $retval
            );

            // Render cart
            if (strpos($retval, '[items]') !== FALSE) {
                $retval = str_replace(
                    '[items]',
                    C_NextGen_Pro_Order_Controller::get_instance()->render($order->get_cart()),
                    $retval
                );
            }

            $retval = apply_filters('ngg_order_details', $retval);
        }

        return $retval;
    }

    static function get_formatted_price($value, $country=FALSE, $use_fontawesome=TRUE)
    {
        return sprintf(self::get_price_format_string($country, $use_fontawesome), $value);
    }

    static function get_price_format_string($currency = FALSE, $use_fontawesome=TRUE)
    {
        $settings = C_NextGen_Settings::get_instance();

        if (empty($currency))
            $currency = $settings->ecommerce_currency;

        $currency = C_NextGen_Pro_Currencies::$currencies[$currency];

        if (!empty($currency['fontawesome']) AND $use_fontawesome)
        {
            $symbol = $currency['fontawesome'];
            $symbol = "<i class='fa {$symbol}'></i>";
        }
        else {
            $symbol = $currency['symbol'];
        }

        $retval = "%.{$currency['exponent']}f";

        $original_locale = setlocale(LC_MONETARY, '0');
        setlocale(LC_MONETARY, WPLANG);
        $locale = localeconv();
        setlocale(LC_MONETARY, $original_locale);

        $space = '';
//        if ($locale['p_sep_by_space'])
//            $space = ' ';

        if ($locale['p_cs_precedes'])
            $retval = $symbol . $space . $retval;
        else
            $retval = $retval . $space . $symbol;


        return $retval;
    }

    static function enqueue_cart_resources()
    {
        $router = C_Router::get_instance();
        if (!wp_script_is('sprintf')) {
            wp_register_script('sprintf', $router->get_static_url('photocrati-nextgen_pro_lightbox#sprintf.js'));
        }
        wp_register_script('ngg_pro_cart', $router->get_static_url('photocrati-nextgen_pro_lightbox#cart.js'), array('ngg-store-js', 'backbone', 'sprintf'));

        wp_enqueue_script('ngg_pro_cart');
        wp_localize_script('ngg_pro_cart', 'Ngg_Pro_Cart_Settings', array(
           'currency_format'    =>   M_NextGen_Pro_Lightbox::get_price_format_string(),
           'checkout_url'       =>   M_NextGen_Pro_Lightbox::get_checkout_page_url()
        ));
    }

    function enqueue_resources()
    {
        if (!wp_script_is('sprintf')) {
            $router = C_Router::get_instance();
            wp_register_script('sprintf', $router->get_static_url('photocrati-nextgen_pro_lightbox#sprintf.js'));
        }

        // When the ngg_order_complete parameter is present in the querystring, then
        // we'll enqueue ngg_order_complete and then use the_posts filter to append a <script> tag
        // to the post content, which will delete the cart
        if (isset($_REQUEST['ngg_order_complete'])) {
            wp_enqueue_script('ngg-store-js');
        }
    }

    function add_manage_pricelist_page()
    {
        add_submenu_page(
            NULL,
            __('Manage Pricelist', 'nggallery'),
            __('Manage Pricelist', 'nggallery'),
            'NextGEN Change options',
            'manage_ngg_pricelist',
            array(&$this, 'render_manage_pricelist_page')
        );
    }

    function register_post_types()
    {
        register_post_type('ngg_pricelist', array(
            'show_ui'               =>  TRUE,
            'labels'                =>  array(
                'name'              =>  __('Pricelists', 'nggallery'),
                'singular_name'     =>  __('Pricelist', 'nggallery'),
                'menu_name'         =>  __('Pricelist', 'nggallery'),
                'add_new_item'      =>  __('Add New Pricelist', 'nggallery'),
                'edit_item'         =>  __('Edit Pricelist', 'nggallery'),
                'new_item'          =>  __('New Pricelist', 'nggallery'),
                'view_item'         =>  __('View Pricelist', 'nggallery'),
                'search_items'      =>  __('Search Pricelists', 'nggallery'),
                'not_found'         =>  __('No pricelists found'),
            ),
            'publicly_queryable'    =>  FALSE,
            'exclude_from_search'   =>  TRUE,
            'supports'              =>  array('title'),
            'show_in_menu'          =>  FALSE
        ));

        register_post_type('ngg_pricelist_item', array(
            'label'                 =>  'Pricelist Item',
            'publicly_queryable'    =>  FALSE,
            'exclude_from_search'   =>  TRUE
        ));

        register_post_type('ngg_order', array(
            'label'                 => 'Order',
            'publicly_queryable'    =>  FALSE,
            'exclude_from_search'   =>  TRUE
        ));
    }

    function get_checkout_page_url()
    {
        $retval = site_url('/?ngg_pro_checkout_page=1');
        $settings = C_NextGen_Settings::get_instance();
        if ($settings->ecommerce_page_checkout) {
            $retval = get_page_link($settings->ecommerce_page_checkout);
        }
        return $retval;
    }

    function get_digital_downloads_url($order_hash)
    {
        $retval = site_url('?ngg_pro_digital_downloads_page=1');
        $settings = C_NextGen_Settings::get_instance();
        if ($settings->ecommerce_page_digital_downloads) {
            $retval = get_page_link($settings->ecommerce_page_digital_downloads);
        }

        $retval = add_query_arg('order', $order_hash, $retval);

        return $retval;
    }

    function redirect_to_manage_pricelist_page()
    {
        if (strpos($_SERVER['SCRIPT_NAME'], '/wp-admin/post-new.php') !== FALSE && isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'ngg_pricelist') {
            wp_redirect(admin_url('/admin.php?page=manage_ngg_pricelist'));
        }
    }

    function edit_pricelist_link($url)
    {
        global $post;

        if ($post->post_type == 'ngg_pricelist') {
            $url = admin_url('/admin.php?page=manage_ngg_pricelist&id='.$post->ID);
        }

        return $url;
    }

    /**
     * Adds a pricelist field for galleries
     * @param $fields
     * @param $gallery
     * @return mixed
     */
    function add_gallery_pricelist_field($fields, $gallery)
    {
        $fields['right']['pricelist'] = array(
            'label'         =>  'Pricelist',
            'id'            =>  'gallery_pricelist',
            'callback'      =>  array(&$this, 'render_gallery_pricelist_field')
        );
        return $fields;
    }

    /**
     * Adds another column on the Manage Galleries (edit mode) page
     * @param $columns
     * @return mixed
     */
    function add_ecommerce_column($columns)
    {
        $columns += 1;

        add_filter(
            "ngg_manage_images_column_{$columns}_header",
            array(&$this, 'render_ecommerce_column_header'),
            20,
            2
        );

        add_filter(
            "ngg_manage_images_column_{$columns}_content",
            array(&$this, 'render_ecommerce_column'),
            20,
            2
        );

        return $columns;
    }

    function render_ecommerce_column_header()
    {
        return __('E-commerce', 'nggallery');
    }

    function render_ecommerce_column($output, $picture)
    {
        $image_id               = $picture->{$picture->id_field};
        $mapper                 = C_Pricelist_Mapper::get_instance();
        $gallery_default_label  = esc_html__("Use gallery's pricelist", 'nggallery');
        $selected_pricelist_id  = isset($picture->pricelist_id) ? $picture->pricelist_id : 0;
        $selected               = selected($selected_pricelist_id, 0, FALSE);
        $none_selected          = selected($selected_pricelist_id, -1, FALSE);
        $no_pricelist_label    = esc_html__("None (not for sale)", 'nggallery');

        $out = array();
        $out[] = "<select id='image_{$image_id}_pricelist' name='images[{$image_id}][pricelist_id]'>";
        $out[] = "<option {$selected} value='0'>{$gallery_default_label}</option>";
        $out[] = "<option {$none_selected} value='-1'>{$no_pricelist_label}</option>";

        foreach ($mapper->find_all() as $pricelist) {
            $pricelist_id       = esc_attr($pricelist->{$pricelist->id_field});
            $pricelist_title    = esc_html($pricelist->title);
            $selected           = selected($selected_pricelist_id, $pricelist_id, FALSE);
            $out[] = "<option {$selected} value='{$pricelist_id}'>{$pricelist_title}</option>";
        }

        $out[] = "</select>";

        return $output.implode("\n", $out);
    }

    /**
     * Renders the gallery pricelist field
     */
    function render_gallery_pricelist_field($gallery)
    {
        $mapper = C_Pricelist_Mapper::get_instance();
        $selected_pricelist_id = 0;
        if (($selected_pricelist = $mapper->find_for_gallery($gallery))) {
            $selected_pricelist_id = $selected_pricelist->{$selected_pricelist->id_field};
        }

        echo "<select name='pricelist_id' id='gallery_pricelist'>";
        $selected = selected($selected_pricelist_id, 0, FALSE);
        echo "<option value='0' {$selected}>None</option>";

        foreach ($mapper->find_all() as $pricelist) {
            $pricelist_id       = $pricelist->{$pricelist->id_field};
            $pricelist_title    = esc_html($pricelist->title);
            $selected           = selected($selected_pricelist_id, $pricelist_id, FALSE);
            echo "<option {$selected} value='{$pricelist_id}'>{$pricelist_title}</option>";
        }

        echo "</select>";
    }

    function render_manage_pricelist_page()
    {
        $page       = C_Pricelist_Source_Page::get_instance();
        $page->index_action();
    }

    function get_type_list()
    {
        return array(
            'C_NextGen_Pro_Add_To_Cart'         =>  'class.nextgen_pro_add_to_cart.php',
            'C_Digital_Downloads'               =>  'class.digital_downloads.php',
            'A_Ecommerce_Gallery'               =>  'adapter.ecommerce_gallery.php',
            'A_Ecommerce_Image'                 =>  'adapter.ecommerce_image.php',
            'C_Pricelist_Mapper'                =>  'class.pricelist_mapper.php',
            'C_Pricelist_Item_Mapper'           =>  'class.pricelist_item_mapper.php',
            'C_Pricelist'                       =>  'class.pricelist.php',
            'C_Pricelist_Item'                  =>  'class.pricelist_item.php',
            'I_Pricelist_Item'                  =>  'interface.pricelist_item.php',
            'I_Pricelist'                       =>  'interface.pricelist.php',
            'I_Pricelist_Mapper'                =>  'interface.pricelist_mapper.php',
            'I_Pricelist_Item_Mapper'           =>  'interface.pricelist_item_mapper.php',
            'C_Pricelist_Source_Page'           =>  'class.pricelist_source_page.php',
            'I_Order_Mapper'                    =>  'interface.order_mapper.php',
            'I_Order'                           =>  'interface.order.php',
            'C_Order_Mapper'                    =>  'class.order_mapper.php',
            'C_NextGen_Pro_Order'               =>  'class.nextgen_pro_order.php',
            'C_NextGen_Pro_Checkout'            =>  'class.nextgen_pro_checkout.php',
            'I_NextGen_Pro_Checkout'            =>  'interface.nextgen_pro_checkout.php',
            'A_Manual_Pricelist_Form'           =>  'adapter.manual_pricelist_form.php',
            'A_Digital_Downloads_Form'          =>  'adapter.digital_downloads_form.php',
            'A_Payment_Gateway_Form'            =>  'adapter.payment_gateway_form.php',
            'A_Ecommerce_Options_Controller'    =>  'adapter.ecommerce_options_controller.php',
            'A_NextGen_Pro_Lightbox_Mail_Form'  =>  'adapter.nextgen_pro_lightbox_mail_form.php',
            'A_Ecommerce_Ajax'                  =>  'adapter.ecommerce_ajax.php',
            'C_NextGen_Pro_Ecommerce_Trigger'   =>  'class.nextgen_pro_ecommerce_trigger.php',
            'A_NextGen_Pro_Lightbox_Pages'  =>  'adapter.nextgen_pro_lightbox_pages.php',
            'A_NextGen_Pro_Lightbox_Factory'=>  'adapter.nextgen_pro_lightbox_factory.php',
            'A_Nextgen_Pro_Lightbox_Effect_Code' => 'adapter.nextgen_pro_lightbox_effect_code.php',
            'A_Nextgen_Pro_Lightbox_Form' => 'adapter.nextgen_pro_lightbox_form.php',
            'C_NextGen_Pro_Lightbox_Installer' => 'class.nextgen_pro_lightbox_installer.php',
            'A_Nextgen_Pro_Lightbox_Triggers_Form' => 'adapter.nextgen_pro_lightbox_triggers_form.php',
            'C_NextGen_Pro_Lightbox_Trigger'        =>  'class.nextgen_pro_lightbox_trigger.php',
            'A_Nextgen_Pro_Lightbox_Routes' => 'adapter.nextgen_pro_lightbox_routes.php',
            'C_Nextgen_Pro_Lightbox_Controller' => 'class.nextgen_pro_lightbox_controller.php',
            'C_Opengraph_Controller' => 'class.opengraph_controller.php',
            'I_Nextgen_Pro_Lightbox_Controller' => 'interface.nextgen_pro_lightbox_controller.php',
            'I_Opengraph_Controller' => 'interface.opengraph_controller.php',
          'A_Image_Protection_Storage_Driver'   => 'adapter.image_protection_storage_driver.php',
          'A_Image_Protection_Routes'           => 'adapter.image_protection_routes.php',
          'C_Image_Protection_Controller'       => 'class.image_protection_controller.php',
          'C_Image_Protection_Manager'          => 'class.image_protection_manager.php',
          'I_Image_Protection_Controller'       => 'interface.image_protection_controller.php',
          'I_Image_Protection_Manager'          => 'interface.image_protection_manager.php',
          'C_Nextgen_Mail_Manager'          => 'class.nextgen_mail_manager.php',
          'I_Nextgen_Mail_Manager'          => 'interface.nextgen_mail_manager.php',
            'M_Nextgen_Pro_Lightbox' => 'module.nextgen_pro_lightbox.php',
            'A_Ecommerce_Options_Form'      =>  'adapter.ecommerce_options_form.php',
            'A_Display_Type_Ecommerce_Form' =>  'adapter.display_type_ecommerce_form.php',
            'C_NextGen_Pro_Currencies' => 'class.nextgen_pro_currencies.php',
            'C_NextGen_Pro_Order_Controller'        =>  'class.nextgen_pro_order_controller.php',
            'C_Pricelist_Source_Manager'            =>  'class.pricelist_source_manager.php',
            'C_NextGen_Pro_Cart'                    =>  'class.nextgen_pro_cart.php',
            'A_Ecommerce_Instructions_Form'         =>  'adapter.ecommerce_instructions_form.php',
            'C_NextGen_Pro_Order_Verification'      =>  'class.nextgen_pro_order_verification.php',
            'A_Reset_Ecommerce_Settings_Form'       =>  'adapter.reset_ecommerce_settings_form.php',
        );
    }
}

new M_NextGen_Pro_Lightbox;
