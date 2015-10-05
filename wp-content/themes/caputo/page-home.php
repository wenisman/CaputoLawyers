<?php
/*
Template Name: Home Page
*/

remove_action('genesis_post_title','genesis_do_post_title');

add_action( 'genesis_after_header', 'caputo_slider' );
function caputo_slider() {
	if ( is_active_sidebar( 'home-slider' ) ) {
		echo '<div id="home-slider">';
		dynamic_sidebar( 'home-slider' );
		echo '</div><!-- end #home-slider -->';
	}
}

add_action( 'genesis_before_content_sidebar_wrap', 'caputo_home_features' );

function caputo_home_features() {
	echo '<div id="home-features" class="content-sidebar-wrap">';

	if ( is_active_sidebar( 'home-featured-1' ) ) {
		echo '<div id="home-featured-1" class="first one-third">';
		dynamic_sidebar( 'home-featured-1' );
		echo '</div><!-- end #home-featured-1 -->';
	}

	if ( is_active_sidebar( 'home-featured-2' ) ) {
		echo '<div id="home-featured-2" class="one-third">';
		dynamic_sidebar( 'home-featured-2' );
		echo '</div><!-- end #home-featured-2 -->';
	}

	if ( is_active_sidebar( 'home-featured-3' ) ) {
		echo '<div id="home-featured-3" class="one-third">';
		dynamic_sidebar( 'home-featured-3' );
		echo '</div><!-- end #home-featured-3 -->';
	}

	echo '</div><!-- end #home-features -->';
}


genesis();