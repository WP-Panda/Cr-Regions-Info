<?php
	/**
		*Plugin Name: Cr Regions Info
		*Plugin URI: http://mywordpress.ru/support/viewtopic.php?pid=129090#p129090
		*Description:  Плагин предназначен для вывода индивидуальной информации для разных регионов.
		*Version: 1.0.4
		*Author: Maksim (WP_Panda) Popov
		*Author URI: http://mywordpress.ru/support/profile.php?id=36230
		*License: A "Slug" license name e.g. GPL2
	**/
	
	/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)
		
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
	
	/*----------------------------------------------------------------------------*/
	/* setting constants
	/*----------------------------------------------------------------------------*/
	define('CR_REGIONS_DIR', plugin_dir_path(__FILE__));
	define('CR_REGIONS_URL', plugin_dir_url(__FILE__));
	
	/*----------------------------------------------------------------------------*/
	/* includes components
	/*----------------------------------------------------------------------------*/
	
	require_once('register-tax.php');
	require_once('shortcodes.php');
	require_once('BFI_Thumb.php');
	require_once('admin-menu.php');
	
	function cr_region_frontend() {
		
		wp_register_script( 'form-styler-script', CR_REGIONS_URL . 'assets/js/jquery.formstyler.min.js', array('jquery') , '1.4.9', true);
		wp_register_script( 'cr-main-front-js', CR_REGIONS_URL . 'assets/js/cr-frontend-main.js', array('jquery','form-styler-script') , '1.0.0', true);
		wp_register_style( 'form-styler-style', CR_REGIONS_URL . 'assets/css/jquery.formstyler.css', '', '1.4.9');
		wp_register_style( 'cr-region-frontend-style', CR_REGIONS_URL . 'assets/css/cr-region-frontend-style.css', '', '1.00');
		wp_enqueue_style('cr-region-frontend-style');
	}
	
	add_action( 'wp_enqueue_scripts', 'cr_region_frontend' );
	
	function cr_region_backend() {
		
		wp_register_style( 'cr-region-frontend-style', CR_REGIONS_URL . 'assets/css/cr-region-backend-style.css', '', '1.00');
		wp_enqueue_style('cr-region-frontend-style');
	}
	
	add_action( 'admin_enqueue_scripts', 'cr_region_backend' );
	
	/*----------------------------------------------------------------------------*/
	 /* add setting Page
	 /*----------------------------------------------------------------------------*/
	
	function plugin_add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=plugin_name">' . __( 'Settings','wp_panda' ) . '</a>';
		array_push( $links, $settings_link );
        return $links;
	}
	$plugin = plugin_basename( __FILE__ );
	add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );