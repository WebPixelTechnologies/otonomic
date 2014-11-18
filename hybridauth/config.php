<?php
/**
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2014, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return 
	array(
		"base_url" => "http://otonomic.test/hybridauth/index.php", 

		"providers" => array ( 
			// openid providers
			"OpenID" => array (
				"enabled" => true
			),

			"Yahoo" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" ),
			),

			"AOL"  => array ( 
				"enabled" => true 
			),

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "1088210894326-hjjrmql58q54q2ht4avhl5i6duk5p1p5.apps.googleusercontent.com", "secret" => "Oxc3sEoGC2H-GEbtHITMtxf7" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "922540841107442", "secret" => "96f9a017d277fd2b7442f5f42f2d7cb3" ),
				"trustForwarded" => false,
                                "display" => 'popup'
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "9gtOE9PPyvhg4xUbl2BzL3UkK", "secret" => "2rIsVK9Z5cxEYOnlSTVuvTZP9iQExhjH84sp1Swsx8sQjVZELE" ) 
			),

			// windows live
			"Live" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),

			"LinkedIn" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "75sly2eejaunvj", "secret" => "PaoZ91PeY6aRURxr" ) 
			),

			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),
                        "Instagram" => array(
                            "enabled" => true,
                            "keys"    => array ( "id" => "", "secret" => "" )
                        )
		),

		// If you want to enable logging, set 'debug_mode' to true.
		// You can also set it to
		// - "error" To log only error messages. Useful in production
		// - "info" To log info and error messages (ignore debug messages) 
		"debug_mode" => false,

		// Path to file writable by the web server. Required if 'debug_mode' is not false
		"debug_file" => "",
	);
