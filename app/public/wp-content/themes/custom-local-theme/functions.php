<?php
/**
 * Custom Local Theme functions and definitions
 *
 * @package Custom_Local_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Define theme constants
 */
define( 'CUSTOM_LOCAL_THEME_VERSION', '2.0.0' );
define( 'CUSTOM_LOCAL_THEME_DIR', get_template_directory() );
define( 'CUSTOM_LOCAL_THEME_URL', get_template_directory_uri() );

/**
 * Setup theme after_setup_theme
 *
 * @since 1.0.0
 */
function custom_local_theme_setup() {
	// Add theme support for titles
	add_theme_support( 'title-tag' );

	// Add theme support for post thumbnails (featured images)
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 600, true );

	// Add custom image sizes
	add_image_size( 'custom-large', 1200, 600, true );
	add_image_size( 'custom-medium', 800, 400, true );
	add_image_size( 'custom-small', 400, 300, true );

	// Add theme support for menus
	add_theme_support( 'menus' );
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'custom-local-theme' ),
		'footer'  => esc_html__( 'Footer Menu', 'custom-local-theme' ),
	) );

	// Add theme support for custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 50,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Add theme support for HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
	) );

	// Add theme support for editor styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );

	// Load text domain for translations
	load_theme_textdomain( 'custom-local-theme', CUSTOM_LOCAL_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'custom_local_theme_setup' );

/**
 * Enqueue theme styles and scripts
 *
 * @since 1.0.0
 */
function custom_local_theme_enqueue_scripts() {
	// Enqueue main stylesheet
	wp_enqueue_style(
		'custom-local-theme-style',
		CUSTOM_LOCAL_THEME_URL . '/style.css',
		array(),
		CUSTOM_LOCAL_THEME_VERSION
	);

	// Enqueue theme main script
	wp_enqueue_script(
		'custom-local-theme-main',
		CUSTOM_LOCAL_THEME_URL . '/assets/js/main.js',
		array(),
		CUSTOM_LOCAL_THEME_VERSION,
		true
	);

	// Enqueue comment reply script if needed
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'custom_local_theme_enqueue_scripts' );

/**
 * Register widget areas
 *
 * @since 1.0.0
 */
function custom_local_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'custom-local-theme' ),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__( 'Main sidebar for pages and posts', 'custom-local-theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'custom-local-theme' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'Footer widget area', 'custom-local-theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'custom_local_theme_widgets_init' );

/**
 * Add custom logo support to the admin bar
 *
 * @since 1.0.0
 */
function custom_local_theme_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( ! empty( $custom_logo_id ) ) {
		$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
	}
}
add_action( 'after_setup_theme', 'custom_local_theme_custom_logo' );

/**
 * Get the custom logo or site title
 *
 * @since 1.0.0
 * @return string Custom logo or site title
 */
function custom_local_theme_get_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( ! empty( $custom_logo_id ) ) {
		$logo_html = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
			'class' => 'custom-logo',
		) );
		return '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link">' . $logo_html . '</a>';
	}

	return '';
}

/**
 * Display site title
 *
 * @since 1.0.0
 * @return string Site title HTML
 */
function custom_local_theme_get_site_title() {
	$title = get_bloginfo( 'name' );
	$url   = esc_url( home_url( '/' ) );

	return '<h1 class="site-title"><a href="' . $url . '" rel="home">' . esc_html( $title ) . '</a></h1>';
}

/**
 * Display site tagline/description
 *
 * @since 1.0.0
 * @return string Site tagline HTML
 */
function custom_local_theme_get_site_tagline() {
	$description = get_bloginfo( 'description' );

	if ( ! empty( $description ) ) {
		return '<p class="site-description">' . esc_html( $description ) . '</p>';
	}

	return '';
}

/**
 * Get primary navigation menu
 *
 * @since 1.0.0
 * @return string Navigation menu HTML
 */
