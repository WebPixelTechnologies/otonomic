/************************************/
API to find flickr Images.
/************************************/

:: REQUEST ::

URL :
	http://yourdomain/flickrapi.php
	OR
	http://yourdomain/flickrapi.php?q=flower&licence=0&limit=25&size=M

Parameters :

?q=[search keyword(s)]		//mandatory parameter, pass multiple keywords comma separated

&licence		//optional parameter. Licence for the images, default 0 passed
		0 => All Rights Reserved [Default]
		1 => Attribution-NonCommercial-ShareAlike License
		2 => Attribution-NonCommercial License
		3 => Attribution-NonCommercial-NoDerivs License
		4 => Attribution License
		5 => Attribution-ShareAlike License
		6 => Attribution-NoDerivs License		
		7 => No known copyright restrictions
		8 => United States Government Work
		
&limit			//Optional Parameter. Default value 10

&size			//Optional Parameter. Default value "M" => Medium
		S		=>	square
        LS		=>	large square
        TH		=>	thumbnail
        SM		=>	small
        SM320	=>	small 320
        M		=>	medium [Default]
        O		=>	original

&meta			//Optional Parameter. Image meta data. Default 1. 0 will speed up response.
		1 => Meta data require [Default]
		0 => Meta data not required

		
:: RESPONSE ::		

response => success/error

data =>
	url		=> URL of the thumbnail image
	title	=> Image title
	link	=> image link depend on the provided size
	meta	=> All other meta data provided from flickr using flickr.photos.getInfo API.



**********************************************************************************
**                                                                              **
**                               Flicker_Class.php                              **
**                                                                              **
**********************************************************************************

Added a private member {$required_metadata}, which will skips the unnecessary meta data from the final meta data result