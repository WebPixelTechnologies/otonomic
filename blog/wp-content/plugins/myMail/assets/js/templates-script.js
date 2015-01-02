jQuery(document).ready(function($) {

	"use strict"
	
	var iframe = $('#mymail_iframe'),
		wpnonce = $('#_wpnonce').val(),
		base = iframe.data('base'),
		templateeditor = $('#templateeditor'),
		templatecontent = $('textarea.editor'),
		animateDOM = $.browser.webkit ? $('body') : $('html'),
		codemirror;
		
	$('.remove-file').on('click', function(){
		
		var $this = $(this);
		
		if(confirm($this.data('confirm'))){
		
			_ajax('remove_template', {
				file: $this.data('file'),
			}, function(response){
				if(response.success){
					$this.parent().fadeOut();
				}
				
			});
		}
			
		return false;
	});
		
	$('#mymail_templates')
	.on('click', 'a.edit', function(){
		var $this = $(this),
			$container = $this.closest('.available-template'),
			$templates = $('.available-template'),
			loader = $('.template-ajax-loading').css({ 'display':'inline' }),
			href = $this.attr('href'),
			slug = $this.data('slug');


		if($this.hasClass('disabled')) return false;
			
		if(!$this.is('.nav-tab')){
		
			$templates.removeClass('edit');
		
			$container.addClass('edit');
			
			var id = $container.data('id');
			var count = Math.floor( ($('#available-templates').outerWidth())/($container.width()+22) );
			var pos = Math.floor(id/count)*count+count-1;

			templateeditor.find('textarea').val('');
			templateeditor.find('h3').html($container.find('h3').html());
			templateeditor.slideDown();

			templateeditor.insertAfter($templates.eq(pos).length ? $templates.eq(pos) : $templates.last());
			_scroll($container.offset().top);
			
		}
		
		get_template_html(slug, href);
		return false;
	})
	.on('click', 'a.nav-tab', function(){
		return false;
	})
	.on('click', 'a.cancel', function(){
		templateeditor.slideUp();
		$('.available-template').removeClass('edit');
		return false;
	})
	.on('click', 'button.save, button.saveas', function(){
		var $this = $(this),
			loader = $('.template-ajax-loading'),
			content = codemirror.getValue(),
			message = $('span.message'),
			name;
		
		if($this.is('.saveas') && !(name = prompt(mymailL10n.enter_template_name+':', ''))) return false;	
	
			
		loader.css({ 'display':'inline' }),
		$this.prop('disabled', true);
		
		_ajax('set_template_html', {
			content: content,	
			name: name,	
			slug: $('#slug').val(),
			file: $('#file').val()
		}, function(response){
			loader.hide();
			$this.prop('disabled', false);
		
			if(response.success){
				message.fadeIn(10).html(response.msg).delay(2000).fadeOut();
				if(response.newfile){
					get_template_html($('#slug').val(), 'mymail/'+response.newfile);

				}
			}else{
				alert(response.msg);
			}
			
		}, function(jqXHR, textStatus, errorThrown){
			loader.hide();
			$this.prop('disabled', false);
			
			alert(textStatus+' '+jqXHR.status+': '+errorThrown+'\n\nCheck the JS console for more info!');
		});
		
		return false;
	});
	
	function get_template_html(slug, href){
		_ajax('get_template_html', {
			slug: slug,
			href: href
		}, function(response){
			$('.template-ajax-loading').hide();
			
			$('#file').val(response.file);
			$('#slug').val(response.slug);
			templatecontent.val(response.html);
			
			if(!codemirror){
				var mixedMode = {
					name: "htmlmixed",
					scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
					mode: null},
					{matches: /(text|application)\/(x-)?vb(a|script)/i,
						mode: "vbscript"}]
				};
				codemirror = CodeMirror.fromTextArea(templatecontent.get(0), {
					mode: mixedMode,
					tabMode: "indent",
					lineNumbers: true,
					autofocus: true
				});
			}else{
				codemirror.setValue(response.html);
			}
			var html = '';
			
			$.each(response.files, function(name,data){
				html += ' <a class="nav-tab '+(name == response.file ? 'nav-tab-active' : 'edit')+'" href="mymail/'+name+'" data-slug="'+slug+'">'+name+'</a>';
			});
			templateeditor.find('.nav-tab-wrapper').html(html);
		});
	}
		
	function _scroll(pos, callback) {
		animateDOM.animate({
			'scrollTop': pos  
		}, callback && function(){
			callback();
		});
	}
	
	function _ajax(action, data, callback, errorCallback){

		if($.isFunction(data)){
			if($.isFunction(callback)){
				errorCallback = callback;
			}
			callback = data;
			data = {};
		}
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: $.extend({action: 'mymail_'+action, _wpnonce:wpnonce}, data),
			success: function(data, textStatus, jqXHR){
					callback && callback.call(this, data, textStatus, jqXHR);
				},
			error: function(jqXHR, textStatus, errorThrown){
					if(textStatus == 'error' && !errorThrown) return;
					if(console) console.error($.trim(jqXHR.responseText));
					errorCallback && errorCallback.call(this, jqXHR, textStatus, errorThrown);
				},
			dataType: "JSON"
		});
	}
	
});
