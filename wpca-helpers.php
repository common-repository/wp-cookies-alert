<?php
/*Copyright 2013 ALEAPP (email: info@aleapp.com)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 2, as 
 published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function wpca_init(){
	load_plugin_textdomain('wpca', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'wpca_init');
function wpca_get_language(){
	if(is_admin()){
		//WPML, qTranslate
		if(isset($_GET['lang'])){
			return $_GET['lang'];
		}
		if(is_plugin_active('sitepress-multilingual-cms/sitepress.php') && isset($_COOKIE['_icl_current_admin_language'])){
			if($_COOKIE['_icl_current_admin_language'] == 'all'){
				return substr(get_locale(), 0, 2);
			}else{
				return $_COOKIE['_icl_current_admin_language'];
			}
		}
		if(is_plugin_active('qtranslate/qtranslate.php') && isset($_COOKIE['_qtrans_admin_language'])){
			return $_COOKIE['_qtrans_admin_language'];
		}

	}
	return substr(get_locale(), 0, 2);
}
function wpca_get_default_options(){
	$defaults_dir = dirname(__FILE__) . '/default-options';
	if(file_exists($defaults_dir . '/options-' . wpca_get_language())){
		return json_decode(file_get_contents($defaults_dir . '/options-' . wpca_get_language()));
	}
	if(file_exists($defaults_dir . '/options-en')){
		return json_decode(file_get_contents($defaults_dir . '/options-en'));
	}
	return false;
}
function wpca_get_valid_options($options=NULL){
	if(!$default_options = wpca_get_default_options()){
		return false;
	}
	$valid_options = array();
	$required_options = array('alert_message', 'box_bg_color', 'box_position', 'ok_title');
	if(isset($options)){
		foreach($default_options as $option_key => $default_option){
			if(isset($options[$option_key])){
				if(trim($options[$option_key]) == '' && in_array($option_key, $required_options)){
					$valid_options[$option_key] = $default_option;
				}else{
					$valid_options[$option_key] = trim(stripslashes($options[$option_key]));
				}
			}else{
				if(in_array($option_key, $required_options)){
					$valid_options[$option_key] = $default_option;
				}else{
					$valid_options[$option_key] = '';
				}
			}
		}
	}else{
		foreach($default_options as $option_key => $default_option){
			$valid_options[$option_key] = $default_option;
		}
	}
	return $valid_options;
}
function wpca_manage_options(){
	if(isset($_POST['wpca_update'])){
		if(isset($_POST['wpca_reset'])){
			delete_option('wpca_' . wpca_get_language());
		}else{
			update_option('wpca_' . wpca_get_language(), json_encode(wpca_get_valid_options($_POST['wpca_options'])));
		}
	}
	if(!get_option('wpca_' . wpca_get_language())){
		// Plugin versions compatibility
		if(is_admin() && get_option('wpca_options_' . get_locale())){
			add_option('wpca_' . substr(get_locale(), 0, 2), get_option('wpca_options_' . get_locale()));
			delete_option('wpca_options_' . get_locale());
			return;
		}
		if($default_options = wpca_get_valid_options()){
			add_option('wpca_' . wpca_get_language(), json_encode($default_options));
		}
	}
}
add_action('admin_init', 'wpca_manage_options');
function wpca_get_saved_options(){
	if($saved_options = get_option('wpca_' . wpca_get_language())){
		return json_decode($saved_options, true);
	}
	return false;
}
?>
