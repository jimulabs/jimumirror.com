<?php
/*
Plugin Name: Contact Form Multi
Plugin URI: http://bestwebsoft.com/products/
Description: This plugin is an exclusive add-on to the Contact Form plugin by BestWebSoft.
Author: BestWebSoft
Version: 1.1.1
Author URI: http://bestwebsoft.com/
License: GPLv3 or later
*/
/*  
	@ Copyright 2015  BestWebSoft  ( http://support.bestwebsoft.com )

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

/*
** Function for adding menu and submenu
*/
if ( ! function_exists( 'cntctfrmmlt_admin_menu' ) ) {
	function cntctfrmmlt_admin_menu() {
		global $bstwbsftwppdtplgns_options, $bstwbsftwppdtplgns_added_menu;
		$bws_menu_info = get_plugin_data( plugin_dir_path( __FILE__ ) . "bws_menu/bws_menu.php" );
		$bws_menu_version = $bws_menu_info["Version"];
		$base = plugin_basename(__FILE__);

		if ( ! isset( $bstwbsftwppdtplgns_options ) ) {
			if ( is_multisite() ) {
				if ( ! get_site_option( 'bstwbsftwppdtplgns_options' ) )
					add_site_option( 'bstwbsftwppdtplgns_options', array() );
				$bstwbsftwppdtplgns_options = get_site_option( 'bstwbsftwppdtplgns_options' );
			} else {
				if ( ! get_option( 'bstwbsftwppdtplgns_options' ) )
					add_option( 'bstwbsftwppdtplgns_options', array() );
				$bstwbsftwppdtplgns_options = get_option( 'bstwbsftwppdtplgns_options' );
			}
		}

		if ( isset( $bstwbsftwppdtplgns_options['bws_menu_version'] ) ) {
			$bstwbsftwppdtplgns_options['bws_menu']['version'][ $base ] = $bws_menu_version;
			unset( $bstwbsftwppdtplgns_options['bws_menu_version'] );
			if ( is_multisite() )
				update_site_option( 'bstwbsftwppdtplgns_options', $bstwbsftwppdtplgns_options );
			else
				update_option( 'bstwbsftwppdtplgns_options', $bstwbsftwppdtplgns_options );
			require_once( dirname( __FILE__ ) . '/bws_menu/bws_menu.php' );
		} else if ( ! isset( $bstwbsftwppdtplgns_options['bws_menu']['version'][ $base ] ) || $bstwbsftwppdtplgns_options['bws_menu']['version'][ $base ] < $bws_menu_version ) {
			$bstwbsftwppdtplgns_options['bws_menu']['version'][ $base ] = $bws_menu_version;
			if ( is_multisite() )
				update_site_option( 'bstwbsftwppdtplgns_options', $bstwbsftwppdtplgns_options );
			else
				update_option( 'bstwbsftwppdtplgns_options', $bstwbsftwppdtplgns_options );
			require_once( dirname( __FILE__ ) . '/bws_menu/bws_menu.php' );
		} else if ( ! isset( $bstwbsftwppdtplgns_added_menu ) ) {
			$plugin_with_newer_menu = $base;
			foreach ( $bstwbsftwppdtplgns_options['bws_menu']['version'] as $key => $value ) {
				if ( $bws_menu_version < $value && is_plugin_active( $base ) ) {
					$plugin_with_newer_menu = $key;
				}
			}
			$plugin_with_newer_menu = explode( '/', $plugin_with_newer_menu );
			$wp_content_dir = defined( 'WP_CONTENT_DIR' ) ? basename( WP_CONTENT_DIR ) : 'wp-content';
			if ( file_exists( ABSPATH . $wp_content_dir . '/plugins/' . $plugin_with_newer_menu[0] . '/bws_menu/bws_menu.php' ) )
				require_once( ABSPATH . $wp_content_dir . '/plugins/' . $plugin_with_newer_menu[0] . '/bws_menu/bws_menu.php' );
			else
				require_once( dirname( __FILE__ ) . '/bws_menu/bws_menu.php' );	
			$bstwbsftwppdtplgns_added_menu = true;
		}

		add_menu_page( 'BWS Plugins', 'BWS Plugins', 'manage_options', 'bws_plugins', 'bws_add_menu_render', plugins_url( "images/px.png", __FILE__ ), 1001 ); 
	}
}

