jQuery(document).ready(function(){

	// start Superfish for header menu and customization options
		jQuery('ul.sf-menu').superfish({ 
			delay:       0,                            // Delay on mouseout 
			animation:   {opacity:'show',height:'show',filter:'none'},   // Fade-in and slide-down animation 
			speed:       'fast'                          // Animation speed 
		}); 
	
	
	// start tweet timeline feed in footer and customization options
		jQuery(".tweet").tweet({
			username: "page2site",  // Twitter account user.
			avatar_size: 32,  // Size of avatar. Change to, null, to hide avatar
			count: 1,  //  Number of tweets to display from timeline
			loading_text: "loading tweets..."  //  Text displayed while tweet is loading
		});

		
		
		// START: ADDED BY OMRI
		// Tipsy Tootip
		jQuery('.tip a ').tipsy({gravity: 's',live: true});	
		jQuery('.ntip a ').tipsy({gravity: 'n',live: true});	
		jQuery('.wtip a ').tipsy({gravity: 'w',live: true});	
		jQuery('.etip a,.Base').tipsy({gravity: 'e',live: true});	
		jQuery('.netip a ').tipsy({gravity: 'ne',live: true});	
		jQuery('.nwtip a  ').tipsy({gravity: 'nw',live: true});	
		jQuery('.swtip a,.iconmenu li a ').tipsy({gravity: 'sw',live: true});	
		jQuery('.setip a ').tipsy({gravity: 'se',live: true});	
		// END: Added by Omri
});