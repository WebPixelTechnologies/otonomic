<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>

<?php include('head.php');?>
<link rel="canonical" href="http://www.page2site.com/" />

<body>
<?php include('facebook_connect.php')?>

	<div id="headline-wrap" class="tb">
        <div id="headline-callout" style="width: 1000px;margin-top:20px;" class="center">
            <form id="preview-form" class="preview-form form-inline" action="<?php echo FULL_PATH?>sites/add/" method="get">
                <form class="form-inline" role="form">
                <div class="form-group">
                    <label class="sr-only" type="text" for="exampleInputEmail2">Seach for your page:</label>
                    <input id="form_name" name="u" class="field form_url form-control" type="input"
                           class="form-control" placeholder="Search for your page"
                            required autofocus style="width: 630px;">
                    <input type="hidden" name="newsite" value="1">
                    <input type="hidden" name="visitor_type" value="visitor">
                </div>
                <button type="submit" class="btn btn-default">View Your Site</button>
            </form>
        </div>
        <div id="search-wrapper" class="tb"></div>
    </div>

	<!-- Start Content -->
	<div id="home-wrap" style="padding-top:10px;padding-bottom:60px">
		<div class="center">
			<div class="fb-like" data-href="http://www.facebook.com/page2site" data-send="true" data-width="450" data-show-faces="true"></div>
		</div>
	</div>
	<!-- End Content -->
	
<script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>

<script>
$(document).ready(function($){
    
	$('#form_name').hover(function() { this.focus(); });
	
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
		  	var input = $(this);
		  	if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
		  	}
		}).blur(function() {
		  	var input = $(this);
		  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
		  	}
		}).blur();
		
		$('[placeholder]').parents('form').submit(function() {
	  		$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
		  			input.val('');
				}
	  		});
		});
	}

    $(".search-results-item a").live('click', function(e) {
        page_name = $('a.page_name', this).html();
    	_gaq.push(['_trackEvent', 'Create site', 'Public page', page_name]);
    
    });
	
	$('#preview-form .form-submit, #preview-form2 .form-submit').live('click',function(e){
		/*
		if(!(url = $('#form_name').val())) {
			e.preventDefault();
			$('#form_name').focus();
			return false;
		};
		*/

		$('body').css('cursor','progress');
		$(this).html('Loading...&nbsp;').css('cursor','progress').parent('form').submit();
	});


	var minlength = 2;
	var already_searched = false;
	
    $("#form_name").keyup(function () {
        
        var that = this,
        value = $(this).val();
        
        var url = 'https://graph.facebook.com/search';
        //?q={text_box_value, escaped}&type=page&fields=id,name,category,cover,likes
        if (value.length >= minlength ) {
			if(!already_searched) {
				_gaq.push(['_trackEvent', 'Search', 'Searched for page', value]);
			}
        	already_searched = true;
        	
            $.jsonp({
                url: 'https://graph.facebook.com/search',
                context: document.body,
                callbackParameter: "callback",
                data : {'q' : value, type : 'page', fields: 'id,name,category,cover,likes', limit: 9, access_token: '389314351133865|O4FgcprDMY0k6rxRUO-KOkWuVoU'},
                success : function (json, textStatus, xOptions) {
                    var items = [];
                    jQuery.each(json.data, function(key, val) {
            		items.push('<div class="media search-results-item">' + 
                                            '<a class="pull-left fanpage" href="<?php echo FULL_PATH?>sites/add/fbid:' + val.id + '" target="_blank" title="Click to view site">' +
                                                    '<img class="media-object" src="http://graph.facebook.com/' + val.id + '/picture?type=square">' +
                                            '</a>' +
                                            '<div class="media-body pull-left">' + 
                                                    '<p class="media-heading">' +
                                                            '<a class="page_name" href="<?php echo FULL_PATH?>sites/add/fbid:' + val.id + '" target="_blank" title="Click to view site">' + val.name + '</a>' + 
                                                    '</p>' +
                                                    '<p class="media-address">' +
                                                            val.category +   
                                                    '</p>' + 
                                                    '<p class="media-address" style="color:black;">' + val.likes + ' likes</p>' +
                                            '</div>' +
                                            '<div class="clearfix"></div>' +
                                    '</div>'
                        );
                            
                         
                    });
                    $('#search-wrapper').html($('<div/>', {'class': 'search_results',html: items.join('')}));                    
                }
            });
        }
    });
});
</script>

</body>
</html>