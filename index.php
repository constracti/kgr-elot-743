<?php

/*
 * Plugin Name: KGR ELOT 743
 * Plugin URI: https://github.com/constracti/kgr-elot-743
 * Description: Convert greek titles to greeklish slugs according to ELOT 743.
 * Version: 1.1
 * Requires at least: 2.8.0
 * Requires PHP: 7.0
 * Author: constracti
 * Author URI: https://github.com/constracti
 * Licence: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( !defined( 'ABSPATH' ) )
	exit;

define( 'KGR_ELOT_743_DIR', plugin_dir_path( __FILE__ ) );
define( 'KGR_ELOT_743_URL', plugin_dir_url( __FILE__ ) );

require_once( KGR_ELOT_743_DIR . 'elot743.php' );

add_filter( 'sanitize_title', function( string $title, string $raw_title, string $context ): string {
	if ( $context === 'save' ) {
		$title = kgr_elot_743( $raw_title );
		$title = remove_accents( $title );
	}
	return $title;
}, 5, 3 );
