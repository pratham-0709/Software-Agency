<?php
/**
 * Software Agency functions and definitions
 *
 * @package Software Agency
 */

/* Breadcrumb Begin */
function software_agency_the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url( home_url() );
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			the_category(',');
			if (is_single()) {
				echo "<span> ";
					the_title();
				echo "</span> ";
			}
		} elseif (is_page()) {
			echo "<span> ";
				the_title();
		}
	}
}

/* Theme Setup */
if ( ! function_exists( 'software_agency_setup' ) ) :
 
function software_agency_setup() {

	$GLOBALS['content_width'] = apply_filters( 'software_agency_content_width', 640 );
	
	load_theme_textdomain( 'software-agency', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('software-agency-homepage-thumb',240,145,true);
	
    register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'software-agency' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	//selective refresh for sidebar and widgets
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', software_agency_font_url() ) );

	// Theme Activation Notice
	global $pagenow;

	if (is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] )) {
		add_action('admin_notices', 'software_agency_activation_notice');
	}
}
endif;

add_action( 'after_setup_theme', 'software_agency_setup' );

// Notice after Theme Activation
function software_agency_activation_notice() {
	echo '<div class="notice notice-success is-dismissible welcome-notice">';
		echo '<p>'. esc_html__( 'Thank you for choosing Software Agency. Would like to have you on our Welcome page so that you can reap all the benefits of our Software Agency.', 'software-agency' ) .'</p>';
		echo '<span><a href="'. esc_url( admin_url( 'themes.php?page=software_agency_guide' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'software-agency' ) .'</a></span>';
		echo '<span class="demo-btn"><a href="'. esc_url( 'https://www.vwthemes.net/vw-software-company-pro/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'VIEW DEMO', 'software-agency' ) .'</a></span>';
		echo '<span class="upgrade-btn"><a href="'. esc_url( 'https://www.vwthemes.com/themes/software-company-wordpress-theme/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'UPGRADE PRO', 'software-agency' ) .'</a></span>';
	echo '</div>';
}

/* Theme Widgets Setup */
function software_agency_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'software-agency' ),
		'description'   => __( 'Appears on blog page sidebar', 'software-agency' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'software-agency' ),
		'description'   => __( 'Appears on page sidebar', 'software-agency' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'software-agency' ),
		'description'   => __( 'Appears on blog page sidebar', 'software-agency' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 1', 'software-agency' ),
		'description'   => __( 'Appears on footer 1', 'software-agency' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 2', 'software-agency' ),
		'description'   => __( 'Appears on footer 2', 'software-agency' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 3', 'software-agency' ),
		'description'   => __( 'Appears on footer 3', 'software-agency' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 4', 'software-agency' ),
		'description'   => __( 'Appears on footer 4', 'software-agency' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'software-agency' ),
		'description'   => __( 'Appears on shop page', 'software-agency' ),
		'id'            => 'woocommerce-shop-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Single Product Sidebar', 'software-agency' ),
		'description'   => __( 'Appears on single product page', 'software-agency' ),
		'id'            => 'woocommerce-single-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Social Media', 'software-agency' ),
		'description'   => __( 'Appears on top header', 'software-agency' ),
		'id'            => 'social-links',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'software_agency_widgets_init' );

/* Theme Font URL */
function software_agency_font_url() {
	$font_url      = '';
	$font_family   = array();
	$font_family[] = 'ABeeZee:400,400i';
	$font_family[] = 'Abril Fatface';
	$font_family[] = 'Acme';
	$font_family[] = 'Allura:400';
	$font_family[] = 'Anton';
	$font_family[] = 'Architects Daughter';
	$font_family[] = 'Archivo:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Arimo:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Arsenal:400,400i,700,700i';
	$font_family[] = 'Arvo:400,400i,700,700i';
	$font_family[] = 'Alegreya:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Alfa Slab One';
	$font_family[] = 'Averia Serif Libre:300,300i,400,400i,700,700i';
	$font_family[] = 'Bangers';
	$font_family[] = 'Boogaloo';
	$font_family[] = 'Bad Script';
	$font_family[] = 'Barlow Condensed:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Bitter:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Bree Serif';
	$font_family[] = 'BenchNine:300,400,700';
	$font_family[] = 'Cabin:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Cardo:400,400i,700';
	$font_family[] = 'Courgette';
	$font_family[] = 'Caveat Brush:400';
	$font_family[] = 'Cherry Swash:400,700';
	$font_family[] = 'Cormorant Garamond:300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Crimson Text:400,400i,600,600i,700,700i';
	$font_family[] = 'Cuprum:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Cookie';
	$font_family[] = 'Coming Soon';
	$font_family[] = 'Charm:400,700';
	$font_family[] = 'Chewy';
	$font_family[] = 'Days One';
	$font_family[] = 'Dosis:200,300,400,500,600,700,800';
	$font_family[] = 'EB Garamond:400,400i,500,500i,600,600i,700,700i,800,800i';
	$font_family[] = 'Economica:400,400i,700,700i';
	$font_family[] = 'Exo 2:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Fira Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Fredoka One';
	$font_family[] = 'Fjalla One';
	$font_family[] = 'Francois One';
	$font_family[] = 'Frank Ruhl Libre:300,400,500,700,900';
	$font_family[] = 'Gabriela:400';
	$font_family[] = 'Gloria Hallelujah';
	$font_family[] = 'Great Vibes';
	$font_family[] = 'Handlee';
	$font_family[] = 'Hammersmith One';
	$font_family[] = 'Heebo:100,200,300,400,500,700,800,900';
	$font_family[] = 'Hind:300,400,500,600,700';
	$font_family[] = 'Inconsolata:200,300,400,500,600,700,800,900';
	$font_family[] = 'Indie Flower';
	$font_family[] = 'IM Fell English SC';
	$font_family[] = 'Julius Sans One';
	$font_family[] = 'Jomhuria:400';
	$font_family[] = 'Josefin Slab:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Josefin Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Jost:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Kanit:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Krub:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Lobster';
	$font_family[] = 'Lato:100,100i,300,300i,400,400i,700,700i,900,900i';
	$font_family[] = 'Lora:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Libre Baskerville:400,400i,700';
	$font_family[] = 'Lobster Two:400,400i,700,700i';
	$font_family[] = 'Merriweather:300,300i,400,400i,700,700i,900,900i';
	$font_family[] = 'Marck Script';
	$font_family[] = 'Marcellus:400';
	$font_family[] = 'Merienda One:400';
	$font_family[] = 'Monda:400,700';
	$font_family[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Muli';
	$font_family[] = 'Mulish:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Noto Serif:400,400i,700,700i';
	$font_family[] = 'Nunito Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
	$font_family[] = 'Overpass:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Overpass Mono:300,400,500,600,700';
	$font_family[] = 'Oxygen:300,400,700';
	$font_family[] = 'Oswald:200,300,400,500,600,700';
	$font_family[] = 'Orbitron:400,500,600,700,800,900';
	$font_family[] = 'Patua One';
	$font_family[] = 'Pacifico';
	$font_family[] = 'Padauk:400,700';
	$font_family[] = 'Playball:400';
	$font_family[] = 'Playfair Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Prompt:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'PT Sans:400,400i,700,700i';
	$font_family[] = 'PT Serif:400,400i,700,700i';
	$font_family[] = 'Philosopher:400,400i,700,700i';
	$font_family[] = 'Permanent Marker';
	$font_family[] = 'Poiret One';
	$font_family[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Prata:400';
	$font_family[] = 'Quicksand:300,400,500,600,700';
	$font_family[] = 'Quattrocento Sans:400,400i,700,700i';
	$font_family[] = 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Rubik:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
	$font_family[] = 'Roboto Condensed:300,300i,400,400i,700,700i';
	$font_family[] = 'Rokkitt:100,200,300,400,500,600,700,800,900';
	$font_family[] = 'Russo One';
	$font_family[] = 'Righteous';
	$font_family[] = 'Saira:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Satisfy';
	$font_family[] = 'Sen:400,700,800';
	$font_family[] = 'Slabo';
	$font_family[] = 'Source Sans Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i';
	$font_family[] = 'Shadows Into Light Two';
	$font_family[] = 'Shadows Into Light';
	$font_family[] = 'Sacramento';
	$font_family[] = 'Sail:400';
	$font_family[] = 'Shrikhand';
	$font_family[] = 'Spartan:100,200,300,400,500,600,700,800,900';
	$font_family[] = 'Staatliches';
	$font_family[] = 'Stylish:400';
	$font_family[] = 'Tangerine:400,700';
	$font_family[] = 'Titillium Web:200,200i,300,300i,400,400i,600,600i,700,700i,900';
	$font_family[] = 'Trirong:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Ubuntu:300,300i,400,400i,500,500i,700,700i';
	$font_family[] = 'Unica One';
	$font_family[] = 'VT323';
	$font_family[] = 'Varela Round';
	$font_family[] = 'Vampiro One';
	$font_family[] = 'Vollkorn:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Volkhov:400,400i,700,700i';
	$font_family[] = 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Yanone Kaffeesatz:200,300,400,500,600,700';
	$font_family[] = 'ZCOOL XiaoWei';
	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

/* Theme enqueue scripts */
function software_agency_scripts() {
	wp_enqueue_style( 'software-agency-font', software_agency_font_url(), array() );
	wp_enqueue_style( 'software-agency-block-style', get_theme_file_uri('/assets/css/blocks.css') );
	wp_enqueue_style( 'software-agency-block-patterns-style-frontend', get_theme_file_uri('/inc/block-patterns/css/block-frontend.css') );
	wp_enqueue_style( 'bootstrap-style', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );
	wp_enqueue_style( 'software-agency-basic-style', get_stylesheet_uri() );
	wp_style_add_data('software-agency-basic-style', 'rtl', 'replace');
	/* Inline style sheet */
	require get_parent_theme_file_path( '/custom-style.php' );
	wp_add_inline_style( 'software-agency-basic-style',$software_agency_custom_css );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );
	wp_enqueue_script( 'jquery-superfish', get_theme_file_uri( '/assets/js/jquery.superfish.js' ), array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/assets/js/bootstrap.js', array('jquery') ,'',true);
	wp_enqueue_script( 'software-agency-custom-scripts-jquery', esc_url(get_template_directory_uri()) . '/assets/js/custom.js', array('jquery'),'' ,true );
	
	if (get_theme_mod('software_agency_animation', true) == true){	
		wp_enqueue_script( 'software-agency-jquery-wow', esc_url(get_template_directory_uri()) . '/assets/js/wow.js', array('jquery') );
		wp_enqueue_style( 'software-agency-animate-css', esc_url(get_template_directory_uri()).'/assets/css/animate.css' );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Enqueue the Dashicons script */
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'software_agency_scripts' );

/**
 * Enqueue block editor style
 */
function software_agency_block_editor_styles() {
	wp_enqueue_style( 'software-agency-font', software_agency_font_url(), array() );
	wp_enqueue_style( 'bootstrap-style', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );
    wp_enqueue_style( 'software-agency-block-patterns-style-editor', get_theme_file_uri( '/inc/block-patterns/css/block-editor.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'software_agency_block_editor_styles' );


define('SOFTWARE_AGENCY_FREE_THEME_DOC',__('https://www.vwthemesdemo.com/docs/free-software-agency/','software-agency'));
define('SOFTWARE_AGENCY_SUPPORT',__('https://wordpress.org/support/theme/software-agency/','software-agency'));
define('SOFTWARE_AGENCY_REVIEW',__('https://wordpress.org/support/theme/software-agency/reviews','software-agency'));
define('SOFTWARE_AGENCY_BUY_NOW',__('https://www.vwthemes.com/themes/software-company-wordpress-theme/','software-agency'));
define('SOFTWARE_AGENCY_LIVE_DEMO',__('https://www.vwthemes.net/vw-software-company-pro/','software-agency'));
define('SOFTWARE_AGENCY_PRO_DOC',__('https://www.vwthemesdemo.com/docs/vw-software-company-pro/','software-agency'));
define('SOFTWARE_AGENCY_FAQ',__('https://www.vwthemes.com/faqs/','software-agency'));
define('SOFTWARE_AGENCY_CHILD_THEME',__('https://developer.wordpress.org/themes/advanced-topics/child-themes/','software-agency'));
define('SOFTWARE_AGENCY_CONTACT',__('https://www.vwthemes.com/contact/','software-agency'));
define('SOFTWARE_AGENCY_CREDIT',__('https://www.vwthemes.com/themes/free-software-company-wordpress-theme/','software-agency'));

if ( ! function_exists( 'software_agency_credit' ) ) {
	function software_agency_credit(){
		echo "<a href=".esc_url(SOFTWARE_AGENCY_CREDIT)." target='_blank'>".esc_html__('Software Agency WordPress Theme','software-agency')."</a>";
	}
}

function software_agency_sanitize_dropdown_pages( $page_id, $setting ) {
  	// Ensure $input is an absolute integer.
  	$page_id = absint( $page_id );
  	// If $page_id is an ID of a published page, return it; otherwise, return the default.
  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function software_agency_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function software_agency_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function software_agency_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

/* Excerpt Limit Begin */
function software_agency_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'software_agency_loop_columns');
	if (!function_exists('software_agency_loop_columns')) {
		function software_agency_loop_columns() {
		return 3; // 3 products per row
	}
}

function software_agency_logo_title_hide_show(){
	if(get_theme_mod('software_agency_logo_title_hide_show') == '1' ) {
		return true;
	}
	return false;
}

function software_agency_tagline_hide_show(){
	if(get_theme_mod('software_agency_tagline_hide_show') == '1' ) {
		return true;
	}
	return false;
}

add_action( 'wp_ajax_software_agency_reset_all_settings', 'software_agency_reset_all_settings' );
function software_agency_reset_all_settings() {
	remove_theme_mod( 'software_agency_footer_text' );
	wp_send_json_success(
		array(
			'success' => true,
			'message' => "Reset Completed",
		)
	);
}

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Typography */
require get_template_directory() . '/inc/typography/ctypo.php';

/* Social Icons */
require get_template_directory() . '/inc/themes-widgets/social-icon.php';

/* Block Pattern */
require get_template_directory() . '/inc/block-patterns/block-patterns.php';

/* Implement the About theme page */
require get_template_directory() . '/inc/getstart/getstart.php';

/* TGM Plugin Activation */
require get_template_directory() . '/inc/tgm/tgm.php';

/* Plugin Activation */
require get_template_directory() . '/inc/getstart/plugin-activation.php';

/* Webfonts */
require get_template_directory() . '/inc/wptt-webfont-loader.php';