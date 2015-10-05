<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.0.1' );

//* Enqueue Lato & Gudea Google font
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'google-font-gudea', '//fonts.googleapis.com/css?family=Gudea:400,700', array(), CHILD_THEME_VERSION );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Load custom favicon to header 
add_filter( 'genesis_pre_load_favicon', 'custom_favicon_filter' );
	function custom_favicon_filter( $favicon_url ) {
	return get_stylesheet_directory_uri() . '/images/favicon.ico';
}

//* Transfer navigation inside header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_header', 'genesis_do_nav' );

/** Remove Title & Description */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

function seo_site_title() { ?>
<p itemprop="headline" class="site-title">
	<a href="<?php bloginfo('url'); ?>">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Caputo Property Lawyers Sydney">
	</a>
</p>

<?php }

add_action( 'genesis_site_title', 'seo_site_title' );

//* Add support for custom background
//add_theme_support( 'custom-background' ); 

//* Add support for 3-column footer widgets
//add_theme_support( 'genesis-footer-widgets', 3 );

//* Remove secondary sidebar
unregister_sidebar( 'sidebar-alt' );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'after-nav',
	'name'			=> __( 'After Nav Sidebar' ),
	'description'	=> __( 'This is the after navigation seen on page section.' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'page-sidebar',
	'name'			=> __( 'Page Sidebar' ),
	'description'	=> __( 'This is the page sidebar section.' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-slider',
	'name'			=> __( 'Home Slider' ),
	'description'	=> __( 'This is the home slider section.' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-1',
	'name'			=> __( 'Home Featured 1' ),
	'description'	=> __( 'This is the home featured 1 section.' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-2',
	'name'			=> __( 'Home Featured 2' ),
	'description'	=> __( 'This is the home featured 2 section.' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-3',
	'name'			=> __( 'Home Featured 3' ),
	'description'	=> __( 'This is the home featured 3 section.' ),
) );

//* Custom Footer 
add_filter( 'genesis_footer_output', 'child_output_filter', 10, 3 );
function child_output_filter( $backtotop_text, $creds_text ) {
	$creds_text = 'Copyright [footer_copyright] <a href="">Caputo Lawyers</a>. All Rights Reserved';
	$creds_nav = wp_nav_menu( array( 'menu' => 'Footer Nav' ));
	return '<div class="padd">' . $creds_p_add . '</div>' . '<div class="credits">' . $creds_text . '</div>' . '<div>' . $creds_nav . '</div>';

}

add_action('genesis_after_loop', 'disclaimer_after_loop');
function disclaimer_after_loop(){
	if(is_home() || is_page_template('page_blog.php') || is_singular('post') ){ ?>
	<div><p style="font-size:12px; color:#828282;"><b>Disclaimer:</b> The information provided on this website is for information purposes only and Caputo Lawyers gives no warranty, express or implied, regarding same.  Any legal information published on this website is for general guidance, interest and information purposes only and should not be construed as legal, or other professional, advice.  If you have any specific questions regarding information published on this website then you should consult this office.  The transmission of material published on this website should not be interpreted as the creation of a solicitor-client relationship between Caputo Lawyers and the receiver of the information.</p></div>
<?php	}
}


/* Grid Overrides */
add_filter('genesis_attr_content', 'add_content_class');
function add_content_class($attributes) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' first two-thirds';
	 
	// return the attributes
	return $attributes;
}

add_filter('genesis_attr_sidebar-primary', 'add_sidebar_primary_class');
function add_sidebar_primary_class($attributes) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' one-third';
	 
	// return the attributes
	return $attributes;
}

add_action( 'wp_enqueue_scripts', 'prefix_enqueue_scripts' );
function prefix_enqueue_scripts() {
	wp_enqueue_script( 'responsive-menu-js', get_stylesheet_directory_uri() . '/lib/js/slicknav.js', array( 'jquery' ), '1.0.0', true ); // Change 'prefix' to your theme's prefix
	wp_enqueue_style( 'responsive-menu-css', get_stylesheet_directory_uri() . '/lib/css/slicknav.css' );
}

//Responsive Nav
function themeprefix_responsive_menujs() {
	echo 	"<script>
			jQuery(function($) {
			$('#menu-mainmenu').slicknav();
			});
			</script>";
}
add_action ('genesis_after','themeprefix_responsive_menujs');
