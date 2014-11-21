jQuery.noConflict();

jQuery(window).load(function(){
	var $featured_content = jQuery('#featured-light #main-featured-slider'),
		$featured_readmore_center = $featured_content.find('a.et_centered');

	if ( $featured_content.length ) {
		var et_slider_settings = { pauseHoverElement : '#featured-light' };

		if ( $featured_content.is('.et_slider_auto') ) {
			var et_slider_autospeed_class_value = /et_slider_autospeed_(\d+)/g
				et_slider_autospeed = et_slider_autospeed_class_value.exec( $featured_content.attr('class') );

			et_slider_settings.autoSliderSpeed = et_slider_autospeed[1];
			et_slider_settings.auto = true;
			if ( $featured_content.is('.et_slider_pause') ) et_slider_settings.pauseOnHover = true;
		}
		$featured_content.et_motion_slider( et_slider_settings );

		if ( $featured_readmore_center.length ){
			$featured_readmore_center.each( function( i ){
				jQuery('.js #featured .slide').css({ visibility: "hidden", display: "block" }); //to count width of buttons from hidden slides correctly

				var $thisLink = jQuery(this),
					divWidth = $thisLink.parent().width(),
					thisLinkWidth = $thisLink.outerWidth(), //use outerWidth to take the padding into account.
					thisOffset = Math.ceil( ( divWidth - thisLinkWidth ) / 2 );

				jQuery('.js #featured .slide').css({ visibility: "", display: "" }); //revert back after width being counted.

				$thisLink.css( { 'marginLeft' : thisOffset, 'visibility' : 'visible' } );
			} );
		}

		$featured_content.find('iframe').attr("wmode","opaque"); // iframe video z-index fix
	}
});

jQuery(document).ready(function(){
	jQuery('ul.nav').superfish({
		delay:       300,                            // one second delay on mouseout
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
		speed:
		'fast',                          // faster animation speed
		autoArrows:  true,                           // disable generation of arrow mark-up
		dropShadows: false                            // disable drop shadows
	});

	jQuery('ul.nav > li > a.sf-with-ul').parent('li').addClass('sf-ul');

	var $et_active_page = jQuery('ul.nav > li.current-menu-item');
	if ( $et_active_page.length ){
		$et_active_page.append('<span class="et_active_menu_item"></span>');
	}

	et_search_bar();

	function et_search_bar(){
		var $searchform = jQuery('#header div#search-form'),
			$searchinput = $searchform.find("input#searchinput"),
			searchvalue = $searchinput.val();

		$searchinput.focus(function(){
			if (jQuery(this).val() === searchvalue) jQuery(this).val("");
		}).blur(function(){
			if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
		});
	};

	var $footer_widget = jQuery("#footer-widgets .footer-widget");
	if ( $footer_widget.length ) {
		$footer_widget.each(function (index, domEle) {
			if ((index+1)%4 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
		});
	}

	var $comment_form = jQuery('form#commentform');
	$comment_form.find('input:text, textarea').each(function(index,domEle){
		var $et_current_input = jQuery(domEle),
			$et_comment_label = $et_current_input.siblings('label'),
			et_comment_label_value = $et_current_input.siblings('label').text();
		if ( $et_comment_label.length ) {
			$et_comment_label.hide();
			if ( $et_current_input.siblings('span.required') ) {
				et_comment_label_value += $et_current_input.siblings('span.required').text();
				$et_current_input.siblings('span.required').hide();
			}
			$et_current_input.val(et_comment_label_value);
		}
	}).live('focus',function(){
		var et_label_text = jQuery(this).siblings('label').text();
		if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
		if (jQuery(this).val() === et_label_text) jQuery(this).val("");
	}).live('blur',function(){
		var et_label_text = jQuery(this).siblings('label').text();
		if ( jQuery(this).siblings('span.required').length ) et_label_text += jQuery(this).siblings('span.required').text();
		if (jQuery(this).val() === "") jQuery(this).val( et_label_text );
	});

	// remove placeholder text before form submission
	$comment_form.submit(function(){
		$comment_form.find('input:text, textarea').each(function(index,domEle){
			var $et_current_input = jQuery(domEle),
				$et_comment_label = $et_current_input.siblings('label'),
				et_comment_label_value = $et_current_input.siblings('label').text();

			if ( $et_comment_label.length && $et_comment_label.is(':hidden') ) {
				if ( $et_comment_label.text() == $et_current_input.val() )
					$et_current_input.val( '' );
			}
		});
	});

	if ( jQuery('ul.et_disable_top_tier').length ) jQuery("ul.et_disable_top_tier > li > ul").prev("a").attr("href","#");


});