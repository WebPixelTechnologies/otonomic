<?php
    set_time_limit(0);
    ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
    ini_set('memory_limit', '512M');

	if(isset($_POST) && !empty($_FILES['file']['tmp_name']))
	{
        $tmp_filename = $_FILES['file']['tmp_name'];
        $filename = str_replace(' ','_',$_FILES['file']['name']);
        if($pos = strrpos($filename,'.')) {
            $filename = substr($filename, 0, $pos);
        }
        $filename .= '_fb_details.csv';

		$file_content = file_get_contents($tmp_filename);
		if(!empty($file_content))
		{
			require_once("src/facebook.php");
			
			$config = array(
			  'appId' => '389314351133865',
			  'secret' => '881023f4df1d34b24da4c79beea423d0',
			  'fileUpload' => false, // optional
			  'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
			);
			$facebook = new Facebook($config);
			
			$required_details = array();
			
			$urls = preg_split("/\\r\\n|\\r|\\n/", $file_content);
			foreach($urls as $url)
			{
				if(empty($url)) { continue; }

				$url_parts = parse_url($url);

                try {
				    $temp_details = $facebook->api($url_parts['path']);

                } catch(Exception $e) {
                    /*
                    echo "Received error for url ".$url."<br/>";
                    echo($e->getType())."<br/>";
                    echo($e->getMessage())."<br/>";
                    */
                }

                $id = isset($temp_details['id']) ? (string)$temp_details['id'] : null;
                if($id) {
                    $url = !empty($temp_details['link']) ? $temp_details['link'] : ("https://www.facebook.com/" . $temp_details['username']);
                }

				$required_details[] = array(
                    "Facebook ID" 	=> $id,
					"First Name"	=> isset($temp_details['first_name']) ? $temp_details['first_name'] : "",
					"Last Name"		=> isset($temp_details['last_name']) ? $temp_details['last_name'] : "",
					"Url of profile"=> $url
				);
			}
			array_to_csv($required_details, $filename);
			exit(0);
		}
		else{
			$msg = "File was empty.";
		}
	}
	else
	{
?>
<!doctype html>
<html>
	<head>
		<title>Getting FB details</title>
	</head>
	<body>
		<?php if(!empty($msg)){?><div><?=$msg?></div><?php }?>
		<form action="" enctype="multipart/form-data" method="post" target="_blank">
			Input the file contains url:
			<input type="file" name="file" accept="" />
			<input type="submit" value="Submit" />
		</form>
	</body>
</html>
<?php 
	}
	
	
	function array_to_csv($rows, $filename = 'fb_details'){
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename='.$filename);
		$fp = fopen('php://output', 'w');
		
		$header_printed = false;
		foreach($rows as $row){
			if(!$header_printed){
				$header = array_keys($row);
				fputcsv($fp, $header);
				$header_printed = true;
			}
			fputcsv($fp, $row);
		}
		fclose($fp);
	}