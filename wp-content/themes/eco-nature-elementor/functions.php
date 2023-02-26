<?php
/**
 * Eco Nature Elementor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Eco Nature Elementor
 */

/* Enqueue script and styles */

function eco_nature_elementor_enqueue_google_fonts() {

	require_once get_theme_file_path( 'includes/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'manrope',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap' ),
		array(),
		'1.0'
	);
}
add_action( 'wp_enqueue_scripts', 'eco_nature_elementor_enqueue_google_fonts' );

if (!function_exists('eco_nature_elementor_enqueue_scripts')) {

	function eco_nature_elementor_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			get_template_directory_uri() . '/assets/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/assets/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style('eco-nature-elementor-style', get_stylesheet_uri(), array() );

		wp_enqueue_style(
			'eco-nature-elementor-responsive-css',
			get_template_directory_uri() . '/assets/css/responsive.css',
			array(),'2.3.4'
		);

		wp_enqueue_script(
			'eco-nature-elementor-navigation',
			get_template_directory_uri() . '/assets/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'eco-nature-elementor-script',
			get_template_directory_uri() . '/assets/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$css = '';

		if ( get_header_image() ) :

			$css .=  '
				.header-image-box{
					background-image: url('.esc_url(get_header_image()).') !important;
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
					height: 550px;
				    display: flex;
				    align-items: center;
				}';

		endif;

		wp_add_inline_style( 'eco-nature-elementor-style', $css );

	}

	add_action( 'wp_enqueue_scripts', 'eco_nature_elementor_enqueue_scripts' );

}

/* Setup theme */

if (!function_exists('eco_nature_elementor_after_setup_theme')) {

	function eco_nature_elementor_after_setup_theme() {

		if ( ! isset( $eco_nature_elementor_content_width ) ) $eco_nature_elementor_content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main menu', 'eco-nature-elementor' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support( 'wp-block-styles' );
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-background', array(
		  'default-color' => 'f3f3f3'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
		) );

		add_theme_support( 'custom-header', array(
			'default-image'      => get_parent_theme_file_uri( '/assets/images/default-header-image.png' ),
			'width' => 1920,
			'flex-width' => true,
			'height' => 550,
			'flex-height' => true,
			'header-text' => false,
		));

		register_default_headers( array(
			'default-image' => array(
				'url'           => '%s/assets/images/default-header-image.png',
				'thumbnail_url' => '%s/assets/images/default-header-image.png',
				'description'   => __( 'Default Header Image', 'eco-nature-elementor' ),
			),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_editor_style( array( '/assets/css/editor-style.css' ) );

		global $pagenow;

	if (is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] )) {
		add_action('admin_notices', 'eco_nature_elementor_activation_notice');
	}

	}

	add_action( 'after_setup_theme', 'eco_nature_elementor_after_setup_theme', 999 );

}

function eco_nature_elementor_activation_notice() {
	echo '<div class="notice notice-success is-dismissible dashboard-notice">';
	echo '<h1>'. esc_html__( 'Welcome To Eco Nature Elementor Theme', 'eco-nature-elementor' ) .'</h1>';
	echo '<p>'. esc_html__( 'Much thanks to you for picking Eco Nature Elementor. For the home page setup click on the below button.', 'eco-nature-elementor' ) .'</p>';
	echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=eco_nature_elementor_about' ) ) .'" class="button button-primary">'. esc_html__( 'More Info', 'eco-nature-elementor' ) .'</a></p>';
	echo '</div>';
}

require get_template_directory() .'/includes/tgm/tgm.php';
require get_template_directory() . '/includes/customizer.php';
load_template( trailingslashit( get_template_directory() ) . '/includes/go-pro/class-upgrade-pro.php' );

/* Get post comments */

if (!function_exists('eco_nature_elementor_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function eco_nature_elementor_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'eco-nature-elementor');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'eco-nature-elementor'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php /* translators: %s: Date */ printf( esc_attr('%1$s at %2$s', '1: date, 2: time', 'eco-nature-elementor'), esc_attr( get_comment_date() ), esc_attr( get_comment_time() ) ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( 'Edit', 'eco-nature-elementor' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'eco-nature-elementor'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for eco_nature_elementor_comment()

if (!function_exists('eco_nature_elementor_widgets_init')) {

	function eco_nature_elementor_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','eco-nature-elementor'),
			'id'   => 'eco-nature-elementor-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'eco-nature-elementor'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer sidebar','eco-nature-elementor'),
			'id'   => 'eco-nature-elementor-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'eco-nature-elementor'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'eco_nature_elementor_widgets_init' );

}

function eco_nature_elementor_the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo esc_url( home_url() );
		echo '">';
		bloginfo('name');
		echo "</a> >> ";
		if (is_category() || is_single()) {
			the_category(' , ');
			if (is_single()) {
				echo " >> ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'eco_nature_elementor_loop_columns', 999);
if (!function_exists('eco_nature_elementor_loop_columns')) {
	function eco_nature_elementor_loop_columns() {
		return 3; // 3 products per row
	}
}

function eco_nature_elementor_max_title_length( $title ) {
	$max = 20;
	if( strlen( $title ) > $max ) {
		return substr( $title, 0, $max ). " &hellip;";
		} else {
		return $title;
	}
}
add_filter( 'the_title', 'eco_nature_elementor_max_title_length');

function eco_nature_elementor_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

define('ECO_NATURE_ELEMENTOR_SUPPORT',__('https://wordpress.org/support/theme/eco-nature-elementor','eco-nature-elementor'));
define('ECO_NATURE_ELEMENTOR_REVIEW',__('https://wordpress.org/support/theme/eco-nature-elementor/reviews/','eco-nature-elementor'));
define('ECO_NATURE_ELEMENTOR_BUY_NOW',__('https://www.wpelemento.com/elementor/eco-nature-wordpress-theme/','eco-nature-elementor'));
define('ECO_NATURE_ELEMENTOR_LIVE_DEMO',__('https://www.wpelemento.com/demo/eco-nature-elementor/','eco-nature-elementor'));
define('ECO_NATURE_ELEMENTOR_PRO_DOC',__('https://www.wpelemento.com/theme-documentation/eco-nature-elementor-pro/','eco-nature-elementor'));

/* Implement the About theme page */
require get_template_directory() . '/includes/getstart/getstart.php';

if ( ! defined( 'ECO_NATURE_ELEMENTOR_CHANGELOG_THEME_URL' ) ) {
    define( 'ECO_NATURE_ELEMENTOR_CHANGELOG_THEME_URL', get_template_directory() . '/changelog.txt' );
}

?>