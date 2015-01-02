<?php

class A_Ecommerce_Instructions_Form extends Mixin
{
    function get_title()
    {
        return $this->get_page_heading();
    }

    function get_page_heading()
    {
        return __('Instructions', 'nggallery');
    }

    function _get_field_names()
    {
        return array('ecommerce_instructions');
    }

    function _render_ecommerce_instructions_field()
    {
        return $this->render_partial('photocrati-nextgen_pro_lightbox_legacy#instructions', array(
            'i18n'  =>  $this->get_i18n_strings()
        ), TRUE);
    }

    function get_i18n_strings()
    {
        $retval = new stdClass();

        $retval->step_1 = sprintf(
            __('Configure your %s.', 'nggallery', 'nggallery'),
            sprintf('<a href="#" class="open_tab" rel="ngg-ecommerce-options" id="ecommerce_step_1">%s</a>', __('ecommerce settings', 'nggallery'))
        );

        $retval->step_2 = sprintf(
            __("Create one or more %s.", 'nggallery'),
            sprintf('<a href="%s">%s</a>', admin_url('edit.php?post_type=ngg_pricelist'), __('pricelists', 'nggallery'))
        );

        $retval->step_3 = sprintf(
            __("Using the %s page, associate a pricelist with any gallery or image you would like to sell.", 'nggallery'),
            sprintf('<a href="%s">%s</a>', admin_url('admin.php?page=nggallery-manage-gallery'), __('Manage Galleries', 'nggallery'))
        );

        $retval->step_4 = __("When adding or editing a gallery via the NextGEN Insert Gallery Window, be sure to enable ecommerce.", 'nggallery');

        $retval->step_5 =
            __("Be sure to select ", 'nggallery').sprintf("<a href='%s'>%s</a>", admin_url('admin.php?page=ngg_other_options#lightbox_effects'),__('NextGEN Pro Lightbox', 'nggallery')).__(" as your desired lightbox effect", 'nggallery');

        return $retval;
    }
}