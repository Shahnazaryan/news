<?php
/**
 * News functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package News
 */

if ( ! function_exists( 'news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function news_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on News, use a find and replace
		 * to change 'news' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'news', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'news' ),
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
		add_theme_support( 'custom-background', apply_filters( 'news_custom_background_args', array(
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
add_action( 'after_setup_theme', 'news_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function news_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'news_content_width', 640 );
}
add_action( 'after_setup_theme', 'news_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function news_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'news' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'news_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function news_scripts() {
	wp_enqueue_style( 'news-style', get_stylesheet_uri() );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap-4.1.0/bootstrap.css' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css' );

	wp_enqueue_script( 'news-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20180422', true );
	wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/js/swiper.min.js', array(), '20180422', true );
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), '20180422', true );

	wp_enqueue_script( 'news-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'news_scripts' );

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
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/*-----custom functions ---*/

function add_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');

add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
    add_meta_box( 'slider_check', 'Add to home slide', 'cd_meta_box_cb', 'post', 'normal', 'high' );
}

function cd_meta_box_cb()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $check = $values['my_meta_box_check'][0];

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    if($check == 'yes') $field_id_checked = 'checked="checked"';
    ?>

    <p>
        <input type="checkbox" id="my_meta_box_check" name="my_meta_box_check" value="yes" <?php echo $field_id_checked; ?> />
        <label for="my_meta_box_check">Check to show</label>
    </p>
    <?php
}

add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // This is purely my personal preference for saving check-boxes
    update_post_meta( $post_id, 'my_meta_box_check', $_POST['my_meta_box_check'] );
}


function cm_add_meta_box() {
    global $post;
    //var_dump(get_post_meta( $post->ID, '_wp_page_template', true ));
    if ( 'front-page.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
        add_meta_box(
            'home-meta',
            __('About us', 'text-domain'),
            'cm_meta_html',
            'page', //Post Type
            'normal', //Location
            'high' //Priority
        );
    }
}

    add_action('add_meta_boxes', 'cm_add_meta_box', 1);


function cm_meta_html( $post) {
        wp_nonce_field( '_cm_meta_nonce', 'cm_meta_nonce' ); ?>
        <p><label for="cm_meta_content"><?php _e( 'Description', 'text-domain' ); ?></label></p><br>
        <?php
        $meta_content = wpautop( cm_get_meta( 'cm_meta_content' ),true);
        wp_editor($meta_content, 'meta_content_editor', array(
            'wpautop'               =>  true,
            'media_buttons' =>      false,
            'textarea_name' =>      'cm_meta_content',
            'textarea_rows' =>      10,
            'teeny'                 =>  true
        ));
        ?>

<?php }

function cm_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function cm_meta_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['cm_meta_nonce'] ) || ! wp_verify_nonce( $_POST['cm_meta_nonce'], '_cm_meta_nonce' ) ) return;

    if ( ! current_user_can( 'edit_post', $post_id ) ) return;


    if ( isset( $_POST['cm_meta_content'] ) )
        update_post_meta( $post_id, 'cm_meta_content', esc_attr( $_POST['cm_meta_content'] ) );
}
add_action( 'save_post', 'cm_meta_save' );


remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
// Remove the sorting dropdown from Woocommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );

