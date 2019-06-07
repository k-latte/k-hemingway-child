<?php
/**
 * How to's:
 * https://developer.wordpress.org/themes/advanced-topics/child-themes/#3-enqueue-stylesheet
 * https://digwp.com/2016/01/include-styles-child-theme/
 */


if ( ! function_exists( 'hemingway_load_style' ) ) {

	function hemingway_load_style() {
		if ( ! is_admin() ) {

			$dependencies = array();

			/**
			 * Translators: If there are characters in your language that are not
			 * supported by the theme fonts, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$google_fonts = _x( 'on', 'Google Fonts: on or off', 'hemingway' );

			if ( 'off' !== $google_fonts ) {
				$font_families = array();

				$font_families[] = 'Lato:400,700,400italic,700italic|Raleway:700,400';

				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) )
				);

				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

				wp_register_style( 'hemingway_googleFonts', $fonts_url, array(), null );

				$dependencies[] = 'hemingway_googleFonts';
			}

			wp_enqueue_style( 'hemingway_style', get_template_directory_uri() . '/style.css', $dependencies, wp_get_theme( 'hemingway' )->get( 'Version' ) );

		}
	}
	add_action( 'wp_enqueue_scripts', 'hemingway_load_style' );

}


function kchild_enqueue_styles() {
	$parent_style = 'parent-style'; // This is the 'hemingway' theme.
	wp_enqueue_style( $parent_style,
		get_template_directory_uri() . '/style.css',
		null,
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}

/**
 * Enqueue parent theme stylesheet, and stylesheet for this child theme.
 */
add_action( 'wp_enqueue_scripts', 'kchild_enqueue_styles' );


/**
 * Sticky-on-scroll navigation bar
 */
function sticky_on_scroll_nav() {
    wp_enqueue_script(
        'sticky-on-scroll-nav', //name your script so that you can attach other scripts, de-register, etc.
        get_stylesheet_directory_uri() . '/js/sticky-on-scroll-nav.js',
        array('jquery') // this array lists the scripts upon which your script depends
    );
}
add_action( 'wp_enqueue_scripts', 'sticky_on_scroll_nav' );

