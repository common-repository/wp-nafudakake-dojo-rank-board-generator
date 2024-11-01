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
		<h2>Rank Board Editor</h2>
	</div>
	<div class="admin-box-bottom padded ">
			<div class="clearfix" style="height: 36px; padding-top: 0px;"> <!-- settings and control bar -->
				<div class="settingsbox">
					<input id="newslat" value="">
					<select id="slattype">
					<option value="nameslat">Name Slat</option>
					<option value="yudansha">Black Belt Divider</option>
					<option value="mudansha">White Belt Divider</option>
					</select>
					<?php wp_nonce_field( 'wpnafu-editor-nonce', 'security' ); ?>
					<button onclick='nafu_addSlat(<?php echo get_option("nafu_slatheight").",".get_option("nafu_slatwidth").",".(get_option("nafu_slatspacing")+0).",".(get_option("nafu_fontsize")+0); ?>);'>Add Slat</button>		
				</div>
				
				<div class="settingsbox">
					<button id="saveSettings" onclick="nafu_saveEdits('<?php echo WPNAFU_URL; ?>');">Save Changes</button>
				</div> 
			</div> <!-- settings and control bar -->
		
	<div class="admin-divider"> </div>
	
		<h2>Rank Board Rows and Slats</h2>
		<?php wpnafu_loadSettingRows(); ?> 

		
		
	</div><!--- admin box --->	  
</div><!--- wrapper ---> 