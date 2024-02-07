<?php

/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: justg
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load other required files
 *
 */

$inc = get_stylesheet_directory() . '/inc';
$includes = [
    'enqueue.php',
    'function-child.php',
    'function-vdposts.php',
    'function-reting.php',
    'widget-posts-berita.php',
    'widget-tabs-berita.php',
    'shortcodes.php'
];

foreach ($includes as $include) {
    require_once($inc . '/' . $include);
}

// action add sidebar
if (!function_exists('justg_right_sidebar_check')) {
    function justg_right_sidebar_check()
    {
        if (is_singular('fl-builder-template')) {
            return;
        }
        if (!is_active_sidebar('main-sidebar')) {
            return;
        }
        echo '<div class="right-sidebar velocity-widget widget-area px-2 col-sm-12 col-md-4 order-3" id="right-sidebar" role="complementary">';
        echo '<div class="sticky-top">';
        do_action('justg_before_main_sidebar');
        dynamic_sidebar('main-sidebar');
        do_action('justg_after_main_sidebar');
        echo '</div>';
        echo '</div>';
    }
}

add_action('widgets_init', 'justg_widgets_init');

if (!function_exists('justg_widgets_init')) {
    /**
     * Initializes themes widgets.
     */
    function justg_widgets_init()
    {

        // Register main sidebar widget area
        register_sidebar(
            array(
                'name'          => __('Main Sidebar', 'justg'),
                'id'            => 'main-sidebar',
                'description'   => __('Main sidebar widget area', 'justg'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h6 class="widget-title bg-dashed p-2"><span>',
                'after_title'   => '</span></h6>',
            )
        );

        // Register footer sidebar widget area
        register_sidebar(
            array(
                'name'          => __('Footer 1 Sidebar', 'justg'),
                'id'            => 'footer1-sidebar',
                'description'   => __('Footer sidebar widget area', 'justg'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h6 class="widget-title"><span>',
                'after_title'   => '</span></h6>',
            )
        );

        register_sidebar(
            array(
                'name'          => __('Footer 2 Sidebar', 'justg'),
                'id'            => 'footer2-sidebar',
                'description'   => __('Footer sidebar widget area', 'justg'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h6 class="widget-title"><span>',
                'after_title'   => '</span></h6>',
            )
        );

        register_sidebar(
            array(
                'name'          => __('Footer 3 Sidebar', 'justg'),
                'id'            => 'footer3-sidebar',
                'description'   => __('Footer sidebar widget area', 'justg'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h6 class="widget-title"><span>',
                'after_title'   => '</span></h6>',
            )
        );
    }
} // End of function_exists( 'justg_widgets_init' ).