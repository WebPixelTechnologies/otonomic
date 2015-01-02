function bwl_items_sort(selector, action) {
    var bwlFaqItems = jQuery(selector);
//alert(action);
    bwlFaqItems.sortable({
        update: function(event, ui) {
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data: {
                    action: action,
                    order: bwlFaqItems.sortable('toArray').toString()
                },
                success: function(response) {
             
                    jQuery("#sort-status").slideDown().delay(3000).slideUp();
                    return;
                },
                error: function(xhr, textStatus, e) {
                    alert('There was an error saving the update.');
                    return;
                }
            });
        }
    });
}

/*
* Title: Add Color Picker
* Introduced: Ver - 1.4.4
* Create Date: 25-10-2013
* Last Update: 25-10-2013
* Credit: http://www.eyecon.ro/colorpicker
*/

jQuery(document).ready(function() {    
    
    /*------------------------------ Settings For Gradient First Color ---------------------------------*/
    
    var gradient_first_color = jQuery('input#gradient_first_color');    
    
    gradient_first_color.ColorPicker({
        onShow: function(colpkr) {
            jQuery(colpkr).slideDown()
            return false;
        },
        onHide: function(colpkr) {
            jQuery(colpkr).slideUp();
            return false;
        },
        onChange: function(hsb, hex, rgb) {
            gradient_first_color.val('#' + hex).css({
                'text-transform' : 'uppercase'
            });
        }
    });
    
    /*------------------------------ SETTINGS FOR GRADIENT SECOND COLOR ---------------------------------*/
    
    var gradient_second_color = jQuery('input#gradient_second_color');
    
    gradient_second_color.ColorPicker({
        onShow: function(colpkr) {
            jQuery(colpkr).slideDown()
            return false;
        },
        onHide: function(colpkr) {
            jQuery(colpkr).slideUp();
            return false;
        },
        onChange: function(hsb, hex, rgb) {
            gradient_second_color.val('#' + hex).css({
                'text-transform' : 'uppercase'
            });
        }
    });
    
    /*------------------------------ SETTINGS FOR LABEL TEXT COLOR ---------------------------------*/
    
    var label_text_color = jQuery('input#label_text_color');
    
    label_text_color.ColorPicker({
        onShow: function(colpkr) {
            jQuery(colpkr).slideDown()
            return false;
        },
        onHide: function(colpkr) {
            jQuery(colpkr).slideUp();
            return false;
        },
        onChange: function(hsb, hex, rgb) {
            label_text_color.val('#' + hex).css({
                'text-transform' : 'uppercase'
            });
        }
    }); 
    
    /*------------------------------ SETTINGS FOR LABEL TEXT HOVER COLOR ---------------------------------*/
    
    var label_hover_text_color = jQuery('input#label_hover_text_color');
    
    label_hover_text_color.ColorPicker({
        onShow: function(colpkr) {
            jQuery(colpkr).slideDown()
            return false;
        },
        onHide: function(colpkr) {
            jQuery(colpkr).slideUp();
            return false;
        },
        onChange: function(hsb, hex, rgb) {
            label_hover_text_color.val('#' + hex).css({
                'text-transform' : 'uppercase'
            });
        }
    }); 
    
    
    /*------------------------------ Settings For Acitve Background Color ---------------------------------*/
    
    var active_background_color = jQuery('input#active_background_color');
    
     active_background_color.ColorPicker({
        onShow: function(colpkr) {
            jQuery(colpkr).slideDown()
            return false;
        },
        onHide: function(colpkr) {
            jQuery(colpkr).slideUp();
            return false;
        },
        onChange: function(hsb, hex, rgb) {
            active_background_color.val('#' + hex).css({
                'text-transform' : 'uppercase'
            });
        }
    });
    
    
    
    
/***********************************************************************************************/
/* Bulk Edit Section :: Introduced Version : 1.5.0*/
/***********************************************************************************************/

    if( jQuery( '#bulk_edit' ).length == 1 ) {

    // we create a copy of the WP inline edit post function
       var wp_inline_edit = inlineEditPost.edit;
       // and then we overwrite the function with our own code
       inlineEditPost.edit = function(id) {

           // "call" the original WP edit function
           // we don't want to leave WordPress hanging
           wp_inline_edit.apply(this, arguments);

           // now we take care of our business

           // get the post ID

           var post_id = 0;

           if (typeof(id) == 'object')

               post_id = parseInt(this.getId(id));

           if (post_id > 0) {

               // define the edit row
               var edit_row = jQuery('#edit-' + post_id);

               // get the breaking new status.

               var votes_reset_status = jQuery('#votes_reset_status-' + post_id).data('status_code');

               // populate the release date

               edit_row.find('select[name="votes_reset_status"]').val( ( votes_reset_status == "" ) ? "0" : votes_reset_status);

               // get the Display Location

               var bwl_advanced_faq_author = jQuery( '#bwl_advanced_faq_author-' + post_id ).data('status_code');

               // set the Display Location

               edit_row.find( 'select[name="bwl_advanced_faq_author"]' ).val( ( bwl_advanced_faq_author == "" ) ? "" : bwl_advanced_faq_author );

           }

       };

       /*------------------------------ Bulk Edit Settings ---------------------------------*/

       jQuery( '#bulk_edit' ).live( 'click', function() {

       // define the bulk edit row
       var bulk_row = jQuery( '#bulk-edit' );

       // get the selected post ids that are being edited
       var post_ids = new Array();
       bulk_row.find( '#bulk-titles' ).children().each( function() {
          post_ids.push( jQuery( this ).attr( 'id' ).replace( /^(ttle)/i, '' ) );
       });

       // get the $votes_reset_status

       var votes_reset_status = bulk_row.find( 'select[name="votes_reset_status"]' ).val();

       var bwl_advanced_faq_author = bulk_row.find( 'select[name="bwl_advanced_faq_author"]' ).val();

       // save the data
       jQuery.ajax({
          url: ajaxurl, // this is a variable that WordPress has already defined for us
          type: 'POST',
          async: false,
          cache: false,
          data: {
             action: 'baf_bulk_quick_save_bulk_edit', // this is the name of our WP AJAX function that we'll set up next
             post_ids: post_ids, // and these are the 2 parameters we're passing to our function
             votes_reset_status: votes_reset_status,
             bwl_advanced_faq_author: bwl_advanced_faq_author
          }
       });

    });
 
 
    }
    
    
    
    
    

})
