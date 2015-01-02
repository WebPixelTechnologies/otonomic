<?php

require('../../../../wp-load.php');
 
?>

<style type="text/css">
    hr.bafm-shortcode-seperator{
        border: 0px;
        border-top: 1px solid #D0D0D0;
        height: 1px;
    }
    
    .bafm_dn{
        display: none;
    }

    input[type="checkbox"].bafm_checkbox{
        
        margin-top: 5px;
        
    }
    
</style>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        
        var $bafm_parent_container = $("#bwl_advanced_faq_editor_popup_content");
             
        var custom_faq_type = $("[name=custom_faq_type]");
        
        var faq_category_container = $("#faq_category_container"),
              faq_topics_container = $("#faq_topics_container"),
              faq_item_container = $("#faq_item_container"),
              faq_tab_container = $("#faq_tab_container"),
              baf_sc_settings = $(".baf_sc_settings"),
              list_status = 0;

             custom_faq_type.change(function(){
                 
                 var custom_faq_type_value = $(this).val();
                 
                 if ( custom_faq_type_value == 2 ) {
 
                     faq_category_container.removeClass("bafm_dn");
                     faq_tab_container.removeClass("bafm_dn");
                     faq_topics_container.addClass("bafm_dn");
                     faq_item_container.addClass("bafm_dn");
                     baf_sc_settings.removeClass("bafm_dn");
                     list_status = 1;
                     
                 } else if ( custom_faq_type_value == 3 ) {

                     faq_category_container.addClass("bafm_dn");
                     faq_topics_container.removeClass("bafm_dn");
                     faq_tab_container.removeClass("bafm_dn");
                     faq_item_container.addClass("bafm_dn");
                     baf_sc_settings.removeClass("bafm_dn");
                     list_status = 1;
                     
                 } else if ( custom_faq_type_value == 4 ) {
                     
                     faq_category_container.addClass("bafm_dn");
                     faq_topics_container.addClass("bafm_dn");
                     faq_tab_container.addClass("bafm_dn");
                     faq_item_container.removeClass("bafm_dn");
                     baf_sc_settings.addClass("bafm_dn");
                     list_status = 0;
                     
                 } else {
                     
                     faq_category_container.addClass("bafm_dn");
                     faq_topics_container.addClass("bafm_dn");
                     faq_tab_container.addClass("bafm_dn");
                     faq_item_container.addClass("bafm_dn");
                     baf_sc_settings.removeClass("bafm_dn");
                     list_status = 0;
                     
                 }
                 
             })
        
        
        $('#addShortCodebtn').click(function(event) {

            // Columns
            
            // INITIALIZE ALL SHORTCODE TEXT
            
            var sc_faq_limit = "",
                  sc_faq_order = "",
                  sc_faq_sbox = "",
                  sc_faq_bwla_form = "",
                  sc_faq_orderby = "";

            shortcode = '[bwla_faq';

            // FAQ category
            if ( $bafm_parent_container.find('#faq_category').multipleSelect('getSelects').length !== 0) {
                
                shortcode += ' faq_category="' + $bafm_parent_container.find('#faq_category').multipleSelect('getSelects') + '" ';
                
            }
            
            // FAQ TOPICS
            if ( $bafm_parent_container.find('#faq_topics').multipleSelect('getSelects').length !== 0) {
                
                shortcode += ' faq_topics="' + $bafm_parent_container.find('#faq_topics').multipleSelect('getSelects') + '" ';
                
            }
            
            // NUMBER OF FAQs
            if ($('#no_of_faqs').val().split(" ").join("").length !== 0) {
                
                shortcode += ' limit="' + $('#no_of_faqs').val().split(" ").join("") + '" ';
                
                sc_faq_limit = ' limit="' + $('#no_of_faqs').val().split(" ").join("") + '" ';
                
            }
            
            // ORDER BY
            if ( $bafm_parent_container.find('#orderby').val().length !== 0) {
                
                shortcode += ' orderby="' + $('#orderby').val() + '" ';
                
                sc_faq_orderby =  ' orderby="' + $('#orderby').val() + '" ';
                
            }
            
            // ORDER TYPE
            if ( $bafm_parent_container.find('#order').val().length !== 0) {
                
                shortcode += ' order="' + $('#order').val() + '" ';
                
                sc_faq_order =  ' order="' + $('#order').val() + '" ';
                
            }
            
            // Show Search Form
            if( $bafm_parent_container.find('#sbox').is(':checked') ) {
                
                shortcode += ' sbox="1" ';                
                sc_faq_sbox = ' sbox="1" ';
                        
            } else {
                
                shortcode += ' sbox="0" ';                
                sc_faq_sbox = ' sbox="0" ';
            }
            
            // Show Tab

            var bwl_tabify_status = 0;
            
            if( $bafm_parent_container.find('#bwl_tabify').is(':checked') ) {
                
                bwl_tabify_status = 1;
                
            } else {
                
                shortcode += ' list="' + list_status + '" ';        
                 
            }
 
            // Ending of Shortcode
            shortcode += ' /]';
            
             // Show FAQ Form
             
            if( $bafm_parent_container.find('#bwla_form').is(':checked') ) {
                
                shortcode += '[bwla_form="1" /]';
                sc_faq_bwla_form =  '[bwla_form="1" /]';
                
            }
            
            // Custom Tabify Shortcode Generator.
            
            var current_faq_type = $("input[name=custom_faq_type]:checked").val();
            
             if ( current_faq_type == 4 ) {
                     
                var faq_items = $bafm_parent_container.find('#faq_items').val();
                     
                shortcode = '[bwla_faq single="1" fpid="' + faq_items + '"/]';                          
                   
            }
            
            if (bwl_tabify_status === 1 ) {
                
                var selected_faq_category = $bafm_parent_container.find('#faq_category').multipleSelect("getSelects","text"),
                     selected_faq_category_slug = $bafm_parent_container.find('#faq_category').multipleSelect("getSelects"),
                     selected_faq_topics = $bafm_parent_container.find('#faq_topics').multipleSelect("getSelects","text"),
                     selected_faq_topics_slug = $bafm_parent_container.find('#faq_topics').multipleSelect("getSelects");
 
                 if ( selected_faq_category.length > 0 && current_faq_type == 2 ) {
                     
                     shortcode = '[bwl_faq_tabs]';
          
                     for( i= 0 ; i< selected_faq_category.length; i ++ ) {
               
                            shortcode +='[bwl_faq_tab title="'+jQuery.trim(selected_faq_category[i])+'"]'+
                                                  ' [bwla_faq faq_category="' + selected_faq_category_slug[i] + '" ' + sc_faq_orderby +' ' + sc_faq_order +' '+sc_faq_limit+' '+sc_faq_sbox+'] '+ 
                                                  sc_faq_bwla_form +
                                                '[/bwl_faq_tab] '; 
                            
                     }
                        
                     shortcode +='[/bwl_faq_tabs]';
                     
                 }
                 
                  if ( selected_faq_topics.length > 0 && current_faq_type == 3 ) {
                     
                     shortcode = '[bwl_faq_tabs]';
          
                      for( i= 0 ; i< selected_faq_topics.length; i ++ ) {
                          
                           shortcode +='[bwl_faq_tab title="' + selected_faq_topics[i] + '"]'+
                                                  ' [bwla_faq faq_topics="' + selected_faq_topics_slug[i] + '" ' + sc_faq_orderby +' ' + sc_faq_order +' '+sc_faq_limit+' '+sc_faq_sbox+'] '+ 
                                                  sc_faq_bwla_form +
                                                '[/bwl_faq_tab] ';                             
                        }
                        
                       shortcode +='[/bwl_faq_tabs]';
                 }
                 
                

                window.send_to_editor(shortcode);
                
            } else {
                
                window.send_to_editor(shortcode);
                
            }

            $('#bwl_advanced_faq_editor_overlay').remove();
            
            return false;
            
        });

        $('#closeShortCodebtn').click(function(event) {
            $('#bwl_advanced_faq_editor_overlay').remove();
            return false;
        });
        
        /*------------------------------ Category ---------------------------------*/
        
        $('select#faq_category').add("multiple","multiple");
        
        $('select#faq_category').multipleSelect({
            placeholder: "- Select -",
            selectAll: true,
            filter: true
           
        });
        
        $('select#faq_category').multipleSelect("uncheckAll");
        
        /*------------------------------ Topics ---------------------------------*/
        
        $('select#faq_topics').add("multiple","multiple");
        
         $('select#faq_topics').multipleSelect({
            placeholder: "- Select -",
            selectAll: true,
            filter: true
           
        });
        
        $('select#faq_topics').multipleSelect("uncheckAll");
 
    });
    
