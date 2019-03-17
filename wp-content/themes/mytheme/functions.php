<?php
/**
 * mytheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mytheme
 */

require_once 'lib/Products.php';
require_once 'lib/Taxes.php';

if ( ! function_exists( 'mytheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mytheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mytheme, use a find and replace
		 * to change 'mytheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mytheme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'mytheme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mytheme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mytheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mytheme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mytheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'mytheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mytheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mytheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mytheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mytheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mytheme_scripts() {
	wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );

	wp_enqueue_style( 'mytheme-custom-style', get_template_directory_uri() . '/css/main.css');

	wp_enqueue_style( 'mytheme-bootstrap-css', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );

	wp_enqueue_script( 'mytheme-bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' );

	wp_enqueue_script( 'mytheme-bootstrap-popper-js', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' );

	wp_enqueue_script( 'mytheme-filter-js',  get_template_directory_uri() . '/js/filter.js', array( 'jquery' ) );

	wp_enqueue_script( 'mytheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mytheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'mytheme-filter-js', 'ajaxurl', 
		array(
			'url' => admin_url('admin-ajax.php')
		)
	); 	
}
add_action( 'wp_enqueue_scripts', 'mytheme_scripts' );

/**
 * Custom post-types
 */
function custom_post_types() {
	register_post_type( 'mytheme_product',
		array(
			'labels' 			=> array(
				'name' 			=> __( 'Products' ),
				'singular_name' => __( 'Product' ),
			),
			'public' 			=> true,
			'has_archive' 		=> true,
			'menu_position' 	=> 4,
			'menu_icon' 		=> 'dashicons-cart',
			'supports' => array(  
				'title', 
				'editor',
				'thumbnail',
			),
			'taxonomies' 		=> array(
				'Color',
				'Android',
				'RAM',
			)
		)
	);
}
add_action( 'init', 'custom_post_types' );

/**
 * Custom taxo
 */
function custom_taxonomies() {
	$taxe = new Taxes;
	$taxe->registerTaxes(); 	
}
add_action( 'init', 'custom_taxonomies' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist_start_el_version', 10, 2 );
function wpse_139269_term_radio_checklist_start_el_version( $args, $post_id ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'RAM' || $args['taxonomy'] === 'Android' || $args['taxonomy'] === 'Color') {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist_Start_El_Version' ) ) {
                class WPSE_139269_Walker_Category_Radio_Checklist_Start_El_Version extends Walker_Category_Checklist {
                    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
                        if ( empty( $args['taxonomy'] ) ) {
                            $taxonomy = 'category';
                        } else {
                            $taxonomy = $args['taxonomy'];
                        }

                        if ( $taxonomy == 'category' ) {
                            $name = 'post_category';
                        } else {
                            $name = 'tax_input[' . $taxonomy . ']';
                        }

                        $args['popular_cats'] = empty( $args['popular_cats'] ) ? array() : $args['popular_cats'];
                        $class = in_array( $category->term_id, $args['popular_cats'] ) ? ' class="popular-category"' : '';

                        $args['selected_cats'] = empty( $args['selected_cats'] ) ? array() : $args['selected_cats'];

                        /** This filter is documented in wp-includes/category-template.php */
                        if ( ! empty( $args['list_only'] ) ) {
                            $aria_cheched = 'false';
                            $inner_class = 'category';

                            if ( in_array( $category->term_id, $args['selected_cats'] ) ) {
                                $inner_class .= ' selected';
                                $aria_cheched = 'true';
                            }

                            $output .= "\n" . '<li' . $class . '>' .
                                '<div class="' . $inner_class . '" data-term-id=' . $category->term_id .
                                ' tabindex="0" role="checkbox" aria-checked="' . $aria_cheched . '">' .
                                esc_html( apply_filters( 'the_category', $category->name ) ) . '</div>';
                        } else {
                            $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" .
                            '<label class="selectit"><input value="' . $category->term_id . '" type="radio" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' .
                            checked( in_array( $category->term_id, $args['selected_cats'] ), true, false ) .
                            disabled( empty( $args['disabled'] ), false, false ) . ' /> ' .
                            esc_html( apply_filters( 'the_category', $category->name ) ) . '</label>';
                        }
                    }
                }
            }
            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist_Start_El_Version;
        }
    }
    return $args;
}

function my_action_callback() {
	var_dump ( $_POST );

    wp_die();
}

add_action( 'wp_ajax_action', 'my_action_callback', 99 );
add_action( 'wp_ajax_nopriv_action', 'my_action_callback', 99 );