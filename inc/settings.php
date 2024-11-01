<?php
/* ###################################################################### */
/* Avoid direct file access to plugin files */
/* ###################################################################### */
if ( ! defined( 'ABSPATH' ) ) exit; 
if (! current_user_can('manage_options') ) die("You are not authorized to access this page.");

global $wpdb;

?>
<div class="admin-wrapper">
	<div id="message_center" class="alert-green">Settings Saved!</div>
	<div class="admin-box-top">
<h2>Dojo Rank Board Settings</h2>
			 </div>
	<div class="admin-box-bottom padded ">
	<?php wp_nonce_field( 'wpnafu-settings-nonce', 'security' ); ?>
	<table id="nafu_settings_table">
	<tr>
		<th>Number of Rows: </th>
		<td><?php wpnafu_loadSettingRowcount(); ?></td>
		<td>This specifies the number of rows in your Rank Board. You can have as few as one, and as many as five; try to arrange it for asthetics and balance. Often, many schools list instructors and black belt members on a different rows than white belts and unranked members. You cannot remove a row that has slats in it, so be sure to empty any rows you plan on removing.</td>
	</tr>
	
	<tr>
		<th>Height of Slats (px):</th>
		<td><?php wpnafu_loadSettingHeight(); ?> </td>
		<td>By default, each slat is 120px tall. If you are a web designer, you can of course override this in CSS. This option lets you make the slats taller or shorter to accomodate students with longer names. However, if your names get very long, you may want to start using initials!</td>
	</tr>
	
	<tr>
		<th>Width of Slats (px):</th>
		<td><?php wpnafu_loadSettingWidth(); ?> </td>
		<td>By default, each slat is 18px wide. This option lets you make all the slats wider or thinner. Again, you can override this in your theme's CSS. </td>
	</tr>
	
	<tr >
		<th>Gap Between Slats (px):</th>
		<td><?php wpnafu_loadSettingSpacing(); ?></td>
		<td>By default, there is a small amount of spacing (2px) between each slat.  However, if you want to move them closer together or farther apart, you can adjust this to your preference. Note, this setting will not display in the Editor, only in the live shortcode.</td>
	</tr>
	
	<tr>
		<th>Slat Font Size:</th>
		<td><?php wpnafu_loadSettingFontsize(); ?></td>
		<td>This setting lets you make the lettering on each slat larger or smaller than the default.</td>
	</tr>
	
	<tr >
		<th>Show Tooltip:</th>
		<td><?php wpnafu_loadSettingTooltip(); ?> </td>
		<td>This displays a small mouseover "What is this?" link below the Rank Board, theat explains what the board is and provides a link to the author.  The tooltip content is only visible when the site visitor "mouses over" the link.  The author has put a lot of effort into developing this free plugin, we're hoping you'll show some love by including the tooltip. The SEO helps us a lot!</td>
	</tr>
	<input type="hidden" id="layouttype" value="Horizontal">
 
	<tr >
		<th colspan=2><button id="saveSettings" onclick="nafu_saveSettings('<?php  echo WPNAFU_URL; ?>');">Save Settings</button></th>
		<td>Once you have adjusted the settings the way you like, make sure you save your edits!</td>
	</tr>
	</table>
		</div> 
		
</div><!--- wrapper ---> 