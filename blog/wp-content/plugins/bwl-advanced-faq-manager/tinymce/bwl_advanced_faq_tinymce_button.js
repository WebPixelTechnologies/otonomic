jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.bwl_advanced_faq', {
        init: function(ed, url) {
            ed.addButton('bwl_advanced_faq', {
                title: 'BWL Advanced FAQ Shortcode Editor',
                image: url + '/icons/bwl-adv-faq-editor.png',
                onclick: function() {
               
                    if ($('#shortcode_controle').length) {
                       
                        $('#shortcode_controle').remove();
                    }
                    else
                    {
                      
                        $('body').append('<div id="bwl_advanced_faq_editor_overlay"><div id="bwl_advanced_faq_editor_popup"></div></div>');

                        $('#bwl_advanced_faq_editor_popup').load(url + '/bwl_advanced_faq_shortcode_editor.php');

                        $('#bwl_advanced_faq_editor_popup').css('margin-top', $(window).height() / 2 - $('#bwl_advanced_faq_editor_popup').height() / 2);

                    }
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        }
    });
    
    tinymce.PluginManager.add('bwl_advanced_faq', tinymce.plugins.bwl_advanced_faq);

});