/*Function for connecting hooks-(init, admin_init)*/
if ( ! function_exists( 'cntctfrmmlt_init' ) ) {
	function cntctfrmmlt_init() {
		/* Function check if plugin is compatible with current WP version  */
		cntctfrmmlt_version_check();
	}
}

/*Function for connecting hooks-(init, admin_init)*/
if ( ! function_exists( 'cntctfrmmlt_admin_init' ) ) {
	function cntctfrmmlt_admin_init() {
		global $bws_plugin_info, $cntctfrmmlt_plugin_info;
		/* add language files. */
		load_plugin_textdomain( 'contact-form-multi', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 

		if ( ! $cntctfrmmlt_plugin_info )
			$cntctfrmmlt_plugin_info = get_plugin_data( __FILE__ );

		/* Add variable for bws_menu */
		if ( ! isset( $bws_plugin_info ) || empty( $bws_plugin_info ) )
			$bws_plugin_info = array( 'id' => '123', 'version' => $cntctfrmmlt_plugin_info["Version"] );


		/* check for installed and activated Contact Form*/
		cntctfrmmlt_check();

		if ( isset( $_REQUEST['page'] ) && ( $_REQUEST['page'] == 'contact_form.php' || $_REQUEST['page'] == 'contact_form_pro.php' || $_REQUEST['page'] == 'contact_form_pro_extra.php' ) ) {
			/*register defaults settings function*/
			cntctfrmmlt_settings_defaults();
			/*register main options function*/
			cntctfrmmlt_main_options();	
		}
	}
}

if ( ! function_exists( 'cntctfrmmlt_settings_defaults' ) ) {
	function cntctfrmmlt_settings_defaults() {
		global $cntctfrmmlt_options, $cntctfrmmlt_plugin_info, $cntctfrmmlt_options_main;

		/* Install the option defaults */
		$cntctfrmmlt_options_main = array(
			'plugin_option_version' => $cntctfrmmlt_plugin_info["Version"],
			'name_id_form'	=> array( 1 => 'NEW_FORM' ),
			'next_id_form'	=> 2,
			'id_form'		=> 1
		);
		/*add options to database*/
		if ( ! get_option( 'cntctfrmmlt_options_main' ) )
			add_option( 'cntctfrmmlt_options_main', $cntctfrmmlt_options_main, '', 'yes' );	

		/* Get options from the database */
		$cntctfrmmlt_options = get_option( 'cntctfrmmlt_options_main' );

		if ( ! isset( $cntctfrmmlt_options['plugin_option_version'] ) || $cntctfrmmlt_options['plugin_option_version'] != $cntctfrmmlt_plugin_info["Version"] ) {
			$cntctfrmmlt_options = array_merge( $cntctfrmmlt_options_main, $cntctfrmmlt_options );
			$cntctfrmmlt_options['plugin_option_version'] = $cntctfrmmlt_plugin_info["Version"];
			update_option( 'cntctfrmmlt_options_main', $cntctfrmmlt_options );
		}
	}
}

/* ads feature the main options */
if ( ! function_exists( 'cntctfrmmlt_main_options' ) ) {
	function cntctfrmmlt_main_options() {
		global $cntctfrmmlt_counts, $cntctfrmmlt_id_form, $key, $cntctfrmmlt_keys, $cntctfrmmlt_last_key, $cntctfrmmlt_options_main, $value;
		$cntctfrmmlt_options_main = get_option( 'cntctfrmmlt_options_main' );
		if ( ! isset( $_GET['id'] ) ) 
			$_SESSION['cntctfrmmlt_id_form'] = $cntctfrmmlt_options_main['id_form'];
		
		/*Update cntctfrmmlt_id_options in a database*/
		if ( isset( $_GET['id'] ) )
			$_SESSION['cntctfrmmlt_id_form'] = $_GET['id'];
		
		$cntctfrmmlt_options_main['id_form'] = $_SESSION['cntctfrmmlt_id_form'];
		update_option( 'cntctfrmmlt_options_main', $cntctfrmmlt_options_main, '', 'yes' );
		
		/*Deleting data from the database after pressing the delete*/
		if ( isset( $_GET['del'] ) ) {

			/*Remove the contact form from the database*/
			$cntctfrmmlt_args = 'cntctfrmmlt_options_'. $_GET['id'];
			delete_option( $cntctfrmmlt_args );
			/*Remove the contact form from the database*/

			/*remove values from a name_id_form*/
			$cntctfrmmlt_counts = $cntctfrmmlt_options_main['name_id_form'];
			unset( $cntctfrmmlt_counts[$cntctfrmmlt_options_main['id_form']] );
			$cntctfrmmlt_options_main['name_id_form'] = $cntctfrmmlt_counts;
			/*remove values from a name_id_form*/

			$cntctfrmmlt_keys = array_keys( $cntctfrmmlt_options_main['name_id_form'] );
			$cntctfrmmlt_last_key = end( $cntctfrmmlt_keys );
			$cntctfrmmlt_options_main['id_form'] = $cntctfrmmlt_last_key;
			update_option( 'cntctfrmmlt_options_main', $cntctfrmmlt_options_main, '', 'yes' );
			$_SESSION['cntctfrmmlt_id_form'] = $cntctfrmmlt_last_key;
			if ( empty( $cntctfrmmlt_options_main['name_id_form'] ) ) {
				$cntctfrmmlt_options_main['id_form'] = 1;
				$cntctfrmmlt_options_main['name_id_form'] = array( 1 => 'NEW_FORM' );
				$cntctfrmmlt_options_main['next_id_form'] = 2;
				update_option( 'cntctfrmmlt_options_main', $cntctfrmmlt_options_main, '', 'yes' );
				$_SESSION['cntctfrmmlt_id_form'] = 1;
			}
		}
	}
}

/*function check if plugin is compatible with current WP version*/  
if ( ! function_exists ( 'cntctfrmmlt_version_check' ) ) {
	function cntctfrmmlt_version_check() {
		global $wp_version, $cntctfrmmlt_plugin_info;
		$require_wp		=	"3.1"; /* Wordpress at least requires version */
		$plugin			=	plugin_basename( __FILE__ );
	 	if ( version_compare( $wp_version, $require_wp, "<" ) ) {
	 		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
				$admin_url = ( function_exists( 'get_admin_url' ) ) ? get_admin_url( null, 'plugins.php' ) : esc_url( '/wp-admin/plugins.php' );
				if ( ! $cntctfrmmlt_plugin_info )
					$cntctfrmmlt_plugin_info = get_plugin_data( __FILE__, false );
				wp_die( "<strong>" . $cntctfrmmlt_plugin_info['Name'] . " </strong> " . __( 'requires', 'contact-form-multi' ) . " <strong>WordPress " . $require_wp . "</strong> " . __( 'or higher, that is why it has been deactivated! Please upgrade WordPress and try again.', 'contact-form-multi') . "<br /><br />" . __( 'Back to the WordPress', 'contact-form-multi') . " <a href='" . $admin_url . "'>" . __( 'Plugins page', 'contact-form-multi') . "</a>." );
			}
		}
	}
}

