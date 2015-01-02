if ( typeof Object.create !== 'function' ) {
    
    Object.create = function ( obj ) {
        
        function F() {};
        F.prototype = obj;
        return new F();
    }
    
}

(function( $, window, document, undefind ){
    
    var BWLFaqFilter = {
        
        init: function( options, elem ) {
            
           var self = this;
                self.elem = elem;
                self.$elem = $( elem );
                
            /*------------------------------ DEFAULT OPTIONS ---------------------------------*/
 
            this.options = $.extend ( {}, $.fn.bwlFaqFilter.options, options); // Override old sutff 
            
                self.filter_search_container= $("#bwl_filter_" + this.options.unique_id),    
                self.faq_search_result_container= $("#bwl-filter-message-" + this.options.unique_id),    
                self.faq_container= $(".bwl-faq-container-" + this.options.unique_id);
                self.section_container= $("section#" + this.options.unique_id);
            
            /*------------------------------ BIND ALL CLICK EVENTS  ---------------------------------*/
            self.$elem.val(""); // Initlally make it's value null
            
            this.bindEvent();
             
        },
                
        bindEvent: function() {
    
            var self = this; 
            
            self.$elem.keyup(function(){
                self.faq_search();
            });
            

        },

       faq_search : function() {
   
                var self = this;
  
                var filter = jQuery.trim( self.$elem.val() ),
                    count = 0;
                
                
                
                self.section_container.find("section").each(function() {
                    
                    var each_section_counter = 0;
                    
                    // second iteration
                    jQuery(this).find("div.bwl-faq-container").each(function(){
                        
                        var search_string = jQuery(this).find("label").text() + jQuery(this).find("article").text();
                        
                         if (search_string.search(new RegExp(filter, "i")) < 0) {
                        
                            //Not found!
                            jQuery(this).slideUp();

                        } else {

                            //Found!
                            jQuery(this).slideDown();
                            each_section_counter++;
                            count++;

                        }
                        
                    }); // End second iteration.
                    
                    if ( each_section_counter === 0 ) {
                      
                        // Hide Title.
                        jQuery(this).prev("h2").slideUp();
                        
                    } else {
                        
                        // Show title.
                        jQuery(this).prev("h2").slideDown();

                    }

                });
                     

                if (count === 0) {

                    self.faq_search_result_container.html( text_nothing_found ).css("margin-bottom", "10px");

                } else {
                    
                    if ( filter === "" ) {
                        
                        self.faq_search_result_container.html("").css("margin-bottom", "0px");
                        
                    } else {
                    
                        var count_string = (count > 1) ? count + " " + text_faqs : count  + " " +  text_faq;
                        self.faq_search_result_container.html( count_string ).css("margin-bottom", "10px");
                    
                    }

                }

        }
     
    };
    
    
// Initialization Of Plugin

    $.fn.bwlFaqFilter = function( options ) {
       
        return this.each(function(){
            
            var faq_filter=  Object.create( BWLFaqFilter );
            faq_filter.init( options, this );
            
        });
        
    };
    
    // Default Options Setion.
    
    $.fn.bwlFaqFilter.options = {
            unique_id: ""
    };
    
})( jQuery, window, document);

 