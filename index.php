<?php

/*
 * Plugin Name: KGR ELOT 743
 * Plugin URI:  https://github.com/constracti/wp-elot743
 * Description: Convert greek titles to greeklish slugs according to ELOT 743.
 * Author:      constracti
 * Author URI:  https://github.com/constracti
 * Version:     1.0
 * Licence:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( !defined( 'ABSPATH' ) )
	exit;

define( 'KGR_ELOT743_DIR', plugin_dir_path( __FILE__ ) );

require_once( KGR_ELOT743_DIR . 'elot743.php' );

add_filter( 'sanitize_title', function( $title, $raw_title, $context ) {
	if ( $context === 'save' ) {
		$title = kgr_elot743( $raw_title );
		$title = remove_accents( $title );
	}
	return $title;
}, 5, 3 );
