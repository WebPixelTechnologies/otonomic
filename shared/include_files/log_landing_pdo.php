<?php
    if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

    if(isLocalhost()) {
        if(!defined('DB_HOSTNAME')) { define('DB_HOSTNAME','localhost'); }
        if(!defined('DB_USERNAME')) { define('DB_USERNAME','root'); }
        if(!defined('DB_PASSWORD')) { define('DB_PASSWORD',''); }
        if(!defined('DB_DATABASE')) { define('DB_DATABASE','page2site'); }
    } else {
        if(!defined('DB_HOSTNAME')) { define('DB_HOSTNAME','localhost'); }
        if(!defined('DB_USERNAME')) { define('DB_USERNAME','omri'); }
        if(!defined('DB_PASSWORD')) { define('DB_PASSWORD','vxhxnt12akgnrh'); }
        if(!defined('DB_DATABASE')) { define('DB_DATABASE','page2site'); }
    }

    function isLocalhost() {
        return (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'p2s.test' ));
    }

    function createUserIdentifier() {
        if(isset($_SESSION['User.random_id'])) {
            return $_SESSION['User.random_id'];
        }
        if(isset($_COOKIE['User.random_id'])) {
            return $_COOKIE['User.random_id'];
        }
		
        $user_random_identifier = mt_rand();
        setcookie("User.random_id", $user_random_identifier, 3600*24*30);
		$_SESSION['User.random_id'] =  $user_random_identifier;
        return $user_random_identifier;
    }

	function curPageURL() {
 		$pageURL = 'http';
 		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
		{
			$pageURL .= "s";
		}
 		$pageURL .= "://";
 		if ($_SERVER["SERVER_PORT"] != "80")
		{
  			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 		}
		else
		{
  			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 		}
		return $pageURL;
	}

    function recordEventInDb($category = 'LandingPage', $event = 'Load', $label = '') {
        $db = new PDO('mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE.';charset=utf8', DB_USERNAME, DB_PASSWORD);
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $current_url = $_SERVER['REQUEST_URI'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $user_id = createUserIdentifier();
        $created = date('Y-m-d H:i:s');
        $result = $db->exec("INSERT INTO site_action_logs(category, event, label, current_url, referer, ip, user_id, created)
            VALUES ('{$category}', '{$event}', '{$label}', '{$current_url}', '{$referer}', '{$ip}', '{$user_id}', '{$created}')");
        $db   = NULL;
    }

?>