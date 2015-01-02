jQuery(document).ready(function($) {

	"use strict"
	
	var container,modules;
		
	function _refresh(){
		container = $('modules');
		modules = container.find('module');
		
		_sortable();

	}
	
	function _sortable(){
		
		if(container.data('sortable')) container.sortable('destroy');
		if(modules.length < 2) return;
				
		container.sortable({
			stop: function (event, ui) {
				container.removeClass('dragging');
				setTimeout(function(){_refreshMain();},200);
			},
			start: function (event, ui) {
				_hideButtons();
				container.addClass('dragging');
			},
			containment: 'body',
			revert: 100,
			placeholder: "sortable-placeholder",
			items: "> module",
			delay: 20,
			distance: 5,
			scroll:true,
			scrollSensitivity: 10,
			forcePlaceholderSize: true,
			helper: 'clone',
			zIndex: 10000
			
		});
		
	}
	
	window.mymail_refresh = function(){
		_refresh();
	}
	
	function _hideButtons(){
		parent.window.mymail_hideButtons();
	}
	function _refreshMain(){
		parent.window.mymail_refresh()
	}
	
});
