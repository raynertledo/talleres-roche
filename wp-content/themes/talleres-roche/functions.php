<?php
/**
 * roche functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package roche
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function roche_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on roche, use a find and replace
		* to change 'roche' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'roche', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'roche' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'roche_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'roche_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function roche_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'roche_content_width', 640 );
}
add_action( 'after_setup_theme', 'roche_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function roche_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'roche' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'roche' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'roche_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function roche_scripts() {
	wp_enqueue_style( 'roche-bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), _S_VERSION );

	wp_enqueue_style( 'roche-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'roche-style', 'rtl', 'replace' );

	wp_enqueue_script( 'roche-bootstrap-scripts', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'roche-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true );
	
	wp_localize_script( 'roche-navigation', 'ajax_comment_params', array( 'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	add_filter( 'style_loader_tag', __NAMESPACE__ . '\roche_add_sri', 10, 2 );
    add_filter( 'script_loader_tag', __NAMESPACE__ . '\roche_add_sri', 10, 2 );
}
add_action( 'wp_enqueue_scripts', 'roche_scripts' );

/**
 * Implement the Custom Header feature.
 */
function roche_add_sri( $html, $handle ) : string {
    switch( $handle ) {
        case 'roche-bootstrap-style':
            $html = str_replace( ' />', '  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />', $html );
            break;
        case 'roche-bootstrap-scripts':
            $html = str_replace( '></script>', ' integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>', $html );
            break;
    } 
    return $html;
}
 
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

/**
 * Include Theme option page
*/
if( function_exists('acf_add_options_page') ):

    acf_add_options_page(array(
        'page_title' => 'Opciones del Tema',
        'menu_title' => 'Opciones del Tema',
        'menu_slug' => 'theme-options',
        'capability' => 'edit_posts',
        'position' => '',
        'parent_slug' => '',
        'icon_url' => '', 
        'redirect' => true,
        'post_id' => 'options',
        'autoload' => false,
        'update_button' => 'Actualizar',
        'updated_message' => 'Opciones Actualizadas',
    ));

endif;

add_filter( 'comment_form_defaults', 'dcms_modify_fields_form' );

function dcms_modify_fields_form( $args ){

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$author = '<div class="taller-comments-form"><input placeholder="'.__( 'Name' ) . ( $req ? ' *' : '' ).'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' />';
	$email = '<input placeholder="'.__( 'Email' ) . ( $req ? ' *' : '' ).'" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' />';
	$url = '<input placeholder="'.__( 'Website' ).'" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" /></div>';
	$comment = '<textarea placeholder="'. _x( 'Comment', 'noun' ).'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>';

	$args['fields']['author'] = $author;
	$args['fields']['email'] = $email;
	$args['fields']['url'] = $url;
	$args['comment_field'] = $comment;

	return $args;

}
add_filter('gettext', function( $tran, $txt, $dom ) {
    if ( 'Leave a Reply' == $txt ) return 'Deja tu comentario o pregunta sobre la sesi??n';
    return $tran;
}, 10, 3 );






add_action( 'wp_ajax_ajaxcomments', 'submit_ajax_comment' );
add_action( 'wp_ajax_nopriv_ajaxcomments', 'submit_ajax_comment' );

function submit_ajax_comment(){

	$comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
	if ( is_wp_error( $comment ) ) {
		$error_data = intval( $comment->get_error_data() );
		if ( ! empty( $error_data ) ) {
			wp_die( '<p>' . $comment->get_error_message() . '</p>', __( 'Comment Submission Failure' ), array( 'response' => $error_data, 'back_link' => true ) );
		} else {
			wp_die( 'Unknown error' );
		}
	}

	$user = wp_get_current_user();
	do_action('set_comment_cookies', $comment, $user);


	$comment_depth = 1;
	$comment_parent = $comment->comment_parent;
	while( $comment_parent ){
		$comment_depth++;
		$parent_comment = get_comment( $comment_parent );
		$comment_parent = $parent_comment->comment_parent;
	}

	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $comment_depth;


	$comment_html = '<li ' . comment_class('', null, null, false ) . ' id="comment-' . get_comment_ID() . '">
		<article class="comment-body" id="div-comment-' . get_comment_ID() . '">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					' . get_avatar( $comment, 32 ) . '
					<b class="fn">' . get_comment_author_link() . '</b> <span class="says">says:</span>
				</div>
				<div class="comment-metadata">
					<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . sprintf('%1$s at %2$s', get_comment_date(),  get_comment_time() ) . '</a>';

					if( $edit_link = get_edit_comment_link() )
						$comment_html .= '<span class="edit-link"><a class="comment-edit-link" href="' . $edit_link . '">Edit</a></span>';

				$comment_html .= '</div>';
				if ( $comment->comment_approved == '0' )
					$comment_html .= '<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>';

			$comment_html .= '</footer>
			<div class="comment-content">' . apply_filters( 'comment_text', get_comment_text( $comment ), $comment ) . '</div>
		</article>
	</li>';
	echo $comment_html;
	die();
}