</script>

<h3><?php _e('BWL Advanced FAQ Manager Shortcode Editor', 'bwl-adv-faq'); ?></h3>

<div id="bwl_advanced_faq_editor_popup_content">
<?php 

        $faq_items_args = array(
            
                'post_type'     => 'bwl_advanced_faq',
                'order'            => 'ASC',
                'orderby' => 'ID', 
                'order' => 'ASC'
        );
            
        $faq_items = get_posts( $faq_items_args );
        
        $faq_category_args = array(
            
                'taxonomy' => 'advanced_faq_category',
                'hide_empty' => 0,
                'orderby' => 'ID', 
                'order' => 'ASC'
        );
            
        $faq_categories = get_categories( $faq_category_args );
        
        $faq_topics_args = array(
            
                'taxonomy' => 'advanced_faq_topics',
                'hide_empty' => 0,
                'orderby' => 'ID', 
                'order' => 'ASC'
        );
            
        $faq_topics = get_categories( $faq_topics_args );
 
        
        ?>
    
    
    <div class="row">
        
        <label for="custom_faq_type"><?php _e('FAQ Type', 'bwl-adv-faq'); ?></label>
        
        <input type="radio" name="custom_faq_type" class="custom_faq_type" value="1" checked="checked"/>All&nbsp;
        <input type="radio" name="custom_faq_type" class="custom_faq_type" value="2"/>Category&nbsp;
        <input type="radio" name="custom_faq_type" class="custom_faq_type" value="3"/>Topics
        <input type="radio" name="custom_faq_type" class="custom_faq_type" value="4"/>Single FAQ
        
    </div>
    
    <hr class="bafm-shortcode-seperator"/>
    
 
    <div class="row bafm_dn" id="faq_item_container">
        
        <label for="faq_items"><?php _e('FAQs', 'bwl-adv-faq'); ?></label>
        
        <select id="faq_items" name="faq_items">
        
        <?php
        
            foreach($faq_items as $faqs):
        
        ?>        
            <option value="<?php echo $faqs->ID ?>"><?php echo $faqs->post_title; ?></option>
        
        <?php 
        
                endforeach;
        
            wp_reset_query();
        
        ?>            
            
        </select>
        
    </div>
    
    
    <div class="row bafm_dn" id="faq_category_container">
        
        <label for="faq_category"><?php _e('FAQ Category', 'bwl-adv-faq'); ?></label>
        
        <select id="faq_category" name="faq_category">
        
        <?php
        
            foreach($faq_categories as $category):
        
        ?>        
            <option value="<?php echo $category->slug ?>"><?php echo $category->name; ?></option>
        
        <?php 
        
                endforeach;
        
            wp_reset_query();
        
        ?>            
            
        </select>
        
    </div>
    
    <div class="row bafm_dn" id="faq_topics_container">
        
        <label for="faq_topics"><?php _e('FAQ Topics', 'bwl-adv-faq'); ?></label>
        
        <select id="faq_topics" name="faq_topics">
        
        <?php
        
            foreach($faq_topics as $topics):
        
        ?>        
            
            <option value="<?php echo $topics->slug ?>"><?php echo $topics->name; ?></option>
        
        <?php 
        
                endforeach;
        
            wp_reset_query();
        
        ?>            
            
        </select>
        
    </div>
    
    <div class="row bafm_dn" id="faq_tab_container">
        
        <label for="bwl_tabify"><?php _e('Show In Tab', 'bwl-adv-faq')?></label>
        <input type="checkbox" id="bwl_tabify" name="bwl_tabify" value="1" class="bafm_checkbox"/>
        
    </div> <!-- end row  -->

    <div class="row baf_sc_settings">
        <label for="no_of_faqs"><?php _e('Number of FAQs','bwl-adv-faq'); ?></label>
        <input type="text" id="no_of_faqs" name="no_of_faqs" value="" />
    </div>
     
    <div class="row baf_sc_settings">
        <label for="orderby"><?php _e('Order By', 'bwl-adv-faq'); ?></label>
        <select id="orderby" name="orderby">
            <option value="" selected>- <?php _e('Select', 'bwl-adv-faq'); ?> -</option>
            <option value="id"><?php _e('ID', 'bwl-adv-faq'); ?></option>
            <option value="title"><?php _e('Title', 'bwl-adv-faq'); ?></option>
            <option value="menu_order"><?php _e('Custom Sorting', 'bwl-adv-faq'); ?></option>
            <option value="date"><?php _e('Date', 'bwl-adv-faq'); ?></option>            
            <option value="rand"><?php _e('Random Order', 'bwl-adv-faq'); ?></option>
        </select>
    </div>

    <div class="row baf_sc_settings">
        <label for="order"><?php _e('Order Type', 'bwl-adv-faq'); ?></label>
        <select id="order" name="order">
            <option value="" selected>- <?php _e('Select', 'bwl-adv-faq'); ?> -</option>
            <option value="ASC"><?php _e('Ascending', 'bwl-adv-faq'); ?></option>
            <option value="DESC"><?php _e('Descending', 'bwl-adv-faq'); ?></option>            
        </select>
    </div>
    
    <div class="row baf_sc_settings">
        
        <label for="sbox"><?php _e('Show Search Box', 'bwl-adv-faq')?></label>
        <input type="checkbox" id="sbox" name="sbox" value="1" class="bafm_checkbox" checked="checked"/>
        
    </div> <!-- end row  -->
    
     <div class="row baf_sc_settings">
        
        <label for="bwla_form"><?php _e('Add External FAQ Form', 'bwl-adv-faq')?></label>
        <input type="checkbox" id="bwla_form" name="bwla_form" value="1" class="bafm_checkbox"/>
        
    </div> <!-- end row  -->
     

    <div id="bwl_advanced_faq_editor_popup_buttons">
        <input id="addShortCodebtn" name="addShortCodebtn" class="button-primary" type="button" value="Insert" />
        <input id="closeShortCodebtn" name="closeShortCodebtn" class="button" type="button" value="Close" />
    </div>

</div>