// -- Cycle Slider Settings --

$(document).ready(function(){
	$('#slider').cycle({
		fx: 'scrollHorz',
		speed:  1300, 
		timeout: 4000,
		easing:'easeInOutBack',		
		sync:1,
		pause:1,		
		pager:'#pager', 	
		// callback fn that creates a thumbnail to use as pager anchor 
		pagerAnchorBuilder: function(idx, slide) { 
			return '<li><a href="#"></a></li>'; 
		}
	});
})