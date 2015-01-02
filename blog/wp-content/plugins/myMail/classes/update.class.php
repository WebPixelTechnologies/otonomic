<?php if(!defined('ABSPATH')) die('not allowed');


//Envato_Plugin_UpdateClass
if ( !class_exists( "Envato_Plugin_Update" ) ) :

class Envato_Plugin_Update {

	private static $option_name = 'envato_plugins';

	private static $plugins = null;
	private static $plugin_data = array();
	
	private static $saved = false;
	private static $_instance = null;

	public static function add($purchasecode, $args = array()){
		
		if (!isset(self::$_instance)){
		
			self::$_instance = new self();
			
		}
		
		$plugin_data = (object) wp_parse_args($args, array(
			'purchasecode' => $purchasecode,
			'remote_url' => false,
			'version' => false,
			'plugin_slug' => false
		));
		
		if(!isset(self::$plugin_data[$plugin_data->plugin_slug])){
			
			self::$plugin_data[$plugin_data->plugin_slug] = $plugin_data;
			
		}
		
		return self::$_instance;
	}
	
	private function __construct() {
		
		self::$plugins = self::get_plugin_options();
		
		add_action( 'admin_init', array( &$this, 'init' ), 100 );
		add_filter( 'site_transient_update_plugins', array( &$this, 'update_plugins_filter' ), 1 );

		add_action( 'wp_update_plugins', array( &$this, 'check_periodic_updates' ), 99 );
		add_action( 'envatopluginupdate_check', array( &$this, 'check_periodic_updates' ) );
		//add_action( 'shutdown', array( &$this, 'schedule' ), 100 );
		
		add_filter( 'http_request_args', array( &$this, 'http_request_args' ), 100, 2 );
		
	}
	
	public function init() {
	
		if(is_admin() && current_user_can("update_plugins")){
				
			global $pagenow, $wp_header_to_desc;
			
			$wp_header_to_desc[678] = 'No Purchasecode entered! Please provide a purchasecode!';
			$wp_header_to_desc[679] = 'Purchasecode invalid!';
			$wp_header_to_desc[680] = 'Purchasecode already in use!';
			
			if($pagenow == 'update-core.php'){
				
				//force check on the updates page
				do_action( 'envatopluginupdate_check' );
	
			}else if($pagenow == 'plugin-install.php'){
			
				if(isset($_GET['plugin']) && in_array($_GET['plugin'], array_keys(self::$plugin_data))){
					add_filter( "plugins_api",  array( &$this, 'plugins_api' ), 10, 3);
					add_filter( "plugins_api_result",  array( &$this, 'plugins_api_result' ), 10, 3);
				}
			}
			
		}
	}
	
	public function http_request_args($r, $url) {
	
		//don't change requests to the wordpress api
		if(false !== strpos($url, '//api.wordpress.org/')){
			return $r;
		}
		
		foreach(self::$plugins as $slug => $plugin){
			if($url == $plugin->package){
				$r['method'] = 'POST';
				$r['body'] = $this->header_infos($slug);
				return $r;
			}
		}
		return $r;
	}
	
	public function plugins_api($noidea, $action, $args) {
	
		global $pagenow;
		
		if($pagenow != 'update-core.php'){
			$slug = $args->slug;
			$plugin = self::$plugin_data[$slug];
			
			$version_info = $this->perform_remote_request( $slug, $plugin->remote_url );
			
			if(!$version_info) wp_die('There was an error while getting the information about the plugin. Please try again later');
			
			$res = $version_info->data;
			$res->slug = $slug;
			if(isset($res->contributors))$res->contributors = (array) $res->contributors; 
			$res->sections = (array) $res->sections;
			 
		} else {
		
			$res = self::$plugins[$slug];
		}
		
		return $res;
		
	}
	
	public function plugins_api_result($res, $action, $args) {
		if(!isset($this->plugin_slug)) return $res;
		
		if($args->slug == $this->plugin_slug){
			$res->external = true;
		}
		
		return $res;
		
	}

	public function check_periodic_updates( ) {
		
		switch(current_filter()){
			case 'envatopluginupdate_check';
				$timeout = 60;
				break;
			case 'upgrader_post_install';
				$timeout = 0;
				break;
			default:
				$timeout = 3600;
		}
		
		foreach(self::$plugin_data as $slug => $plugin){
			
			if(time()-self::$plugins[$slug]->last_update >= $timeout ){
				$this->check_for_update( $slug );
			}
			
		}
	}
	
	public function clear_option() {
		is_multisite() ? update_site_option( self::$option_name, '' ) : update_option( self::$option_name, '' );
	}
	
	private static function get_plugin_options() {
		//Get plugin options
		$options = is_multisite() ? get_site_option( self::$option_name ) : get_option( self::$option_name );
		
		if ( !$options ) $options = array();
		
		return $options;
	}
	
