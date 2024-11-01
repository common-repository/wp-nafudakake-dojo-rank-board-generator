<?php
/* ###################################################################### */
/* Utility */
/* ###################################################################### */
function console_log($data)
{
	echo("<script>console.log('PHP: ".$data."');</script>");
}

/* ###################################################################### */
/* Security */
/* ###################################################################### */
if ( ! defined( 'ABSPATH' ) ) exit; 

 function nafu_check_browser_version() {
    if ( empty( $_SERVER['HTTP_USER_AGENT'] ) )
        return false;
 
    $key = md5( $_SERVER['HTTP_USER_AGENT'] );
 
    if ( false === ($response = get_site_transient('browser_' . $key) ) ) {
        $options = array(
            'body'          => array( 'useragent' => $_SERVER['HTTP_USER_AGENT'] ),
            'user-agent'    => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . home_url()
        );
 
        $response = wp_remote_post( 'http://api.wordpress.org/core/browse-happy/1.1/', $options );
 
        if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) )
            return false;
 
        /**
         * Response should be an array with:
         *  'platform' - string - A user-friendly platform name, if it can be determined
         *  'name' - string - A user-friendly browser name
         *  'version' - string - The version of the browser the user is using
         *  'current_version' - string - The most recent version of the browser
         *  'upgrade' - boolean - Whether the browser needs an upgrade
         *  'insecure' - boolean - Whether the browser is deemed insecure
         *  'update_url' - string - The url to visit to upgrade
         *  'img_src' - string - An image representing the browser
         *  'img_src_ssl' - string - An image (over SSL) representing the browser
         */
        $response = json_decode( wp_remote_retrieve_body( $response ), true );
 
        if ( ! is_array( $response ) )
            return false;
 
        set_site_transient( 'browser_' . $key, $response, WEEK_IN_SECONDS );
    }
 
    return $response;
}

/* ###################################################################### */
/* Hooks and Enqueues */
/* ###################################################################### */

/* contingent javascript load? */

add_action( 'wp_enqueue_scripts', 'wpnafu_enqueue' ); 
add_action( 'admin_init', 'wpnafu_enqueue_admin' );
add_action('admin_menu', 'wpnafu_enqueue_admin');

function wpnafu_enqueue() {
	// Respects SSL, Style.css is relative to the current file
	wp_register_style( 'wpnafu-style', WPNAFU_URL . 'styles/wp-nafudakake.css' );
	wp_enqueue_style( 'wpnafu-style' );
	
	wp_enqueue_script( 'wpnafu-live-js', plugin_dir_url( __FILE__ ) . 'wp-nafu.js',array('jquery'), null, TRUE);
}
   
function wpnafu_enqueue_admin() {
	// Respects SSL, Style.css is relative to the current file
	wp_register_style( 'wpnafu-admin-style', WPNAFU_URL . 'styles/wp-nafu-admin.css' );
	wp_enqueue_style( 'wpnafu-admin-style' );
	
	// we are making some jQuery format actions, so have WP set the dependency
	// and load the most current jQuery library
	wp_enqueue_script( 'wpnafu-admin-js', plugin_dir_url( __FILE__ ) . 'wp-nafu-admin.js',array('jquery'), null, TRUE);
}
  
  
  
$browser = nafu_check_browser_version(); 
 
if(strtolower($browser["name"]) == 'safari') {
	add_action( 'wp_enqueue_scripts', 'wpnafu_enqueue_safari' ); 
} 
 

function wpnafu_enqueue_safari() {
	// Respects SSL, Style.css is relative to the current file
	wp_register_style( 'wpnafu-style-safari', WPNAFU_URL . 'styles/wp-nafudakake-safari.css' );
	wp_enqueue_style( 'wpnafu-style-safari' );
}


/* ###################################################################### */
/* AJAX Database actions */
/* ###################################################################### */
 
 

add_action( 'admin_footer', 'nafu_saveEdit_script' ); // Write our JS below here
function nafu_saveEdit_script() { 
} // end saveEdits
		
 

/* ------------------- WP-embedded callback for save changes  ----------*/
add_action( 'wp_ajax_nafu_action', 'nafu_saveEdits_callback' );

function nafu_saveEdits_callback() {
	global $wpdb;  

	
	check_ajax_referer('wpnafu-editor-nonce', 'security'); 
	
	// params is an array of arrays - each array must be iterated and sanitized
	$params = array("saveRows", "saveClasses", "saveContents");
	
	foreach ($params as $param)
	{
		$option_name = "nafu_".$param;
		$newedit = $_POST[$param];
		
		// only place user could put in damaging text is in slat contents.
		if ($option_name =="saveContents")
		{
			$l=length($newedit);
			/* sanitize.  All submissions are text.  No HTML allowed. */
			for ($i=0; $i<$l; $i++) 
			{
				$newedit[$i]=sanitize_text_field(strip_tags($newedit[i]));
			}
		}
		
		if (!add_option($option_name, $newedit)) 
		{
			update_option($option_name, $newedit); 
		}	
	}
	
	wp_die(); // required to terminate immediately and return a proper response
}
 
 

