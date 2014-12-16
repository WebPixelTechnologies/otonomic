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
		"base_url" => "http://".$_SERVER['HTTP_HOST']."/hybridauth/index.php", 

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
				"keys"    => array ( "id" => "286934271328156", "secret" => "55bf8f49cd5030ba6d6fecb50b896a77" ),
				"trustForwarded" => false,
                                "display" => 'popup'
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array (
                    "key" => "lHOHPqmwUsT6EikZHWqlg0MGJ",
                    "secret" => "yglkHFRLkJ70xM0i0cSucFxNfqBxaJLpJhjqD5L62rxSgwZ4cu"
                )
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
                            "keys"    => array (
                                "id" => "ef4ef97d5bda4b51b575e22b2d179d1a",
                                "secret" => "3497f47d336a4704a5851eb11e688586"
                            )
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
