<?php

/**
 * General
 */

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    add_theme_support('menu');
}

/**
 * Styles and Scripts
 */
function wpdocs_theme_name_scripts() {
    if (!is_rtl()) {
        wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display|Ubuntu' );
    }
    wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );
    wp_enqueue_style( 'html5reset', get_template_directory_uri() . '/resources/css/html5reset.css' );
    wp_enqueue_style( 'flexboxgrid', get_template_directory_uri() . '/resources/css/flexboxgrid.css' );
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

/**
 * Thumbnails
 */
if (function_exists('add_image_size')) {
    add_image_size('jahanitheme_featured', 1100, 600, true);
    add_image_size('jahanitheme_thumbnail', 450, 300, true);
}

add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);
function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

// Remove ajax load more size
function alm_remove_image_size() {
    global $ajax_load_more;
    remove_filter( 'after_setup_theme', array( $ajax_load_more, 'alm_image_sizes' ) );
 }
add_action( 'after_setup_theme', 'alm_remove_image_size', 1 ); 

/**
 * Translation
 */
// load_theme_textdomain( 'jahani-theme');
function my_theme_setup() {
    load_theme_textdomain( 'jahani-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_theme_setup' );


/**
 * Post Types
 */
// function create_post_type()
// {
//     register_post_type('acme_product',
//         array(
//             'labels' => array(
//                 'name' => __('Products'),
//                 'singular_name' => __('Product'),
//             ),
//             'public' => true,
//             'has_archive' => true,
//         )
//     );
// }
// add_action('init', 'create_post_type');

/**
 * Menu
 */
function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu', 'jahani-theme'),
            'footer-menu' => __('Footer Menu', 'jahani-theme'),
            'social-menu' => __('Social Menu', 'jahani-theme'),
        )
    );
}
add_action('init', 'register_my_menus');

function social_menu_function($nav, $args)
{
    if ($args->theme_location == 'social-menu') {
        return __('Follow', 'jahani-theme').'&nbsp&nbsp&nbsp' . $nav;
    }
    return $nav;
}
add_filter('wp_nav_menu_items', 'social_menu_function', 10, 2);

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
function special_nav_class($classes, $item, $args)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    if ($args->theme_location == 'social-menu') {
        $socials = [
            'telegram.me' => 'telegram-plane',
            't.me' => 'telegram-plane',
            'instagram.com' => 'instagram',
            'twitter.com' => 'twitter',
            'facebook.com' => 'facebook-f',
            'fb.com' => 'facebook-f',
            'plus.google.com' => 'google-plus-g',
        ];
        $url = $item->url;
        $host = parse_url($url, PHP_URL_HOST);
        $icon = null;
        foreach ($socials as $key => $value) {
            if (endsWith($host, $key)) {
                $icon = $value;
                break;
            }
        }
        if (!empty($icon)) {
            $item->title = "<i class='fab fa-$icon'></i>";
            // var_dump($item);
            // die();
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'special_nav_class', 10, 3);

/**
 * Read More
 */
function modify_read_more_link()
{
    return '<a href="' . get_permalink() . '" class="btn">More</a>';
}
add_filter('the_content_more_link', 'modify_read_more_link');

/**
 * Sidebar
 */
// register_sidebars( 2, array( 'name' => 'Foobar %d' ) );
register_sidebar(array(
    'name' => 'Footer Left Sidebar',
    'id' => 'footer-left-sidebar',
    'description'   => __( 'If "Footer Right Sidebar" does not have any element, this will cover whole footer' ),
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
));
register_sidebar(array(
    'name' => 'Footer Right Sidebar',
    'id' => 'footer-Right-sidebar',
    'description'   => __( 'If "Footer Left Sidebar" is empty, this sidebar will not be shown too.' ),
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
));

/**
 * TGM Plugin Activation
 */
require_once( get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' ) );
add_action('tgmpa_register', 'my_theme_register_required_plugins');
function my_theme_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => 'WordPress Infinite Scroll – Ajax Load More',
            'slug' => 'ajax-load-more',
        ),
        array(
            'name' => 'Newsletter',
            'slug' => 'newsletter',
        ),
        array(
            'name' => 'Regenerate Thumbnails',
            'slug' => 'regenerate-thumbnails',
            'required' => false,
        ),
    );

    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );
    tgmpa($plugins, $config);
}
