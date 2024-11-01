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
function wpca_display_admin(){
	if (!current_user_can('manage_options')){
		wp_die(__('You do not have sufficient permissions to access this page.', 'wpca'));
	} ?>
	<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2><?php _e('WP Cookies Alert', 'wpca'); ?></h2>
	<?php if(isset($_POST['wpca_reset'])){ ?>
	<div id="setting-error-settings_updated" class="updated settings-error"> 
	<p><strong><?php _e('Options reset.', 'wpca'); ?></strong></p></div>
	<?php }elseif(isset($_POST['wpca_update'])){ ?>
	<div id="setting-error-settings_updated" class="updated settings-error"> 
	<p><strong><?php _e('Options saved.', 'wpca'); ?></strong></p></div>
	<?php } ?>
	<?php
	if($options = wpca_get_saved_options()){ ?>
	<form method="POST" accept="options.php">
		<table class="form-table">
		<tbody>
			<tr><th colspan="2"><h3><?php _e('Content &amp; titles', 'wpca'); ?></h3></th></tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[alert_message]"><?php _e('Message', 'wpca'); ?></label>
				</th>
				<td>
					<textarea name="wpca_options[alert_message]" rows="5" cols="55"><?php echo $options['alert_message']; ?></textarea><br />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[more_link_title]"><?php _e('More link - Title', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[more_link_title]" value="<?php echo $options['more_link_title']; ?>" /><br />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[more_link_url]"><?php _e('More link - URL', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[more_link_url]" value="<?php echo $options['more_link_url']; ?>" /><br />
					<p class="description"><?php _e('URL where visitors can learn more about your web site\'s cookies.', 'wpca'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[ok_title]"><?php _e('OK button - Title', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[ok_title]" value="<?php echo $options['ok_title']; ?>" /><br />
				</td>
			</tr>
			<tr><th colspan="2"><h3><?php _e('Styling', 'wpca'); ?></h3></th></tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[alert_txt_color]"><?php _e('Message - Color', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[alert_txt_color]" value="<?php echo $options['alert_txt_color']; ?>" /><br />
					<p class="description"><?php _e('Enter a hexadecimal color value.', 'wpca'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[more_link_color]"><?php _e('More link - Color', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[more_link_color]" value="<?php echo $options['more_link_color']; ?>" /><br />
					<p class="description"><?php _e('Enter a hexadecimal color value.', 'wpca'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[ok_txt_color]"><?php _e('OK button - Color', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[ok_txt_color]" value="<?php echo $options['ok_txt_color']; ?>" /><br />
					<p class="description"><?php _e('Enter a hexadecimal color value.', 'wpca'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[ok_bg_color]"><?php _e('OK button - Background color', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[ok_bg_color]" value="<?php echo $options['ok_bg_color']; ?>" /><br />
					<p class="description"><?php _e('Enter a hexadecimal color value.', 'wpca'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[box_bg_color]"><?php _e('Alert box - Background color', 'wpca'); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="wpca_options[box_bg_color]" value="<?php echo $options['box_bg_color']; ?>" /><br />
					<p class="description"><?php _e('Enter a hexadecimal color value.', 'wpca'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="wpca_options[box_position]"><?php _e('Alert box - Position', 'wpca'); ?></label>
				</th>
				<td>
					<input type="radio" name="wpca_options[box_position]" value="top" <?php if($options['box_position'] == 'top') echo 'checked'; ?> /> <?php _e('Top', 'wpca'); ?><br />
					<input type="radio" name="wpca_options[box_position]" value="top_fixed" <?php if($options['box_position'] == 'top_fixed') echo 'checked'; ?> /> <?php _e('Top fixed', 'wpca'); ?> <em>(<?php _e('may be overlapped by the Toolbox if user is logged in', 'wpca'); ?>)</em><br />
					<input type="radio" name="wpca_options[box_position]" value="bottom" <?php if($options['box_position'] == 'bottom') echo 'checked'; ?> /> <?php _e('Bottom', 'wpca'); ?><br />
					<input type="radio" name="wpca_options[box_position]" value="bottom_fixed" <?php if($options['box_position'] == 'bottom_fixed') echo 'checked'; ?> /> <?php _e('Bottom fixed', 'wpca'); ?><br />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="wpca_options[use_tag]"><?php _e('Use template tag instead', 'wpca'); ?></label></th>
				<td>
					<input type="checkbox" name="wpca_options[use_tag]" value="1" <?php if($options['use_tag']) echo 'checked'; ?>/>
					<p class="description"><?php echo _e('You can use template tag wpca_print_box() to insert alert box in you theme\'s template.', 'wpca'); ?></p>
				</td>
			</tr>
			<tr><th colspan="2"><h3><?php _e('Reset to default', 'wpca'); ?></h3></th></tr>
			<tr valign="top">
				<th scope="row"><label for="wpca_reset"><?php _e('Reset', 'wpca'); ?></label></th>
				<td>
					<input type="checkbox" name="wpca_reset" value="1" />
					<p class="description"><?php echo _e('If checked all the options above will be reset after updating.', 'wpca'); ?></p>
				</td>
			</tr>
		</tbody>
		</table>
		<p class="submit"><input type="submit" name="wpca_update" class="button-primary" value="<?php _e('Save changes', 'wpca'); ?>"></p>
	</form>
<?php
	}else{ ?>
	<p style="color: #ff0000;"><?php _e('Error occured. Failed to get options.', 'wpca'); ?></p>
	<?php 
	} ?>
	</div>
<?php
}
function wpca_add_admin(){
	add_options_page( __('WP Cookies Alert', 'wpca'), __('WP Cookies Alert', 'wpca'), 'manage_options', 'wpca-options', 'wpca_display_admin');
}
add_action('admin_menu', 'wpca_add_admin');
?>
