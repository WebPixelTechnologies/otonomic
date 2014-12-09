(function($) {

	$.otonomicImageGallery = function(element, options) {

		var defaults = {
			multiple: false,
			title: 'Select Image',
			button_text: 'Select Image',
			pre_selected_images: false,
			on_select: function() {}
		};

		var plugin = this;

		plugin.settings = {};

		plugin._gallery = false;

		var $element = $(element),
			element = element;

		plugin.init = function() {
			plugin.settings = $.extend({}, defaults, options);
			plugin.settings.pre_selected_images = String(plugin.settings.pre_selected_images);
			plugin.bindClick();
		};

		plugin.bindClick = function() {
			$(element).bind('click', function (e){
				e.preventDefault();
				plugin.openGallery();
			});
		};

		plugin.openGallery = function() {
			if (!plugin._gallery) {
				plugin._gallery = wp.media.frames.file_frame = wp.media({
					title: plugin.settings.title,
					button: {
						text: plugin.settings.button_text
					},
					multiple: plugin.settings.multiple
				});
				plugin._gallery.on('select', function () {
					selection = plugin._gallery.state().get('selection');
					plugin.settings.on_select($element, selection);
				});
			}
			if(plugin.settings.pre_selected_images)
			{
				plugin._gallery.on('open',function() {
					plugin.preSelectImages();
				});
			}
			//Open the gallery dialog
			plugin._gallery.open();
		};

		plugin.preSelectImages = function() {
			var selection = plugin._gallery.state().get('selection');
			ids = plugin.settings.pre_selected_images.split(',');
			ids.forEach(function(id) {
				attachment = wp.media.attachment(id);
				//attachment.fetch();
				selection.add( attachment ? [ attachment ] : [] );
			});
		};

		plugin.init();
	};

	$.fn.otonomicImageGallery = function(options) {

		return this.each(function() {
			if (undefined == $(this).data('otonomicImageGallery')) {
				var data_options = $(this).data();
				var merged_options = $.extend(options, data_options);
				var plugin = new $.otonomicImageGallery(this, merged_options);
				$(this).data('otonomicImageGallery', plugin);
			}
		});
	}
})(jQuery);

jQuery(document).ready(function($){
	$('.otonomic-image-gallery').otonomicImageGallery({
		multiple:false,
		on_select: function ($element, $attachments){
			console.log($element);
			$attachments.forEach(function(attachment) {
				attachment = attachment.toJSON();
				console.log(attachment);
			});
		}
	});
});