/* ------------------- WP-embedded callback for save settings  ----------*/
add_action( 'wp_ajax_nafu_saveaction', 'nafu_saveSettings_callback' );

function nafu_saveSettings_callback() {
	global $wpdb;  

	
	check_ajax_referer('wpnafu-settings-nonce', 'security');
	
	$params = array("rowcount", "slatheight", "slatwidth",  "slatspacing", "fontsize", "showtooltip", "layouttype");
	$vals = array(1,1,1,1,2,3,3);
	
	foreach ($params as $param)
	{
		$option_name = "nafu_".$param;
		
		/* validation */
		if ($i++ ==1)  /* integers */
		{
			$newedit = intval( $_POST[$param]);
		}
		elseif ($i == 2) /* floating point */
		{
			$newedit = floatval($_POST[$param]);
		}
		else /* text fields */
		{
				$newedit = sanitize_text_field($_POST[$param]);
		}
		 
		if (!add_option($option_name, $newedit)) {update_option($option_name, $newedit); }	
	}
	
	wp_die(); // required to terminate immediately and return a proper response
}
 



/* ###################################################################### */
/* Custom slat fonts */
/* ###################################################################### */
 

function wpnafu_googlefonts_styles() {
    // Enqueue the font stylesheets like this:
    wp_enqueue_style( 'wpnafu-fonts-open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans' ); 
}  
add_action( 'wp_enqueue_scripts', 'wpnafu_googlefonts_styles' );
 

/* ###################################################################### */
/* Control Panel Includes and Excludes */
/* ###################################################################### */
 
add_action('admin_menu', 'wpnafu_menus', 998);

function wpnafu_menus()
 { 
	 // admin only
	 $role= 'manage_options'; // 'edit_others_posts';
		 
	add_menu_page('Rank Board', 'Rank Board',$role, 'wpnafu_menu_handle', 'wpnafu_instructions',' dashicons-editor-table');
	
	add_submenu_page( 'wpnafu_menu_handle', 'Instructions', 'Instructions', $role, 'wpnafu_menu_handle', 'wpnafu_instructions');
	
	add_submenu_page( 'wpnafu_menu_handle', 'Settings', 'Settings', $role, 'wpnafu_settings_handle', 'wpnafu_settings'); 
	
	$GLOBALS['slat_editor'] = add_submenu_page( 'wpnafu_menu_handle', 'Editor', 'Editor', $role, 'wpnafu_editor_handle', 'wpnafu_editor'); 
		 
}
	//------------------------------------------
	
	 

function wpnafu_instructions() {
	require(WPNAFU_DIRECTORY."inc/instructions.php");
}

function wpnafu_settings() {
	require(WPNAFU_DIRECTORY."inc/settings.php");
}

function wpnafu_editor() {
	require(WPNAFU_DIRECTORY."inc/editor.php");
}
 
/* ###################################################################### */
/* EDITOR FUNCTIONS  */
/* ###################################################################### */

function wpnafu_loadSettingRows()
{
	global $wpdb;
	$rcount=get_option("nafu_rowcount");
	$saveRows=get_option("nafu_saveRows");
	$saveClasses=get_option("nafu_saveClasses");
	$saveContents=get_option("nafu_saveContents");
	$itemcount=count($saveContents);  
	
	$o='<div id="nafu-editor">'."\n\r";
	$currow=0;  
	$slatnum=1;
	 //fill out rows with items in them from last edit 
	 
	if ($saveContents != false)
	{
		for ($i=0; $i<$itemcount; $i++)
		{
			// don't want to populate hidden rows
			$thisRow=min(intval($saveRows[$i]), $rcount); 
			$thisContent=stripslashes($saveContents[$i]);
			$thisClass=($saveClasses[$i]);
		
			if ($thisRow > $currow) // HTML break new row
			{
				if ($currow >0) // must end previous row
				{
					$o.="\r\n
					</ul>\r\n";
				}
				
				// begin new row
				$o.="\r\n". '
				<ul id="slatrow'.$thisRow.'"  class="nafu_row">'."\r\n";
			
				$currow=$thisRow;			
			}
			 
			
			// NOTE - we have to deal with QUOTES and APOS here!!!
			$o.='<li draggable="true" class="'.$thisClass.'" ondragenter="dragenter(event)" ondragstart="dragstart(event, \''.addslashes($thisContent).'\', \'li'.($slatnum++).'\')">'.$thisContent.'</li>'."\r\n";
		
		} // end for
		
		if ($currow >0) // must end previous row
		{
			// close off final row and table tag
			$o.="\r\n
			</ul>\r\n";
		}
	}
		
	 //------------------------------------------------------------------
	 // fill out the placeholder rows through row 5
	 	$currow++;
	 	
		for ($i=$currow; $i<=$rcount; $i++)
		{
			$o.="\r\n". '
			<ul draggable="true" id="slatrow'.$i.'" class="nafu_row" ondrop="slatrow_drop(event)" ondragover="allowDrop(event)">'."\r\n";
			$o.="\r\n
			</ul>\r\n";
		
		}
	
	 //------------------------------------------------------------------
	 // Trash row
	$o.='<ul draggable="true" id="slatbin" ondrop="slatbin_drop(event)" ondragover="allowDrop(event)"> 
</ul>'."\r\n";
	$o.="</div>\r\n";
	
 
	echo $o;

}


