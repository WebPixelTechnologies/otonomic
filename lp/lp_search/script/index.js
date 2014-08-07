(function($) {
$(document).ready(function() {
	//page.set();
	$('.carousel').slider();
});
var page = {
	set:function() {
	var ww = $(window).width(); var ml = (ww - 1180) / 2 + 70 + 'px';
		$('.panel1').css('margin-left',ml); $('.panel2').css('margin-left',ml); $('.panel3').css('margin-left',ml);
		$('.panel5').css('margin-left',ml); $('.panel6').css('margin-left',ml); $('.panel7').css('margin-left',ml);
	}
};
$.fn.slider = function( method ) {
	if ( slider[method] ) return slider[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	else if ( typeof method === 'object' || ! method ) return slider.init.apply( this, arguments );
    else $.error( 'Method ' +  method + ' is not found on jQuery.schedule.' );  
};
var slider = {
	init:function(options) {
		this.options = $.extend({},options); var box = this.find('.c-box');
		this.options.count = box.find('.c-block').length; this.options.current = 1; this.options.change = true;
		box.find('.c-block').each(function(index) { $(this).css('left',index * 310 + 'px'); });
		this.find('.l-arrow').click($.proxy(slider.prev,this)); this.options.leftArrow = this.find('.l-arrow img');
		this.find('.r-arrow').click($.proxy(slider.next,this)); this.options.rightArrow = this.find('.r-arrow img');
		return this;
	},
	prev:function() {
		if(this.options.count - this.options.current >= 3) {
			if(!this.options.change) return; this.options.change = false;
			var panel = this; var box = this.find('.c-box');
			for(var i = 1; i <= this.options.count; i++) {
				var item = box.find('.c-block:nth-child(' + i + ')'); var l = item.position().left;
				if( i < this.options.count) item.animate({left:l - 310},600);
				else item.animate({left:l - 310},600,'swing', function() { panel.options.change = true; });
			}
			this.options.current++; 
			this.options.rightArrow.attr('src','images/r-arrow-e.png');
			if(this.options.count - this.options.current < 3) this.options.leftArrow.attr('src','images/l-arrow-d.png');
		}
		return this;
	},
	next:function() {
		if(this.options.current > 1) {
			if(!this.options.change) return; this.options.change = false;
			var panel = this; var box = this.find('.c-box');
			for(var i = this.options.count; i >= 1; i--) {
				var item = box.find('.c-block:nth-child(' + i + ')'); var l = item.position().left;
				if( i > 1) item.animate({left:l + 310},600);
				else item.animate({left:l + 310},600,'swing', function() {panel.options.change = true;});
			}
			this.options.current--;
			this.options.leftArrow.attr('src','images/l-arrow-e.png');
			if(this.options.current <= 1) this.options.rightArrow.attr('src','images/r-arrow-d.png');
		}
		return this;
	}
};	
})(jQuery);