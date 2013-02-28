<?php
/*
 * Include class
 */
require_once 'class/Techhouse.php';
require_once 'class/TaxonomyCustomfields.php';
require_once 'class/Request.php';
require_once 'class/Model.php';
require_once 'class/Cart.php';
require_once 'class/Quote_Item.php';

class TechhouseTheme
{
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'themeSetup'));
        add_action('wp_enqueue_scripts', array($this, 'loadStyles'));
        add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
        add_action('widgets_init', array($this, 'widgetsInit'));
        add_action('init', array($this, 'initSessionId'));
    }

    public function initSessionId()
    {
        if (!isset($_COOKIE['wp_cart_session_id']) || $_COOKIE['wp_cart_session_id'] == '') {
            $key = $_SERVER['REMOTE_ADDR'] . $_SERVER['REQUEST_TIME'];
            setcookie('wp_cart_session_id', md5($key));
        }
    }

    public function loadStyles()
    {
        wp_enqueue_style('screen', get_bloginfo('template_url') . '/css/screen.css', array(), false, 'screen');
        wp_enqueue_style('fck', get_bloginfo('template_url') . '/css/fck.css', array(), false, 'screen');
    }

    public function loadScripts()
    {
        wp_enqueue_script('jquery');
    }

    public function themeSetup()
    {
        // Load language
        load_theme_textdomain('techhouse', get_template_directory() . '/languages');

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // This theme supports a variety of post formats.
        add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu('primary', __('Primary Menu', 'techhouse'));

        /*
         * This theme supports custom background color and image, and here
        * we also set up the default background color.
        */
        add_theme_support('custom-background', array(
            'default-color' => 'e6e6e6',
        ) );

        // This theme uses a custom image size for featured images, displayed on "standard" posts.
        add_theme_support('post-thumbnails');
        //set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

        // Add custom image size
        add_image_size('product_grid_view', 135, 125);
        add_image_size('product_gallery_thumb', 39, 39, true);
        add_image_size('nav_image', 390, 188, true);
        add_image_size('home_promos', 233);
    }

    public function widgetsInit()
    {
        // First sidebar widgets
        register_sidebar(
            array(
                'name' => __('Footer First', 'techhouse'),
                'id' => 'footer-first',
                'description' => __('The first widget area on footer', 'techhouse'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
        );

        // Sencodary sidebar widgets
        register_sidebar(
            array(
                'name' => __('Footer Second', 'techhouse'),
                'id' => 'footer-second',
                'description' => __('The second widget area on footer', 'techhouse'),
                'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Languages', 'techhouse'),
                'id' => 'languages',
                'description' => __('The second widget for languages', 'techhouse'),
                'before_widget' => '<div id="%1$s" class="select-1 width-1 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Languages', 'techhouse'),
                'id' => 'languages',
                'description' => __('The second widget for languages', 'techhouse'),
                'before_widget' => '<div id="%1$s" class="select-1 width-1 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
        );
    }
}
$techhouse = new TechhouseTheme();