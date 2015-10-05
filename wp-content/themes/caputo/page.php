<?php
/**
 * Genesis Framework.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

//* This file handles pages, but only exists for the sake of child theme forward compatibility.


add_action( 'genesis_after_header', 'after_nav_image' );
function after_nav_image() {
	if ( is_active_sidebar( 'after-nav' ) ) {
		echo '<div id="after-nav">';
		dynamic_sidebar( 'after-nav' );
		echo '</div><!-- end #after-nav -->';
	}
}

add_action( 'genesis_sidebar', 'page_sidebar' );
function page_sidebar() {
	if ( is_active_sidebar( 'page-sidebar' ) ) {
		echo '<aside id="page-sidebar" class="sidebar">';
		dynamic_sidebar( 'page-sidebar' );
		echo '</aside><!-- end #page-sidebar -->';
	}
}

//* Remove the Default or Primary Sidebar on Pages
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

genesis();
