<?php

class A_NextGen_Pro_Lightbox_Triggers_Resources extends Mixin
{
    protected $run_once = FALSE;

    function initialize()
    {
        $settings = C_NextGen_Settings::get_instance();
        if ($settings->thumbEffect == NGG_PRO_LIGHTBOX)
        {
            $thumbEffectContext = isset($settings->thumbEffectContext) ? $settings->thumbEffectContext : '';
            if (!empty($thumbEffectContext))
                add_action('wp_enqueue_scripts', array($this, 'enqueue_trigger_buttons_resources'));

            $this->object->add_post_hook(
                'enqueue_frontend_resources',
                'Enqueues resources for pro-lightbox trigger buttons',
                get_class(),
                'enqueue_trigger_buttons_resources'
            );
        }
    }

    function enqueue_trigger_buttons_resources($displayed_gallery)
    {
        if (!$this->run_once)
        {
            if (!wp_style_is('fontawesome', 'registered'))
                $this->object->get_registry()
                    ->get_utility('I_Display_Type_Controller')
                    ->enqueue_displayed_gallery_trigger_buttons_resources();
            wp_enqueue_style('fontawesome');

            wp_register_style(
                'ngg-trigger-buttons',
                $this->object->get_static_url('photocrati-nextgen_pro_lightbox#trigger_buttons.css'),
                false
            );

            wp_enqueue_style('ngg-trigger-buttons');
        }
        $this->run_once = TRUE;
    }
}

