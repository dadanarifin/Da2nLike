<?php
/*
Plugin Name: Da2nLike
Description: A plugin that allow users or the puplic to like/unlike posts with a sidebar widget to display most liked posts. include function da2nlike('button') or function da2nlike('count')
Version: 1.0
Author: Dadan Arifin
Author URI: http://dadanarifin.com
*/

// constants paths
define('WL_PATH', dirname(__FILE__));

// constants URIs
define('WL_URI', get_bloginfo('wpurl') . '/wp-content/plugins/da2nlike');
define('WL_CSSURI', WL_URI . '/css');
define('WL_JSURI', WL_URI . '/js');
define('WL_IMGURI', WL_URI . '/images');


// Calls database global
global $wpdb, $wl_tablename;


// Combines default db tables prefix with our newly tabel name
$wl_tablename = $wpdb->prefix . 'da2nlike';


// includes plugin files
require_once(WL_PATH . '/widget.da2nlike.php');			// Sidebar widget


// Runs when the plugin is activated
function da2nlike_activate() {
	global $wpdb, $wl_tablename;
	
	if (!empty($wpdb->charset))
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		
		// run the SQL statement on the database
		$wpdb->query("CREATE TABLE {$wl_tablename} (
							id BIGINT(20) NOT NULL AUTO_INCREMENT,
							post_id BIGINT(20) NOT NULL,
							ip_address VARCHAR(25) NOT NULL,
							user_id BIGINT(20) NOT NULL,
							like_status VARCHAR(25) NOT NULL DEFAULT 'like',
							PRIMARY KEY (id), 
							UNIQUE (id)
							){$charset_collate};");
		
		$wpdb->query("ALTER TABLE `$wpdb->posts` ADD `like_count` BIGINT( 20 ) NOT NULL DEFAULT  '0'");
	
	update_option('da2nlike_capabilities', 'users-only');
	update_option('da2nlike_colour', 'red');
	update_option('da2nlike_style', 'style_1');
	update_option('da2nlike_like_txt', 'Like?');
	update_option('da2nlike_unlike_txt', 'Unlike!');
	update_option('da2nlike_widget_txt', 'Likes');
	
	
}
register_activation_hook(__FILE__, 'da2nlike_activate');


// Runs when the plugin is deactivated
function da2nlike_deactivate() {
	global $wpdb, $wl_tablename;
	
	$wpdb->query("ALTER TABLE `$wpdb->posts` DROP `like_count`;");
	$wpdb->query("DROP TABLE IF EXISTS {$wl_tablename};");
}
register_deactivation_hook(__FILE__, 'da2nlike_deactivate');


// register functions
add_action('admin_menu', 'da2nlike_settingspage_create');
add_action('init', 'da2nlike_init');
add_action('admin_init', 'da2nlike_admin_init');


// settings page create
function da2nlike_settingspage_create(){
	
	if (isset($_POST['da2nlike_save'])) {
		// $da2nlike_settings['da2nlike_capabilities'] = $_POST['da2nlike_capabilities'];
		$da2nlike_settings['da2nlike_unlike_txt'] = $_POST['da2nlike_unlike_txt'];
		$da2nlike_settings['da2nlike_like_txt'] = $_POST['da2nlike_like_txt'];
		$da2nlike_settings['da2nlike_colour'] = $_POST['da2nlike_colour'];
		$da2nlike_settings['da2nlike_style'] = $_POST['da2nlike_style'];
		$da2nlike_settings['da2nlike_widget_txt'] = $_POST['da2nlike_widget_txt'];
		
		foreach($da2nlike_settings as $name => $val) {
			if(isset($_POST[$name])) {
				update_option($name, $val);
			}
		}
		
		if(isset($_POST['da2nlike_capabilities'])) {
			update_option('da2nlike_capabilities', 'users-only');
		} else {
			update_option('da2nlike_capabilities', 'all');
		}
		
		header("Location: options-general.php?page=da2nlike&saved=true");
		die;
	}
	
	$page = add_options_page( __('Da2nLike', 'da2nlike'), __('Da2nLike', 'da2nlike'), 'manage_options', 'da2nlike', 'da2nlike_settingspage');
	add_action('admin_head-' . $page, 'da2nlike_adminhead');	
}


// da2nlike front-end init
function da2nlike_init(){
	
	// includes main class
	require_once(WL_PATH . '/class.da2nlike.php');
	
	// includes template tags for ease of usage
	require_once(WL_PATH . '/template-tags.php');
	
	// adds necessary stylesheets to wp_head
	wp_enqueue_style('da2nlike', WL_CSSURI . '/da2nlike.css', false, '1.0', 'screen');
	
	// adds necessary javascripts to wp_head
	wp_enqueue_script('jquery');
	wp_enqueue_script('da2nlike', WL_JSURI . '/da2nlike.js', false, '1.0', false);
}


// da2nlike back-end init
function da2nlike_admin_init(){
	// adds necessary stylesheets to wp_head
	wp_enqueue_style('da2nlike-admin', WL_CSSURI . '/admin.css', false, '1.0', 'screen');
	
	// adds necessary javascripts to wp_head
	wp_enqueue_script('da2nlike-admin', WL_JSURI . '/admin.js', false, '1.0', false);
}


// da2nlike back-end head
function da2nlike_adminhead(){
	
}


// da2nlike front-end head
function da2nlike_head(){
	$js = '<script type="text/javascript"> var da2nlike_url = "' . WL_URI . '"; </script>' . "\n";
	echo apply_filters('da2nlike_head', $js);
	
	do_action('da2nlike_head');
}
add_action('wp_head', 'da2nlike_head');


// da2nlike settings page callback
function da2nlike_settingspage(){
	require_once(WL_PATH . '/wrap.php');
}




/* *******************************************************************************************
 * The code below creates the da2nlike disable button on any new post page or update post page
 */

$meta_key = 'da2nlike';

function create_da2nlike_meta_box() {
	if(function_exists('add_meta_box')) {
		add_meta_box( 'da2nlike-metabox', 'Da2nLike', 'da2nlike_meta_box', 'post', 'side', 'high' );
	}
}

function da2nlike_meta_box() {
	global $post, $meta_key;
	
	$checked = '';
	$meta_val = get_post_meta($post->ID, $meta_key, true);
	
	if($meta_val === 'disabled'){
		$checked = 'checked';
	}
	
	$form =  '<div class="form-wrap">' . "\n";
	$form .= '<div class="form-field">' . "\n";
	$form .= '<label for="disable_da2nlike">' . "\n";
	$form .= '<input type="checkbox" name="disable_da2nlike" id="disable_da2nlike" style="width: auto;" ' . $checked . '>';
	$form .= ' Disable Da2nLike on this post</label>' . "\n" . '</div>' . "\n" . '</div>';
	
	echo $form;
}

function save_da2nlike_meta_box($post_id) {
	global $post, $meta_key;
	
	if(!current_user_can( 'edit_post', $post_id))
		return $post_id;
	
	if(isset($_POST['disable_da2nlike'])) {
		update_post_meta($post_id, $meta_key, 'disabled');
	} else {
		update_post_meta($post_id, $meta_key, 'enabled');
	}
}

add_action('admin_menu', 'create_da2nlike_meta_box');
add_action('save_post', 'save_da2nlike_meta_box');

?>