/* generate dropdown menu for Rowcount */
function wpnafu_loadSettingRowcount()
{
	global $wpdb;
	$x=get_option("nafu_rowcount");
	$o= '<select id="rowcount" onchange="reRow();">';
	for ($i=1; $i<6; $i++)
	{
		$o.='<option value="'.$i.'"';
		if ($i==$x) { $o.=" selected"; }
		$o.='>'.$i.'</option>'."\n\r";
	}
	$o.="</select>";
	echo $o;
}

/* generate dropdown menu for Slat Height */
function wpnafu_loadSettingHeight()
{
	global $wpdb;
	$x=get_option("nafu_slatheight");
	$o= '<select id="slatheight" >';
	for ($i=80; $i<=300; $i+=20)
	{
		$o.='<option value="'.$i.'"';
		if ($i==$x) { $o.=" selected"; }
		$o.='>'.$i.'</option>'."\n\r";
	}
	$o.="</select>";
	echo $o;
}

/* generate dropdown menu for Slat Width */
function wpnafu_loadSettingWidth()
{
	global $wpdb;
	$x=get_option("nafu_slatwidth");
	$o= '<select id="slatwidth" >';
	for ($i=16; $i<=36; $i++)
	{
		$o.='<option value="'.$i.'"';
		if ($i==$x) { $o.=" selected"; }
		$o.='>'.$i.'</option>'."\n\r";
	}
	$o.="</select>";
	echo $o;
}


/* generate dropdown menu for Slat Horizontal Margins */
/* only affects live , not editor */
function wpnafu_loadSettingSpacing()
{
	global $wpdb;
	$x=get_option("nafu_slatspacing");
	$o= '<select id="slatspacing" >';
	for ($i=0; $i<=25; $i++)
	{
		$o.='<option value="'.($i).'"';
		if ($i==$x) { $o.=" selected"; }
		$o.='>'.$i.'</option>'."\n\r";
	}
	$o.="</select>";
	echo $o;
}


/* generate dropdown menu for Tooltip */
function wpnafu_loadSettingFontsize()
{
	global $wpdb;
	$x=get_option("nafu_fontsize");
	$o= '<select id="fontsize" >';
	$olist=array("Enshrinken more", "Enshrinken", "Default (1.0em)", "Enbiggen", "Enbiggen more");
	$vlist=array(.6, .8, 1, 1.2, 1.4);
	$l=sizeof($olist);
	
	for ($i=0; $i<$l; $i++)
	{
		$oitem=$olist[$i];
		$vitem=$vlist[$i];
		$o.='<option value="'.$vitem.'"';
		if ($vitem==$x) { $o.=" selected"; }
		$o.='>'.$oitem.'</option>'."\n\r";
	}
	$o.="</select>";
	echo $o;
}


/* generate dropdown menu for Tooltip */
function wpnafu_loadSettingTooltip()
{
	global $wpdb;
	$x=get_option("nafu_showtooltip");
	$o= '<select id="showtooltip">';
	$olist=array("Yes", "No");
	foreach($olist as $oitem) 
	{
		$o.='<option value="'.$oitem.'"';
		if ($oitem==$x) { $o.=" selected"; }
		$o.='>'.$oitem.'</option>'."\n\r";
	}
	$o.="</select>";
	echo $o;
}


/* generate dropdown menu for Tooltip */
function wpnafu_loadSettingLayout()
{
	global $wpdb;
	$x=get_option("nafu_layouttype");
	$o= '<select id="layouttype">';
	$olist=array("Horizontal", "Vertical");
	foreach($olist as $oitem) 
	{
		$o.='<option value="'.$oitem.'"';
		if ($oitem==$x) { $o.=" selected"; }
		$o.='>'.$oitem.'</option>'."\n\r";
	}
	$o.="</select>";
	echo $o;
}

?>