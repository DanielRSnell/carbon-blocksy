<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register blog-posts-sections component
umbral_register_component('Content', 'blog-posts-sections', [
    'label' => 'Blog Posts (Sections)',
    'title' => 'Dynamic Blog Posts - Sections Style',
    'description' => 'Display dynamic blog posts with advanced query controls and customizable layouts using sections UI',
    'icon' => '📰',
    'fields' => [
        '_ui_config' => [
            'style' => 'sections'
        ],
        '_panels' => [
            'content' => [
                'label' => 'Content',
                'icon' => '📝',
                'description' => 'Section title and content settings'
            ],
            'query' => [
                'label' => 'Query',
                'icon' => '🔍',
                'description' => 'Post type, filtering, and ordering options'
            ],
            'display' => [
                'label' => 'Display',
                'icon' => '🎨',
                'description' => 'Layout style and visibility settings'
            ]
        ],
        'section_title' => [
            'type' => 'text',
            'title' => 'Section Title',
            'description' => 'Optional title for the blog section',
            'default' => 'Latest Blog Posts',
            'panel' => 'content',
        ],
        'section_subtitle' => [
            'type' => 'textarea',
            'title' => 'Section Subtitle',
            'description' => 'Optional subtitle or description for the section',
            'default' => 'Stay up to date with our latest news, insights, and updates.',
            'panel' => 'content',
        ],
        'section_background' => [
            'type' => 'select',
            'title' => 'Section Background',
            'description' => 'Background color for the entire section',
            'options' => [
                'transparent' => 'Transparent',
                'white' => 'White',
                'light-gray' => 'Light Gray',
                'dark' => 'Dark',
            ],
            'default' => 'transparent',
            'panel' => 'content',
        ],
        'post_type' => [
            'type' => 'select',
            'title' => 'Post Type',
            'description' => 'Select which post type to display',
            'options' => [
                'post' => 'Blog Posts',
                'page' => 'Pages',
                'product' => 'Products (if WooCommerce)',
                'custom' => 'Custom Post Type',
            ],
            'default' => 'post',
            'panel' => 'query',
        ],
        'custom_post_type' => [
            'type' => 'text',
            'title' => 'Custom Post Type',
            'description' => 'Enter custom post type slug (only if "Custom Post Type" is selected above)',
            'default' => '',
            'panel' => 'query',
        ],
        'posts_per_page' => [
            'type' => 'number',
            'title' => 'Number of Posts',
            'description' => 'How many posts to display',
            'default' => 6,
            'min' => 1,
            'max' => 50,
            'panel' => 'query',
        ],
        'orderby' => [
            'type' => 'select',
            'title' => 'Order By',
            'description' => 'How to order the posts',
            'options' => [
                'date' => 'Date',
                'title' => 'Title',
                'menu_order' => 'Menu Order',
                'rand' => 'Random',
                'comment_count' => 'Comment Count',
                'modified' => 'Last Modified',
            ],
            'default' => 'date',
            'panel' => 'query',
        ],
        'order' => [
            'type' => 'select',
            'title' => 'Order Direction',
            'description' => 'Ascending or descending order',
            'options' => [
                'DESC' => 'Descending (newest first)',
                'ASC' => 'Ascending (oldest first)',
            ],
            'default' => 'DESC',
            'panel' => 'query',
        ],
        'category_filter' => [
            'type' => 'text',
            'title' => 'Category Filter',
            'description' => 'Filter by category slug (leave empty for all categories)',
            'default' => '',
            'panel' => 'query',
        ],
        'tag_filter' => [
            'type' => 'text',
            'title' => 'Tag Filter',
            'description' => 'Filter by tag slug (leave empty for all tags)',
            'default' => '',
            'panel' => 'query',
        ],
        'exclude_posts' => [
            'type' => 'text',
            'title' => 'Exclude Posts',
            'description' => 'Comma-separated list of post IDs to exclude',
            'default' => '',
            'panel' => 'query',
        ],
        'layout_style' => [
            'type' => 'select',
            'title' => 'Layout Style',
            'description' => 'Choose how to display the posts',
            'options' => [
                'grid' => 'Grid Layout',
                'list' => 'List Layout',
                'masonry' => 'Masonry Layout',
                'carousel' => 'Carousel Layout',
            ],
            'default' => 'grid',
            'panel' => 'display',
        ],
        'grid_columns' => [
            'type' => 'select',
            'title' => 'Grid Columns',
            'description' => 'Number of columns for grid layout',
            'options' => [
                '1' => '1 Column',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns',
            ],
            'default' => '3',
            'panel' => 'display',
        ],
        'show_featured_image' => [
            'type' => 'checkbox',
            'title' => 'Show Featured Image',
            'description' => 'Display post featured images',
            'default' => true,
            'panel' => 'display',
        ],
        'show_excerpt' => [
            'type' => 'checkbox',
            'title' => 'Show Excerpt',
            'description' => 'Display post excerpts',
            'default' => true,
            'panel' => 'display',
        ],
        'excerpt_length' => [
            'type' => 'number',
            'title' => 'Excerpt Length',
            'description' => 'Number of words in excerpt',
            'default' => 30,
            'min' => 10,
            'max' => 100,
            'panel' => 'display',
        ],
        'show_date' => [
            'type' => 'checkbox',
            'title' => 'Show Date',
            'description' => 'Display post publication date',
            'default' => true,
            'panel' => 'display',
        ],
        'show_author' => [
            'type' => 'checkbox',
            'title' => 'Show Author',
            'description' => 'Display post author',
            'default' => true,
            'panel' => 'display',
        ],
        'show_categories' => [
            'type' => 'checkbox',
            'title' => 'Show Categories',
            'description' => 'Display post categories',
            'default' => true,
            'panel' => 'display',
        ],
        'show_read_more' => [
            'type' => 'checkbox',
            'title' => 'Show Read More',
            'description' => 'Display read more button',
            'default' => true,
            'panel' => 'display',
        ],
        'read_more_text' => [
            'type' => 'text',
            'title' => 'Read More Text',
            'description' => 'Text for the read more button',
            'default' => 'Read More',
            'panel' => 'display',
        ],
    ],
]);