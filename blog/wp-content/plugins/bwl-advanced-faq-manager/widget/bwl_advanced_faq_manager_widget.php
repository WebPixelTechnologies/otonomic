<?php

/***********************************************************
* @Description: BWL Advanced FAQ Manager Widget
* @Created At: 20-03-2013
* @Last Edited AT: 21-05-2014
* @Created By: Mahbub
***********************************************************/

function bwl_advanced_faq_manager_widget_init() {
   
    register_widget('Bwl_Advanced_Faq_Manager_Widget');
     
}

add_action( 'widgets_init', 'bwl_advanced_faq_manager_widget_init' ); 


class Bwl_Advanced_Faq_Manager_Widget extends WP_Widget {

    public function __construct() {     
 
            parent::__construct(
                    'bwl_advanced_faq_manager_widget',
                    __('BWL Advanced FAQ Manager Widget' , 'bwl-adv-faq'),
                    array(
                            'classname'     =>  'Bwl_Advanced_Faq_Manager_Widget',
                            'description'    =>   __('Display FAQ Lists In Main sidebar or footer sidebar' , 'bwl-adv-faq')
                    )
            );
        
    }
    
    public function form($instance) {
 
        $defaults = array(
            'title'                                                            =>  __('FAQ' , 'bwl-adv-faq'),
            'bwl_advanced_faq_manager_shortcode'     =>  '[bwla_faq]'
        );
        
        $instance = wp_parse_args((array) $instance, $defaults);
        
        extract($instance);
        
        ?>
 
        
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('FAQ' , 'bwl-adv-faq'); ?></label>
            <input type="text" 
                       class="widefat" 
                       id="<?php echo $this->get_field_id('title') ?>" 
                       name="<?php echo $this->get_field_name('title') ?>"
                       value="<?php echo esc_attr($title) ?>"/>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('bwl_advanced_faq_manager_shortcode') ?>"><?php _e('FAQ Shortcode' , 'bwl-adv-faq'); ?></label>            
            <textarea id="<?php echo $this->get_field_id('bwl_advanced_faq_manager_shortcode') ?>" name="<?php echo $this->get_field_name('bwl_advanced_faq_manager_shortcode') ?>" cols="30" rows="3" class="widefat"><?php echo esc_attr($bwl_advanced_faq_manager_shortcode) ?></textarea>         
            
        </p>
        
        <p><b>Shortcode Hints:</b><br>
            1. Display Random FAQ: <br /><small>[bwla_faq orderby = 'rand' /]</small>
            <br>
            2. Display Top Voted FAQs: <br>
            
            <small>[bwla_faq meta_key = 'votes_count',  orderby = 'meta_value_num', order = 'DESC' /] </small>
        </p>
        
        <?php
        
    }
    
    public function update($new_instance, $old_instance) {
        
        $instance          = $old_instance;
        
        $instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
        
        $instance['bwl_advanced_faq_manager_shortcode']  =  strip_tags( stripslashes( $new_instance['bwl_advanced_faq_manager_shortcode'] ) );
        
        return $instance;
        
    }
    
    public function widget($args, $instance) {
        
        extract($args);
        
        $title = apply_filters('widget-title' , $instance['title']);
        
        $bwl_advanced_faq_manager_shortcode = $instance['bwl_advanced_faq_manager_shortcode'];       
        
        echo $before_widget;
        
        if($title) :
            
            echo $before_title . $title . $after_title;
        
        endif;         
        
        if( $bwl_advanced_faq_manager_shortcode ):
    
            echo do_shortcode( $bwl_advanced_faq_manager_shortcode );
       
        endif;
    
        echo $after_widget;
        
    }
 
    
}

 
?>