function custom_local_theme_get_primary_menu() {
	if ( has_nav_menu( 'primary' ) ) {
		return wp_nav_menu( array(
			'theme_location'  => 'primary',
			'container'       => 'nav',
			'container_class' => 'primary-navigation',
			'menu_class'      => 'main-menu',
			'fallback_cb'     => 'custom_local_theme_fallback_menu',
			'echo'            => false,
		) );
	}

	return custom_local_theme_fallback_menu();
}

/**
 * Fallback menu if no menu is assigned
 *
 * @since 1.0.0
 * @return string Fallback menu HTML
 */
function custom_local_theme_fallback_menu() {
	$items  = '<nav class="primary-navigation">';
	$items .= '<ul class="main-menu">';
	$items .= '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'custom-local-theme' ) . '</a></li>';

	if ( is_user_logged_in() ) {
		$items .= '<li><a href="' . esc_url( admin_url() ) . '">' . esc_html__( 'Admin', 'custom-local-theme' ) . '</a></li>';
	}

	$items .= '</ul>';
	$items .= '</nav>';

	return $items;
}

/**
 * Get footer menu
 *
 * @since 1.0.0
 * @return string Footer menu HTML
 */
function custom_local_theme_get_footer_menu() {
	if ( has_nav_menu( 'footer' ) ) {
		return wp_nav_menu( array(
			'theme_location'  => 'footer',
			'container'       => false,
			'menu_class'      => 'footer-menu',
			'fallback_cb'     => 'wp_page_menu',
			'echo'            => false,
		) );
	}

	return '';
}

/**
 * Post pagination
 *
 * @since 1.0.0
 */
function custom_local_theme_pagination() {
	$big = 999999999;

	$args = array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'prev_next' => true,
		'prev_text' => esc_html__( '← Previous', 'custom-local-theme' ),
		'next_text' => esc_html__( 'Next →', 'custom-local-theme' ),
		'type'      => 'list',
		'before'    => '<div class="pagination-wrapper">',
		'after'     => '</div>',
	);

	$pagination = paginate_links( $args );

	if ( $pagination ) {
		echo wp_kses_post( $pagination );
	}
}

/**
 * Get excerpt with custom length
 *
 * @since 1.0.0
 * @param int $length Excerpt length
 * @return string Excerpt text
 */
function custom_local_theme_excerpt( $length = 20 ) {
	$excerpt = get_the_excerpt();

	if ( empty( $excerpt ) ) {
		$excerpt = wp_strip_all_tags( get_the_content() );
		$excerpt = wp_trim_words( $excerpt, $length );
	}

	return $excerpt;
}

/**
 * Output excerpt with custom length
 *
 * @since 1.0.0
 * @param int $length Excerpt length
 */
function custom_local_theme_the_excerpt( $length = 20 ) {
	echo wp_kses_post( custom_local_theme_excerpt( $length ) );
}

/**
 * Display post meta information
 *
 * @since 1.0.0
 */
function custom_local_theme_post_meta() {
	?>
	<div class="post-meta">
		<span class="post-date">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</span>
		<span class="post-author">
			<?php esc_html_e( 'By ', 'custom-local-theme' ); ?>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				<?php echo esc_html( get_the_author() ); ?>
			</a>
		</span>
		<?php if ( has_category() ) : ?>
			<span class="post-category">
				<?php esc_html_e( 'in ', 'custom-local-theme' ); ?>
				<?php the_category( ', ' ); ?>
			</span>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Content wrapper functions
 *
 * @since 1.0.0
 */
function custom_local_theme_content_before() {
	echo '<main class="container">';
}

function custom_local_theme_content_after() {
	echo '</main>';
}

/**
 * Modify the excerpt more text
 *
 * @since 1.0.0
 * @param string $more More text
 * @return string Modified more text
 */
function custom_local_theme_excerpt_more( $more ) {
	return '... <a href="' . get_permalink() . '" class="read-more">' . esc_html__( 'Read More', 'custom-local-theme' ) . '</a>';
}
add_filter( 'excerpt_more', 'custom_local_theme_excerpt_more' );

/**
 * Custom comment callback
 *
 * @since 1.0.0
 */
function custom_local_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<article class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php echo wp_kses_post( get_avatar( $comment, 48, 'mystery' ) ); ?>
					<?php printf( '<b class="fn">%s</b>', wp_kses_post( get_comment_author() ) ); ?>
				</div>
				<div class="comment-metadata">
					<time datetime="<?php echo esc_attr( get_comment_time( 'c' ) ); ?>">
						<?php echo esc_html( get_comment_time() ); ?>
					</time>
				</div>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</footer>
			<div class="comment-content">
				<?php comment_text(); ?>
			</div>
		</article>
	</li>
	<?php
}

