<?php
/* ###################################################################### */
/* Avoid direct file access to plugin files */
/* ###################################################################### */
if ( ! defined( 'ABSPATH' ) ) exit; 
if (! current_user_can('manage_options') ) die("You are not authorized to access this page.");

global $wpdb;

?>
<div class="admin-wrapper">
	
	<div class="admin-box-top">
<h2>Nafudakake: Wordpress Rank Board Plugin</h2>
	</div>
	<div class="admin-box-bottom padded ">
<p>In many traditional Japanese martial art schools, the members and students would have a small wooden slat with their name imprinted upon it. This slat would be hung on a special board (“nafudakake”) in the Dojo which would show their rank and seniority. This plugin provides an easy way to create a "virtual rank board" that you can insert into your Wordpress site, whether your site is for a martial art dojo, sporting league, or any other organization.</p>

	<div class="admin-divider"> </div>
<h2>Using the Drag-and-Drop Editor</h2>
<table> 
<tr><td><b>Adding New Slats:</b></td><td>At the top of the Editor, you will find an input field and a dropdown menu.  Simply type the text that you would like to appear in the new slat, select the type of slat you want it to be, and hit the "add" button.  Most of your slats will be "name slats", like "D Jones" or "M Ueshiba", but you can structure the slat text to be whatever you like.  You have three slat type options in the drop down: "name slat" for member names, "black belt divider" to create a black-themed slat to divide upper level ranks like "shodan", "nidan", "instructor", "shihan" etc.; and "white belt divider" to create a differently themed slat to divide white belt (mudansha and unranked) student ranks.</td></tr>
<tr class="altrow"><td><b>Drag-and-Drop:</b></td><td>Any new slats you create will be appended to the end of the top row.  Simply click on the slat you want to move and arrange, and drag it to the location you want it to be; the other slats will automatical reorder and move out of the way.  You can also drag slats between rows.  Unfortunately, the first item in each row can sometimes be a little finicky about having a slat inserted in front of them, but if you try reordering the first item instead it should work fine for you (sorry, this is an artifact of the code library I'm using, and we're stuck with this "feature").</td></tr>
<tr><td><b>Removing Slats:</b></td><td>If you made a mistake or wish to delete a slat, just drag it to the "Trash" row.  Slats in the Trash row will be removed when you save and exit, else otherwise you can empty the trash any time you like using the "Empty Trash" button at the top of the editor.</td></tr>
</table>

	<div class="admin-divider"> </div>
<h2>Shortcodes</h2>
<p>Once you have built your Rank Board in the editor to suit your liking, just insert the <b>[rank-board]</b> shortcode anywhere in your site's posts or pages where you want your Rank Board to appear, and the plugin will do the rest!</p>

	<div class="admin-divider"> </div>
<h4>About the Author</h4> 
<p>This plugin was written by Guy Hagen, co-founder and chief instructor of the <a href="http://tampaaikido.com">AIkido Chuseikan of Tampa Bay</a> dojo in Tampa Bay, Florida.  We'd love it if you dropped by our website, "liked us" on Facebook, or visited us when you are in town!</p>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=222247554494649";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><div class="fb-like" data-href="https://www.facebook.com/TampaAikido/" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"> 
</div>


</div>
