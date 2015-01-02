<?php

// Add to our admin_init function
add_action( 'bulk_edit_custom_box', 'bwl_add_quick_edit', 10, 2 );
add_action( 'quick_edit_custom_box',  'bwl_add_quick_edit', 10, 2 );
 
function bwl_add_quick_edit( $column_name, $post_type ) {
    
    switch ( $post_type ) {
        
                case 'bwl_advanced_faq': // 
                
                        switch( $column_name ) {

                                    case 'votes_count':
                                
                                ?>

                                        <fieldset class="inline-edit-col-right">
                                            <div class="inline-edit-col">
                                                <div class="inline-edit-group">
                                                    <label class="inline-edit-status alignleft">
                                                        <span class="title"><?php _e('Reset Vote Counter', 'bwl-adv-faq'); ?></span>
                                                        <select name="votes_reset_status" id="votes_reset_status">
                                                            <option value="">- Select -</option>
                                                            <option value="0"><?php _e('No', 'bwl-adv-faq' ); ?></option>
                                                            <option value="1"><?php _e('Yes', 'bwl-adv-faq' ); ?></option>
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                            
                                <?php
                                            
                                    break;
                                        
                                        case 'bwl_advanced_faq_author':
                                            
                                            $bwl_blog_users = get_users('orderby=display_name&order=ASC');
                                            
                                
                                ?>
                                        
                                    <fieldset class="inline-edit-col-right">
                                            <div class="inline-edit-col">
                                                <div class="inline-edit-group">
                                                    <label class="inline-edit-status alignleft">
                                                        <span class="title"><?php _e( 'FAQ Author ', 'bwl-adv-faq'); ?></span>
                                                        
                                                        <select name="bwl_advanced_faq_author" id="bwl_advanced_faq_author">
                                                            
                                                                <option value="">- Select -</option>
                                                                
                                                                <?php 
                                                                    
                                                                    foreach ($bwl_blog_users as $user_info) :                                                                        
                                                                
                                                                ?>
                                                                
                                                                    <option value="<?php echo $user_info->ID; ?>"><?php echo $user_info->display_name; ?></option>
                                                                
                                                                <?php 
                                                                    
                                                                    endforeach;
                                                                    
                                                                ?>
                                                                
                                                        </select>
                                                        
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                            
                                <?php
                                        
                                        break;
                                        
                                }
                        
                        break;
                        
            }
                                    
}


// Add to our admin_init function

add_action('save_post', 'bwl_save_quick_edit_data');
 
function bwl_save_quick_edit_data( $post_id ) {
    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
    // to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id; 
    
    // OK, we're authenticated: we need to find and save the data
    
    $post = get_post($post_id);
    
    if (isset($_POST['votes_reset_status']) && ($post->post_type != 'revision')) {
        
        $votes_count_status = esc_attr($_POST['votes_reset_status']);
        
        if ( $votes_count_status == 1 ) {
            
            delete_post_meta( $post_id, 'votes_count', 0);
            
        }
            
    } 
    
    return ''; 
    
}


/*------------------------------  Buik Edit ---------------------------------*/

add_action( 'wp_ajax_baf_bulk_quick_save_bulk_edit', 'baf_bulk_quick_save_bulk_edit' );

function baf_bulk_quick_save_bulk_edit() {

        // we need the post IDs
        $post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : NULL;
                
        // if we have post IDs
        if ( ! empty( $post_ids ) && is_array( $post_ids ) ) {
        
                // get the custom fields
            
                $custom_fields = array( 'votes_reset_status', 'bwl_advanced_faq_author' );
                
                foreach( $custom_fields as $field ) {
                        
                        // if it has a value, doesn't update if empty on bulk
                        if ( isset( $_POST[ $field ] ) && trim( $_POST[ $field ] ) != "" ) {
                        
                                // update for each post ID
                                foreach( $post_ids as $post_id ) {
                                        update_post_meta( $post_id, $field, $_POST[ $field ] );
                                }
                                
                        }
                        
                }
                
        }
        
}



?>