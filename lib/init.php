<?php

namespace Roots\ParentTheme\Init;

/**
 * Theme setup
 */
function init() {

    show_admin_bar(false);

    // Enable post thumbnails, now called 'Featured Images'
    // https://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');

    /*
    // Enable post formats
    // http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);
    */

    /*
    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
    */

    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

    // This feature adds RSS feed links to HTML <head>
    //add_theme_support( 'automatic-feed-links' );

    // Remove junk from head
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action('after_setup_theme', __NAMESPACE__ . '\\init');

function wpse51581_cleanup_css_tag($src) {
    $src = str_replace("type='text/css'", '', $src);
    $src = str_replace('\'', '"', $src);
    $src = str_replace('  ', ' ', $src);
    $src = str_replace(' />', '>', $src);
    return $src;
}
add_filter('style_loader_tag', __NAMESPACE__ . '\\wpse51581_cleanup_css_tag');

function wpse51581_cleanup_js_tag($src) {
    $src = str_replace("type='text/javascript'", '', $src);
    $src = str_replace('\'', '"', $src);
    $src = str_replace('  ', ' ', $src);
    $src = str_replace(' />', '>', $src);
    return $src;
}
add_filter('script_loader_tag', __NAMESPACE__ . '\\wpse51581_cleanup_js_tag');