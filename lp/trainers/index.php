<?php

	$ab_rand = mt_rand(0,1);
	if ($ab_rand) {
		//echo $ab_rand;
		header('Location: /lp/trainers-text/');
	}
	else{
		//echo $ab_rand;
		header('Location: /lp/trainers-bullets/');
	}

?>