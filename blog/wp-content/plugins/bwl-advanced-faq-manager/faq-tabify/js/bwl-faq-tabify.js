/*****************************************************
 *@Description: FAQ TABIFY
 *@Created By: Mahbub
 *@Created At: 17-03-2013
 *@Last Edited: 17-03-2013
 *****************************************************/

jQuery(document).ready(function($) {

    $('.bwl-faq-tabs li').click(function() {

        if ($(this).find(".bwl-faq-link").attr("class") != "bwl-faq-link") {
            switch_tabs($(this));
        }

    });

    function switch_tabs( obj ) {

        obj.parent().parent().find('.bwl-faq-tab-content').slideUp("fast");
        
        obj.parent().find('li').removeClass("active");

        var id = obj.find("a", 0).attr("rel");

        $('#' + id).slideDown("slow");

        obj.addClass("active");
    }
});