	public function save_plugin_options() {
		
		foreach(self::$plugin_data as $slug => $plugin){
			if(isset(self::$plugins[$slug]->item_data)) unset(self::$plugins[$slug]->item_data);
		}
		is_multisite() ? update_site_option( self::$option_name, self::$plugins ) : update_option( self::$option_name, self::$plugins );
	}
	
	public function check_for_update( $slug ) {

		if( empty(self::$plugin_data ) ) return false;
		
		if ( !isset( self::$plugin_data[ $slug ] ) ) return false;
		
		if ( !is_array( self::$plugins ) ) return false;
		
		$save = false;
		
		$plugin = self::$plugin_data[ $slug ];
		
		//Check to see that plugin options exist
		if ( !isset( self::$plugins[ $slug ] ) ) {

			$plugin_options = new stdClass;
			$plugin_options->slug = $slug;
			$plugin_options->purchasecode = $plugin->purchasecode;
			$plugin_options->package = '';
			$plugin_options->upgrade_notice = '';
			$plugin_options->new_version = $plugin->version;
			$plugin_options->last_update = time();

			self::$plugins[ $slug ] = $plugin_options;
			
		}

		$current_plugin = self::$plugins[ $slug ];
		$current_plugin->purchasecode = $plugin->purchasecode;
		
		//Check for updates
		unset($current_plugin->error);
		$version_info = $this->perform_remote_request( $slug, $plugin->remote_url );
		
		if ( is_wp_error( $version_info ) || !$version_info){
			global $notice;
			self::$plugins[ $slug ]->error = is_wp_error( $version_info ) ? $version_info->get_error_message() : $notice;
			self::$plugins[ $slug ]->last_update = time();
			self::$plugins[ $slug ]->new_version = NULL;
			$save = true;
		
		//$version_info should be an array with keys ['version'] and ['download_url']
		}else if ( isset( $version_info->version ) && isset( $version_info->download_url ) ) {
			$current_plugin->new_version = $version_info->version;
			$current_plugin->package = $version_info->download_url;
			$current_plugin->last_update = time();
		
			if( isset( $version_info->upgrade_notice ) ) $current_plugin->upgrade_notice = $version_info->upgrade_notice;
			if( isset( $version_info->data ) ) $current_plugin->item_data = $version_info->data;
			self::$plugins[ $slug ] = $current_plugin;
			$save = true;
			
		}
		
		if($save && !self::$saved){
			add_action( 'shutdown', array( &$this, 'save_plugin_options' ), 100 );
			self::$saved = true;
		}

		
		return self::$plugins[ $slug ];
		
	}

	public function perform_remote_request( $slug, $url, $body = array(), $headers = array() ) {

		if ( false === ( $result = wp_cache_get( 'plugin_info_'.$slug ) ) ) {
			
			$body = wp_parse_args( $body, $this->header_infos( $slug ) ) ;
			
			$body = http_build_query( $body, '', '&' );
	
			$headers = wp_parse_args( $headers, array(
				'Content-Type' => 'application/x-www-form-urlencoded',
				'Content-Length' => strlen( $body ),
				'X-ip' => $_SERVER['SERVER_ADDR'],
			) );
			
	
			$post = array( 'headers' => $headers, 'body' => $body );
			//Retrieve response
			$response = wp_remote_post( add_query_arg( array('envato_item_info' => '' ), esc_url( $url )), $post );
			$response_code = wp_remote_retrieve_response_code( $response );
			$response_body = wp_remote_retrieve_body( $response );
			
			if ( $response_code != 200 || is_wp_error( $response_body ) ) {
				return $response_body;
			}
			
			$result = json_decode( $response_body );
			
			if(!empty($result->error)){
				global $notice;
				$notice = $result->error;
				return false;
			}
		
			wp_cache_set( 'plugin_info_'.$slug, $result );
		}
		
		return $result;
		
	}
	
	public function update_plugins_filter( $value ) {
		
		foreach(self::$plugin_data as $slug => $plugin){
		
			if( !isset( self::$plugins[ $slug ] ) ) continue;
		
			if( empty(self::$plugins[ $slug ]->package) ) continue;
			
			if( version_compare( $plugin->version, self::$plugins[ $slug ]->new_version, '>=' ) ) continue;
		
			$value->response[ $slug ] = self::$plugins[ $slug ];
		
		}
		return $value;
	}
	
	private function header_infos( $slug ) {
	
		include ABSPATH . WPINC . '/version.php';
		
		if(!$wp_version) global $wp_version;
		
		$return = array(
			'purchasecode' => self::$plugin_data[ $slug ]->purchasecode,
			'version' => self::$plugin_data[ $slug ]->version,
			'slug' => $slug,
			'wp-version' => $wp_version,
			'referer' => home_url(),
			'referer2' => 'http://'.$_SERVER['HTTP_HOST'].preg_replace( '#/(wp-admin/.*|wp-cron.php).*#i', '', $_SERVER['SCRIPT_NAME'] ),
			'multisite' => is_multisite(),
		);
		
		return $return;
	}
	

}
endif;