<?php

class A_NextGen_Pro_Lightbox_Pages extends Mixin
{
	function initialize()
	{
		$this->object->add('ngg_manage_pricelists', array(
			'url'			=> '/edit.php?post_type=ngg_pricelist',
			'menu_title'	=>	__('Manage Pricelists', 'nggallery'),
			'permission'	=>	'NextGEN Change options',
			'parent'		=>	NGGFOLDER
		));

		$this->object->move_page('ngg_manage_pricelists', 'ngg_display_settings', TRUE);

		$this->object->add(NGG_PRO_ECOMMERCE_OPTIONS_PAGE, array(
			'adapter'		=> 'A_Ecommerce_Options_Controller',
			'parent'		=>	NGGFOLDER,
			'before'		=>	NGG_OTHER_OPTIONS_SLUG
		));
	}
}