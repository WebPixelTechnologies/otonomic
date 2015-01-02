<?php

class A_NextGen_Pro_Lightbox_Effect_Code extends Mixin
{
    function initialize()
    {
        $this->object->add_post_hook(
            'get_effect_code',
            'Performs additional effect code variable substitutions',
            get_class(),
            'get_lightbox_effect_code'
        );
    }

    function get_lightbox_effect_code($displayed_gallery)
    {
        // Swap the gallery placeholder
        $retval = $this->object->get_method_property(
            $this->method_called,
            ExtensibleObject::METHOD_PROPERTY_RETURN_VALUE
        );
        $retval = str_replace('%PRO_LIGHTBOX_GALLERY_ID%', $displayed_gallery->id(), $retval);

        $lightbox = C_Lightbox_Library_Manager::get_instance()->get(NGG_PRO_LIGHTBOX);
        if ($lightbox && $lightbox->values['nplModalSettings']['enable_comments']
        &&  $lightbox->values['nplModalSettings']['display_comments'])
            $retval .= ' data-nplmodal-show-comments="1"';

        $this->object->set_method_property(
            $this->method_called,
            ExtensibleObject::METHOD_PROPERTY_RETURN_VALUE,
            $retval
        );

        return $retval;
    }
}