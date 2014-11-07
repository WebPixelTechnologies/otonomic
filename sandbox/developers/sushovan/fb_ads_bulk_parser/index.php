<?php
    set_time_limit(0);
    ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
    ini_set('memory_limit', '512M');

    // $default_facebook_page_id = '310783022385273'; // Jessica's pastries
    $default_facebook_page_id = '409731479080509'; // Page2site
    $page_id = isset($_GET['page_id']) ? $_GET['page_id'] : $default_facebook_page_id;

    define('PAGE_ID', $page_id);
    define('BASE_IMAGE_URL', 'http://www.page2site.com/files/ads/images/');

    include('functions.php');

    // Get user from Facebook
    require 'src/facebook.php';
    $config = array(
        /*
        'appId' => '182031755221644', // needs to be changed
        'secret' => '417d01e781136b15134e6a7fd976079c', // needs to be changed
        */
        'appId' => '160571960685147', // needs to be changed
        'secret' => '361d47548fa76f80bcee05533eec1589', // needs to be changed
        'allowSignedRequest' => false
    );
    $fb_permissions = 'publish_stream, manage_pages';
    $facebook = new Facebook($config);
    $user_id = $facebook->getUser();


    if($user_id) {
        // User is logged in to Facebook
        try {
            if(isset($_POST) && !empty($_FILES['file']['tmp_name']))
            {
                // File was uploaded
                if($_FILES["file"]["size"] > 0)
                {
                    $input_filename = $_FILES['file']['tmp_name'];

                    $var = csv_to_array($input_filename, get_default_row_for_bulk_csv());

                    if(!empty($_POST['create_posts'])) {
                        $var = create_facebook_posts($var, $facebook);
                    }

                    array_to_csv($var);
                }

                else
                {
                    $msg = "File was empty.";
                }

                exit(0);
            }

        } catch(Exception $e) {
            error_log($e->getType());
            error_log($e->getMessage());

            echo($e->getType());
            echo($e->getMessage());

            // Ask the user to login through Facebook
            $login_url = $facebook->getLoginUrl( array(
                'scope' => $fb_permissions
            ));
            echo 'Please <a href="' . $login_url . '">login.</a>';
        }

    } else {
        // Ask user to login through Facebook
        $login_url = $facebook->getLoginUrl( array( 'scope' => $fb_permissions ) );
        echo 'Please <a href="' . $login_url . '">login.</a>';
        // exit(0);
    }
?>

<!doctype html>
<html>
	<head>
		<title>Facebook Power Editor Ads Parser</title>
	</head>
	<body>
        <h1>Facebook Power Editor Ads Parser</h1>
		<?php if(!empty($msg)){?><div><?=$msg?></div><?php }?>
		<form action="" enctype="multipart/form-data" method="post" target="_blank">
			Upload a CSV file with master data: <br/>
			<input type="file" name="file" accept=".csv" /> <br/>
            <input type="checkbox" name="create_posts" value="1" />Create hidden Facebook posts <br/>
			<input type="submit" value="Start!" />
		</form>
	</body>
</html>