/* Function creates other links on admin page. */
if ( ! function_exists ( 'cntctfrmmlt_plugin_links' ) ) {
	function cntctfrmmlt_plugin_links( $links, $file ) {
		$base = plugin_basename(__FILE__);
		if ( $file == $base ) {
			$links[] = '<a href="http://wordpress.org/plugins/contact-form-multi/faq/" target="_blank">' . __( 'FAQ','contact-form-multi' ) . '</a>';
			$links[] = '<a href="http://support.bestwebsoft.com">' . __( 'Support','contact-form-multi' ) . '</a>';
		}
		return $links;
	}
}

/*Update array cntctfrmmlt_options_main in a database*/
if ( ! function_exists ( 'cntctfrmmlt_action_callback' ) ) {
	function cntctfrmmlt_action_callback() {
		global $cntctfrmmlt_counts, $cntctfrmmlt_j, $cntctfrmmlt_key_form, $cntctfrmmlt_value, $cntctfrmmlt_id_key, $cntctfrmmlt_options_main;
		check_ajax_referer( plugin_basename( __FILE__ ), 'cntctfrmmlt_ajax_nonce_field' );
		$cntctfrmmlt_options_main = get_option( 'cntctfrmmlt_options_main' );
		/*update next_id_form, cntctfrmmlt_id_options*/
		if ( isset( $_POST['cntctfrmmlt_key_form'] ) ) {
			$cntctfrmmlt_id_key = $_POST['cntctfrmmlt_key_form'];
			$cntctfrmmlt_id_key += 1;
			$cntctfrmmlt_options_main['next_id_form'] = $cntctfrmmlt_id_key;
			$cntctfrmmlt_options_main['id_form'] = $_POST['cntctfrmmlt_key_form'];
			$_SESSION['cntctfrmmlt_id_form'] = $_POST['cntctfrmmlt_key_form'];
		}
		/*Update name and ID, options*/
		if ( isset( $_POST['cntctfrmmlt_name_form'] ) ) {
			foreach( $_POST['cntctfrmmlt_name_form'] as $cntctfrmmlt_j ){
				list( $key, $cntctfrmmlt_value ) = explode( ':', $cntctfrmmlt_j );
				$cntctfrmmlt_counts[$key] = strip_tags( stripslashes( $cntctfrmmlt_value ) );
				$cntctfrmmlt_options_main['name_id_form'] = $cntctfrmmlt_counts;
			}
		}
		update_option( 'cntctfrmmlt_options_main', $cntctfrmmlt_options_main, '', 'yes' );
		exit;
	}
}

