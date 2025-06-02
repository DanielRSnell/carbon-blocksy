<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Component compiler utilities are loaded globally in the main plugin file

/**
 * Blog Posts Component Renderer
 * Dynamic blog posts with query controls and customizable layouts
 * 
 * @param array $context Timber context passed from block
 * @param array $component_data Component field data
 * @param array $breakpoints Available breakpoints for responsive styles
 * 
 * @return string Rendered component HTML
 */

// Get component directory for file paths
$component_dir = dirname(__FILE__);
$component_name = basename($component_dir);
$category_name = basename(dirname($component_dir));

// Build query arguments
$query_args = [
    'post_status' => 'publish',
    'posts_per_page' => $component_data['posts_per_page'] ?? 6,
    'orderby' => $component_data['orderby'] ?? 'date',
    'order' => $component_data['order'] ?? 'DESC',
];

// Set post type
$post_type = $component_data['post_type'] ?? 'post';
if ($post_type === 'custom' && !empty($component_data['custom_post_type'])) {
    $query_args['post_type'] = $component_data['custom_post_type'];
} else {
    $query_args['post_type'] = $post_type;
}

// Add category filter
if (!empty($component_data['category_filter'])) {
    if ($post_type === 'post') {
        $query_args['category_name'] = $component_data['category_filter'];
    } else {
        // For custom post types, you might need to adjust this
        $query_args['meta_query'] = [
            [
                'key' => 'category',
                'value' => $component_data['category_filter'],
                'compare' => 'LIKE'
            ]
        ];
    }
}

// Add tag filter
if (!empty($component_data['tag_filter'])) {
    if ($post_type === 'post') {
        $query_args['tag'] = $component_data['tag_filter'];
    }
}

// Exclude posts
if (!empty($component_data['exclude_posts'])) {
    $exclude_ids = array_map('trim', explode(',', $component_data['exclude_posts']));
    $exclude_ids = array_filter($exclude_ids, 'is_numeric');
    if (!empty($exclude_ids)) {
        $query_args['post__not_in'] = $exclude_ids;
    }
}

// Execute query
$posts_query = new WP_Query($query_args);
$posts = [];

if ($posts_query->have_posts()) {
    while ($posts_query->have_posts()) {
        $posts_query->the_post();
        $post_id = get_the_ID();
        
        // Prepare post data
        $post_data = [
            'id' => $post_id,
            'title' => get_the_title(),
            'permalink' => get_permalink(),
            'excerpt' => '',
            'featured_image' => null,
            'date' => get_the_date('F j, Y'),
            'author' => get_the_author(),
            'categories' => [],
        ];
        
        // Get excerpt
        if ($component_data['show_excerpt'] ?? true) {
            $excerpt_length = $component_data['excerpt_length'] ?? 30;
            if (has_excerpt()) {
                $post_data['excerpt'] = wp_trim_words(get_the_excerpt(), $excerpt_length, '...');
            } else {
                $post_data['excerpt'] = wp_trim_words(get_the_content(), $excerpt_length, '...');
            }
        }
        
        // Get featured image
        if ($component_data['show_featured_image'] ?? true) {
            if (has_post_thumbnail()) {
                $post_data['featured_image'] = get_post_thumbnail_id();
            }
        }
        
        // Get categories
        if ($component_data['show_categories'] ?? true) {
            if ($post_type === 'post') {
                $categories = get_the_category();
                foreach ($categories as $category) {
                    $post_data['categories'][] = [
                        'name' => $category->name,
                        'url' => get_category_link($category->term_id),
                    ];
                }
            }
        }
        
        $posts[] = $post_data;
    }
    wp_reset_postdata();
}

// Prepare component context
$component_context = [
    'section_title' => $component_data['section_title'] ?? 'Latest Blog Posts',
    'section_subtitle' => $component_data['section_subtitle'] ?? 'Stay up to date with our latest news, insights, and updates.',
    'posts' => $posts,
    'layout_style' => $component_data['layout_style'] ?? 'grid',
    'grid_columns' => $component_data['grid_columns'] ?? '3',
    'show_featured_image' => $component_data['show_featured_image'] ?? true,
    'show_excerpt' => $component_data['show_excerpt'] ?? true,
    'show_date' => $component_data['show_date'] ?? true,
    'show_author' => $component_data['show_author'] ?? true,
    'show_categories' => $component_data['show_categories'] ?? true,
    'show_read_more' => $component_data['show_read_more'] ?? true,
    'read_more_text' => $component_data['read_more_text'] ?? 'Read More',
    'section_background' => $component_data['section_background'] ?? 'transparent',
    'component_id' => $category_name . '-' . $component_name
];

// Get breakpoints system for dynamic CSS compilation
$breakpoints_manager = UmbralEditor_Breakpoints::getInstance();
$all_breakpoints = $breakpoints_manager->getBreakpoints();

// Compile component styles and scripts
$compiled_styles = compile_component_styles($category_name, $component_name, $component_context, $all_breakpoints, $breakpoints_manager);
$compiled_scripts = compile_component_scripts($category_name, $component_name, $component_context);

// Add compiled assets to context
$component_context['compiled_styles'] = $compiled_styles;
$component_context['compiled_scripts'] = $compiled_scripts;

// Merge with main context
$merged_context = array_merge($context, $component_context);

// Render component using Timber
echo Timber::compile('@components/Content/blog-posts/view.twig', $merged_context);