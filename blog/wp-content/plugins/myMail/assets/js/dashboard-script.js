jQuery(document).ready(function($) {
		
	"use strict"
	
	var current_camp = 0,
		campaigndata = [],
		campaigncount = 0;
		
	//init the whole thing
	function _init(){
		
		$('.piechart').easyPieChart({
			animate: 1000,
			rotate: 180,
			barColor: '#21759B',
			trackColor: '#dedede',
			lineWidth: 10,
			size: 80,
			lineCap: 'square',
			onStep: function(value) {
				this.$el.find('span').text(Math.round(value));
			},
			onStop: function(value) {
				this.$el.find('span').text(Math.round(value));
			}
		});
		
		$.each($('.camp'), function(){
			var _this = $(this),
				data = _this.data('data');
			
			campaigndata.push({
				ID:	_this.data('id'),
				name: _this.data('name'),
				active: _this.data('active'),
				total: parseInt(data.sent, 10),
				opens: parseInt(data.opens, 10),
				clicks: parseInt(data.totaluniqueclicks, 10),
				unsubscribes: parseInt(data.unsubscribes, 10),
				bounces: parseInt(data.hardbounces, 10),
				
			});
		});
		
		campaigncount = campaigndata.length;
		
		$('.prev_camp').on('click', function(){
			loadCamp(--current_camp);
		});
		$('.next_camp').on('click', function(){
			loadCamp(++current_camp);
		});
		
		
	}
	
	function loadCamp(number){
		if(number <	0){
			current_camp = 0;
			return false;	
		}else if(number >= campaigncount){
			current_camp = campaigncount-1;
			return false;	
		}
		var camp = campaigndata[number];
		
		$('#camp_name').html(camp.name).attr('href', 'post.php?post='+camp.ID+'&action=edit');
		(camp.active) ? $('#stats_cont').addClass('isactive') :  $('#stats_cont').removeClass('isactive');
		$('#stats_total').html(camp.total);
		
		$('#stats_open').data('easyPieChart').update(camp.opens/camp.total*100);
		$('#stats_clicks').data('easyPieChart').update(camp.clicks/camp.opens*100);
		$('#stats_unsubscribes').data('easyPieChart').update(camp.unsubscribes/camp.opens*100);
		$('#stats_bounces').data('easyPieChart').update(camp.bounces/(camp.total+camp.bounces)*100);
		
		$('.prev_camp, .next_camp').removeClass('disabled');
		if(number == campaigncount-1){
			$('.next_camp').addClass('disabled');
		}else if(!number){
			$('.prev_camp').addClass('disabled');
		}
	}
	
	_init();
	
});