/*Function to add stylesheets and scripts for admin bar*/
if ( ! function_exists ( 'cntctfrmmlt_scripts' ) ) {
	function cntctfrmmlt_scripts() {
		if ( isset( $_REQUEST['page'] ) && ( $_REQUEST['page'] == 'contact_form.php' || $_REQUEST['page'] == 'contact_form_pro.php' ||  $_REQUEST['page'] == 'contact_form_pro_extra.php' ) ) {
			global $wp_version;
			if ( 3.8 > $wp_version )
				wp_enqueue_style( 'cntctfrmml_stylesheet', plugins_url( 'css/style_wp_before_3.8.css', __FILE__ ) );
			else
				wp_enqueue_style( 'cntctfrmml_stylesheet', plugins_url( 'css/style.css', __FILE__ ) );
			
			wp_enqueue_script( 'cntctfrmmlt_script', plugins_url( 'js/script.js', __FILE__ ) );

			/* script vars */
			$cntctfrmmlt_options_main = get_option( 'cntctfrmmlt_options_main' );
			$site_url_if_multisite = is_multisite() ? site_url() : '';

			$cntctfrmmlt_count = array();
			if ( $cntctfrmmlt_options_main ) {
				foreach ( $cntctfrmmlt_options_main['name_id_form'] as $key => $value ) {
					$cntctfrmmlt_count[ $key ] = $value;
				}
			}

			$script_vars = array(
				'cntctfrmmlt_nonce' 			=> wp_create_nonce( plugin_basename( __FILE__ ), 'cntctfrmmlt_ajax_nonce_field' ),
				'cntctfrmmlt_delete_message' 	=>  __( 'Are you sure you want to delete the form?', 'contact-form-multi' ),
				'cntctfrmmlt_id_form' 			=> $cntctfrmmlt_options_main['id_form'],
				'cntctfrmmlt_location'			=> $site_url_if_multisite . $_SERVER['PHP_SELF'] . ( is_plugin_active( 'contact-form-plugin/contact_form.php' ) ? '?page=contact_form.php' : '?page=contact_form_pro.php' ),
				'cntctfrmmlt_action_slug'		=> ( isset( $_GET['action'] ) ? '&action=' . $_GET['action'] : '' ),
				'cntctfrmmlt_key_id' 			=> $cntctfrmmlt_options_main['next_id_form'],
				'cntctfrmmlt_count'				=> $cntctfrmmlt_count,
			);
			wp_localize_script( 'cntctfrmmlt_script', 'cntctfrmmlt_script_vars', $script_vars );
		}
	}
}