/**
 * Add body classes
 *
 * @since 1.0.0
 * @param array $classes Body classes
 * @return array Modified body classes
 */
function custom_local_theme_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'single-post';
	}

	if ( is_archive() ) {
		$classes[] = 'archive-page';
	}

	if ( is_front_page() ) {
		$classes[] = 'homepage';
	}

	return $classes;
}
add_filter( 'body_class', 'custom_local_theme_body_classes' );

/**
 * Sanitize hex color
 *
 * @since 1.0.0
 * @param string $color Hex color
 * @return string Sanitized color
 */
function custom_local_theme_sanitize_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// If string starts with 'rgba', return it as-is after sanitization.
	if ( strpos( $color, 'rgba' ) !== false ) {
		return sanitize_text_field( $color );
	}

	// If string doesn't start with 'rgb', assume it's hex.
	if ( strpos( $color, 'rgb' ) !== false ) {
		return sanitize_text_field( $color );
	}

	// Sanitize hex color without a hash. Use '#' in the return.
	$color = sanitize_hex_color_no_hash( $color );
	return '#' . $color;
}

/**
 * Sanitize checkbox
 *
 * @since 1.0.0
 * @param mixed $input Input value
 * @return mixed Sanitized value
 */
function custom_local_theme_sanitize_checkbox( $input ) {
	return ( isset( $input ) ? true : false );
}

/**
 * NOIR Theme Functions
 * Custom functions for the NOIR streetwear brand theme
 */

/**
 * Get site title (NOIR branded)
 *
 * @since 2.0.0
 * @return string Site title HTML
 */
function noir_theme_get_site_title() {
	$url = esc_url( home_url( '/' ) );
	// Display "NOIR" as the fixed wordmark instead of blog name
	return '<h1 class="site-title"><a href="' . $url . '" rel="home">NOIR</a></h1>';
}

/**
 * Get primary navigation menu (NOIR branded)
 *
 * @since 2.0.0
 * @return string Navigation menu HTML
 */
function noir_theme_get_primary_menu() {
	if ( has_nav_menu( 'primary' ) ) {
		return wp_nav_menu( array(
			'theme_location'  => 'primary',
			'container'       => 'nav',
			'container_class' => 'primary-navigation',
			'menu_class'      => 'main-menu',
			'fallback_cb'     => 'noir_theme_fallback_menu',
			'echo'            => false,
		) );
	}

	return noir_theme_fallback_menu();
}

/**
 * Fallback menu for NOIR theme
 *
 * @since 2.0.0
 * @return string Fallback menu HTML
 */
function noir_theme_fallback_menu() {
	$items  = '<nav class="primary-navigation">';
	$items .= '<ul class="main-menu">';
	$items .= '<li><a href="#hero">' . esc_html__( 'Collection', 'custom-local-theme' ) . '</a></li>';
	$items .= '<li><a href="#story">' . esc_html__( 'Campaign', 'custom-local-theme' ) . '</a></li>';
	$items .= '<li><a href="#story">' . esc_html__( 'Our Story', 'custom-local-theme' ) . '</a></li>';
	$items .= '</ul>';
	$items .= '</nav>';

	return $items;
}

