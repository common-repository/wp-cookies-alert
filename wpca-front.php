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
function wpca_print_header_scripts(){
	$options = wpca_get_saved_options(); ?>
	<style type="text/css">
		#wpca-box {
			background-color: <?php echo $options['box_bg_color']; ?> !important;
			<?php if(!$options['use_tag']){ ?>
				<?php if($options['box_position'] == 'top_fixed'){ ?>
			width: 100%;
			position: fixed;
			top: 0px;
				<?php }elseif($options['box_position'] == 'bottom_fixed'){ ?>
			width: 100%;
			position: fixed;
			bottom: 0px;
				<?php } ?>
			<?php } ?>
		}
		#wpca-message {
			<?php if($options['alert_txt_color']){ echo 'color: ' . $options['alert_txt_color'] . ' !important;'; } ?> 
		}
		#wpca-more {
			<?php if($options['more_link_color']){ echo 'color: ' . $options['more_link_color'] . ' !important;'; } ?> 
		}
		#wpca-ok a {
			<?php if($options['ok_bg_color']){ echo 'background-color: ' . $options['ok_bg_color'] . ' !important;'; } ?> 
			<?php if($options['ok_txt_color']){ echo 'color: ' . $options['ok_txt_color'] . ' !important;'; } ?> 
		}
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function(){
		<?php if(!$options['use_tag']){ if($options['box_position'] == 'top'){ ?>
			jQuery('body').prepend(jQuery('#wpca-box'));
		<?php }else{ ?>
			jQuery('body').append(jQuery('#wpca-box'));
		<?php }} ?>
			jQuery('#wpca-ok a').click(function(){
				document.cookie='wpca_ok=1; path=/';
				jQuery('#wpca-box').fadeOut();
				return false;
			});
		});
	</script>
<?php
}
add_action('wp_head', 'wpca_print_header_scripts');
function wpca_add_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_style('wpca-css', plugins_url('style.css', __FILE__), array(), '1.0');
}
add_action('wp_enqueue_scripts', 'wpca_add_scripts');
function wpca_print_box(){
	if(!$options = wpca_get_saved_options()) return false;
	if(!isset($_COOKIE['wpca_ok'])){ ?>
		<div id="wpca-box">
			<div id="wpca-message">
				<div class="wpca-wrapper">
					<?php echo $options['alert_message']; ?>
					<?php if($options['more_link_title'] && $options['more_link_url']) { ?><br /><a id="wpca-more" href="<?php echo $options['more_link_url']; ?>"><?php echo $options['more_link_title']; ?></a><?php } ?>
				</div>
			</div>
			<div id="wpca-ok">
				<div class="wpca-wrapper">
					<a href="#"><?php echo $options['ok_title']; ?></a>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div style="clear: both;"></div>
		</div>
	<?php
	}
}
function wpca_print_box_action(){
	if(!$options = wpca_get_saved_options()) return false;
	if($options['use_tag']) return false;
	wpca_print_box();
}
add_action('wp_footer', 'wpca_print_box_action');
?>