/* Сhecking for the existence of Contact Form Plugin or Contact Form Pro Plugin */
if ( ! function_exists( 'cntctfrmmlt_check' ) ) {
	function cntctfrmmlt_check() {
		global $cntctfrmmlt_contact_form_not_found, $cntctfrmmlt_contact_form_not_active;
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		
		$all_plugins = get_plugins();

		if ( ! ( array_key_exists( 'contact-form-plugin/contact_form.php', $all_plugins ) || array_key_exists( 'contact-form-pro/contact_form_pro.php', $all_plugins ) ) ) {
			$cntctfrmmlt_contact_form_not_found = __( 'Contact Form Plugin has not been found.</br>You should install and activate this plugin for the correct work with Contact Form Multi plugin.</br>You can download Contact Form Plugin from', 'contact-form-multi' ) . ' <a href="' . esc_url( 'http://bestwebsoft.com/products/contact-form/' ) . '" title="' . __( 'Developers website', 'contact-form-multi' ). '"target="_blank">' . __( 'website of plugin Authors', 'contact-form-multi' ) . '</a> ' . __( 'or', 'contact-form-multi' ) . ' <a href="' . esc_url( 'http://wordpress.org' ) .'" title="Wordpress" target="_blank">'. __( 'Wordpress.', 'contact-form-multi' ) . '</a>';
		} else {
			if ( ! ( is_plugin_active( 'contact-form-plugin/contact_form.php' ) || is_plugin_active( 'contact-form-pro/contact_form_pro.php' ) ) ) {
				$cntctfrmmlt_contact_form_not_active = __( 'Contact Form Plugin is not active.</br>You should activate this plugin for the correct work with Contact Form Multi plugin.', 'contact-form-multi' );
			}
			/* old version */
			if ( ( is_plugin_active( 'contact-form-plugin/contact_form.php' ) && isset( $all_plugins['contact-form-plugin/contact_form.php']['Version'] ) && $all_plugins['contact-form-plugin/contact_form.php']['Version'] < '3.74' ) || 
				( is_plugin_active( 'contact-form-pro/contact_form_pro.php' ) && isset( $all_plugins['contact-form-pro/contact_form_pro.php']['Version'] ) && $all_plugins['contact-form-pro/contact_form_pro.php']['Version'] < '1.23' ) ) {
				$cntctfrmmlt_contact_form_not_found = __( 'Contact Form Plugin has old version.</br>You need to update this plugin for correct work with Contact Form Multi plugin.', 'contact-form-multi' );
			}
		}
	}
}

/*Add notises on plugins page if Contact Form plugin is not installed or not active*/
if ( ! function_exists( 'cntctfrmmlt_show_notices' ) ) {
	function cntctfrmmlt_show_notices() { 
		global $hook_suffix, $cntctfrmmlt_contact_form_not_found, $cntctfrmmlt_contact_form_not_active;
		if ( $hook_suffix == 'plugins.php' || ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'bws_plugins' ) || ( isset( $_REQUEST['page'] ) && ( $_REQUEST['page'] == 'contact_form.php' || $_REQUEST['page'] == 'contact_form_pro.php' ) ) ) {
			if ( '' != $cntctfrmmlt_contact_form_not_found || '' != $cntctfrmmlt_contact_form_not_active ) { ?>
				<div class="error">
					<p><strong><?php _e( 'WARNING:', 'contact-form-multi' ); ?></strong> <?php echo $cntctfrmmlt_contact_form_not_found . $cntctfrmmlt_contact_form_not_active; ?></p>
				</div>
			<?php } ?>
			<noscript>
				<div class="error">
					<p><?php _e( 'Please enable JavaScript in your browser!', 'contact-form-multi'); ?></p>
				</div>
			</noscript>
		<?php } 
	}
}

