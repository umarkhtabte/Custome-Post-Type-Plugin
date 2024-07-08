<?php
/*
Plugin Name: Register News Post Type
Plugin URI:  https://example.com/
Description: A plugin demonstrating registration and removal of News post type
Version:     1.0.0
Author:      Umar Khtab
Author URI:       
*/

// Activation hook
register_activation_hook( __FILE__, 'news_post_type_plugin_activate' );

// Deactivation hook
register_deactivation_hook( __FILE__, 'news_plugin_deactivate' );

function news_post_type_plugin_activate() {

    wp_enqueue_style('style', plugins_url('/style.css', __FILE__));
    
    // Register News post type
    register_post_type( 'news_post_type', [
        'labels' => array(
            'name' => __( 'News' ),
            'singular_name' => __( 'News' ),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'taxonomy', 'tags' ),
    ] );

    // Register taxonomy
    register_taxonomy( 'news_taxonomy', array( 'news_post_type' ), [
        'labels' => array(
            'name' => __( 'News Category' ),
            'singular_name' => __( 'News Category' ),
        ),
        'show_ui' => true,
        'hierarchical' => true,
    ] );

    flush_rewrite_rules(); // Update permalinks
}

function news_plugin_deactivate() {
    // Unregister news post type
    unregister_post_type( 'news_post_type' );

    // Unregister taxonomy
    unregister_taxonomy( 'news_taxonomy' );

    flush_rewrite_rules(); // Update permalinks again
}