if ( ! function_exists ( 'cntctfrmmlt_plugin_banner' ) ) {
	function cntctfrmmlt_plugin_banner() {
		global $hook_suffix;
		if ( 'plugins.php' == $hook_suffix ) {   
			global $cntctfrmmlt_plugin_info, $bstwbsftwppdtplgns_cookie_add;

			$banner_array = array(
				array( 'gglnltcs_hide_banner_on_plugin_page', 'bws-google-analytics/bws-google-analytics.php', '1.6.2' ),
				array( 'htccss_hide_banner_on_plugin_page', 'htaccess/htaccess.php', '1.6.3' ),
				array( 'sbscrbr_hide_banner_on_plugin_page', 'subscriber/subscriber.php', '1.1.8' ),
				array( 'lmtttmpts_hide_banner_on_plugin_page', 'limit-attempts/limit-attempts.php', '1.0.2' ),
				array( 'sndr_hide_banner_on_plugin_page', 'sender/sender.php', '0.5' ),
				array( 'srrl_hide_banner_on_plugin_page', 'user-role/user-role.php', '1.4' ),
				array( 'pdtr_hide_banner_on_plugin_page', 'updater/updater.php', '1.12' ),
				array( 'cntctfrmtdb_hide_banner_on_plugin_page', 'contact-form-to-db/contact_form_to_db.php', '1.2' ),
				array( 'cntctfrmmlt_hide_banner_on_plugin_page', 'contact-form-multi/contact-form-multi.php', '1.0.7' ),
				array( 'gglmps_hide_banner_on_plugin_page', 'bws-google-maps/bws-google-maps.php', '1.2' ),
				array( 'fcbkbttn_hide_banner_on_plugin_page', 'facebook-button-plugin/facebook-button-plugin.php', '2.29' ),
				array( 'twttr_hide_banner_on_plugin_page', 'twitter-plugin/twitter.php', '2.34' ),
				array( 'pdfprnt_hide_banner_on_plugin_page', 'pdf-print/pdf-print.php', '1.7.1' ),
				array( 'gglplsn_hide_banner_on_plugin_page', 'google-one/google-plus-one.php', '1.1.4' ),
				array( 'gglstmp_hide_banner_on_plugin_page', 'google-sitemap-plugin/google-sitemap-plugin.php', '2.8.4' ),
				array( 'cntctfrmpr_for_ctfrmtdb_hide_banner_on_plugin_page', 'contact-form-pro/contact_form_pro.php', '1.14' ),
				array( 'cntctfrm_for_ctfrmtdb_hide_banner_on_plugin_page', 'contact-form-plugin/contact_form.php', '3.62' ),
				array( 'cntctfrm_hide_banner_on_plugin_page', 'contact-form-plugin/contact_form.php', '3.47' ),
				array( 'cptch_hide_banner_on_plugin_page', 'captcha/captcha.php', '3.8.4' ),
				array( 'gllr_hide_banner_on_plugin_page', 'gallery-plugin/gallery-plugin.php', '3.9.1' )
			);
			if ( ! function_exists( 'get_plugins' ) )
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if ( ! $cntctfrmmlt_plugin_info )
				$cntctfrmmlt_plugin_info = get_plugin_data( __FILE__ );

			$all_plugins = get_plugins();
			$this_banner = 'cntctfrmmlt_hide_banner_on_plugin_page';
			foreach ( $banner_array as $key => $value ) {
				if ( $this_banner == $value[0] ) {
					if ( ! isset( $bstwbsftwppdtplgns_cookie_add ) ) {
						echo '<script type="text/javascript" src="' . plugins_url( 'js/c_o_o_k_i_e.js', __FILE__ ) . '"></script>';
						$bstwbsftwppdtplgns_cookie_add = true;
					}
					if ( is_plugin_active( 'contact-form-pro/contact_form_pro.php' ) ) {
						global $wp_version; ?>
						<script type="text/javascript">
							(function($) {
								$(document).ready( function() {
									var hide_message = $.cookie( "cntctfrmmlt_hide_banner_on_plugin_page" );
									if ( hide_message == "true") {
										$( ".cntctfrmmlt_message" ).css( "display", "none" );
									} else {
										$( ".cntctfrmmlt_message" ).css( "display", "block" );
									}
									$( ".cntctfrmmlt_close_icon" ).click( function() {
										$( ".cntctfrmmlt_message" ).css( "display", "none" );
										$.cookie( "cntctfrmmlt_hide_banner_on_plugin_page", "true", { expires: 32 } );
									});	
								});
							})(jQuery);
						</script>
						<div class="updated" style="padding: 0; margin: 0; border: none; background: none;">
							<div class="cntctfrmmlt_message bws_banner_on_plugin_page" style="display: none;">
								<img class="cntctfrmmlt_close_icon close_icon" title="" src="<?php echo plugins_url( 'images/close_banner.png', __FILE__ ); ?>" alt=""/>
								<div class="button_div">
									<a class="button" target="_blank" href="http://bestwebsoft.com/products/contact-form-multi/?k=93536843024dbb3360bfa9d6d6a1d297&pn=123&v=<?php echo $cntctfrmmlt_plugin_info["Version"]; ?>&wp_v=<?php echo $wp_version; ?>"><?php _e( 'Learn More', 'cntctfrmmlt' ); ?></a>
								</div>
								<div class="text">
									<?php _e( "It's time to upgrade your <strong>Contact Form Multi plugin</strong> to <strong>PRO</strong> version", 'cntctfrmmlt' ); ?>!<br />
									<span><?php _e( 'Extend standard plugin functionality with new great options', 'cntctfrmmlt' ); ?></span>
								</div> 
								<div class="icon">
									<img title="" src="<?php echo plugins_url( 'images/banner.png', __FILE__ ); ?>" alt=""/>
								</div>
							</div>
						</div>
						<?php break;
					} else { ?>
						<script type="text/javascript">
							(function($) {
								$(document).ready( function() {
									$.cookie( "cntctfrmmlt_hide_banner_on_plugin_page", "temporarily", { expires: 32 } );
								});
							})(jQuery);
						</script>
					<?php }
				}
				if ( isset( $all_plugins[ $value[1] ] ) && $all_plugins[ $value[1] ]["Version"] >= $value[2] && is_plugin_active( $value[1] ) && ! isset( $_COOKIE[ $value[0] ] ) ) {
					break;
				}
			}
		}
	}
}

/*Function for delete options*/
if ( ! function_exists ( 'cntctfrmmlt_delete' ) ) {
	function cntctfrmmlt_delete() {
		$cntctfrmmlt_options_main = get_option( 'cntctfrmmlt_options_main' );
		if ( ! is_multisite() ) {
			foreach ( $cntctfrmmlt_options_main['name_id_form'] as $key => $value ) {
				delete_option( 'cntctfrmmlt_options_' . $key );
			}
			delete_option( 'cntctfrmmlt_options_main' );
			delete_option( 'cntctfrmmlt_options' );
		} else {
			global $wpdb;
			$cntctfrmmlt_blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
			$cntctfrmmlt_original_blog_id = get_current_blog_id();
			foreach ( $cntctfrmmlt_blog_ids as $cntctfrmmlt_blog_id ) {
				switch_to_blog( $cntctfrmmlt_blog_id );
				foreach ( $cntctfrmmlt_options_main['name_id_form'] as $key=>$value ) {
					delete_option( 'cntctfrmmlt_options_'.$key );
				}
				delete_option( 'cntctfrmmlt_options_main' );
				delete_option( 'cntctfrmmlt_options' );
			}
			switch_to_blog( $cntctfrmmlt_original_blog_id );
		}
	}
}

/* hook for add menu */
add_action( 'admin_menu', 'cntctfrmmlt_admin_menu' );
/* Hook calls functions for init and admin_init hooks */
add_action( 'init', 'cntctfrmmlt_init' );
add_action( 'admin_init', 'cntctfrmmlt_admin_init' );
/* hook for adding scripts and styles */
add_action( 'admin_enqueue_scripts', 'cntctfrmmlt_scripts' );
/* Additional links on the plugin page*/
add_filter( 'plugin_row_meta', 'cntctfrmmlt_plugin_links', 10, 2 );
/* check for installed and activated Contact Form plugin */
add_action( 'admin_notices', 'cntctfrmmlt_show_notices' );
/* hooks for ajax */
add_action( 'wp_ajax_cntctfrmmlt_action', 'cntctfrmmlt_action_callback' );
add_action( 'admin_notices', 'cntctfrmmlt_plugin_banner' );
/*uninstal hook*/
register_uninstall_hook( __FILE__, 'cntctfrmmlt_delete' );
?>