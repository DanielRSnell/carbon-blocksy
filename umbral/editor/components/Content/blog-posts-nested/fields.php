<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register blog-posts-nested component
umbral_register_component('Content', 'blog-posts-nested', [
    'label' => 'Blog Posts (Nested)',
    'title' => 'Dynamic Blog Posts - Nested Sections + Tabs',
    'description' => 'Display dynamic blog posts with nested section and tab organization',
    'icon' => '📰',
    'fields' => [
        '_ui_config' => [
            'style' => 'sections'
        ],
        '_panels' => [
            'content' => [
                'label' => 'Content & Titles',
                'icon' => '📝',
                'description' => 'Section content, titles, and text settings',
                'style' => 'tabs',
                'sub_panels' => [
                    'titles' => [
                        'label' => 'Titles',
                        'icon' => '📋',
                        'description' => 'Main title and subtitle settings'
                    ],
                    'background' => [
                        'label' => 'Background',
                        'icon' => '🎨',
                        'description' => 'Background and styling options'
                    ]
                ]
            ],
            'query' => [
                'label' => 'Query & Filtering',
                'icon' => '🔍',
                'description' => 'Post selection, filtering, and ordering options',
                'style' => 'tabs',
                'sub_panels' => [
                    'source' => [
                        'label' => 'Source',
                        'icon' => '📊',
                        'description' => 'Post type and basic query settings'
                    ],
                    'filters' => [
                        'label' => 'Filters',
                        'icon' => '🔧',
                        'description' => 'Category, tag, and exclusion filters'
                    ],
                    'ordering' => [
                        'label' => 'Ordering',
                        'icon' => '📈',
                        'description' => 'Sort order and pagination settings'
                    ]
                ]
            ],
            'display' => [
                'label' => 'Display & Layout',
                'icon' => '🎨',
                'description' => 'Layout style and visibility settings',
                'style' => 'tabs',
                'sub_panels' => [
                    'layout' => [
                        'label' => 'Layout',
                        'icon' => '📐',
                        'description' => 'Grid, list, and column settings'
                    ],
                    'elements' => [
                        'label' => 'Elements',
                        'icon' => '🧩',
                        'description' => 'Show/hide post elements'
                    ],
                    'interaction' => [
                        'label' => 'Interaction',
                        'icon' => '🔗',
                        'description' => 'Buttons and interactive elements'
                    ]
                ]
            ]
        ],
        'section_title' => [
            'type' => 'text',
            'title' => 'Section Title',
            'description' => 'Optional title for the blog section',
            'default' => 'Latest Blog Posts',
            'panel' => 'content',
            'sub_panel' => 'titles',
        ],
        'section_subtitle' => [
            'type' => 'textarea',
            'title' => 'Section Subtitle',
            'description' => 'Optional subtitle or description for the section',
            'default' => 'Stay up to date with our latest news, insights, and updates.',
            'panel' => 'content',
            'sub_panel' => 'titles',
        ],
        'title_alignment' => [
            'type' => 'select',
            'title' => 'Title Alignment',
            'description' => 'Text alignment for titles',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'default' => 'center',
            'panel' => 'content',
            'sub_panel' => 'titles',
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
                'gradient' => 'Gradient',
            ],
            'default' => 'transparent',
            'panel' => 'content',
            'sub_panel' => 'background',
        ],
        'section_padding' => [
            'type' => 'select',
            'title' => 'Section Padding',
            'description' => 'Vertical padding for the section',
            'options' => [
                'none' => 'None',
                'small' => 'Small',
                'medium' => 'Medium',
                'large' => 'Large',
            ],
            'default' => 'medium',
            'panel' => 'content',
            'sub_panel' => 'background',
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
            'sub_panel' => 'source',
        ],
        'custom_post_type' => [
            'type' => 'text',
            'title' => 'Custom Post Type',
            'description' => 'Enter custom post type slug (only if "Custom Post Type" is selected above)',
            'default' => '',
            'panel' => 'query',
            'sub_panel' => 'source',
        ],
        'posts_per_page' => [
            'type' => 'number',
            'title' => 'Number of Posts',
            'description' => 'How many posts to display',
            'default' => 6,
            'min' => 1,
            'max' => 50,
            'panel' => 'query',
            'sub_panel' => 'source',
        ],
        'category_filter' => [
            'type' => 'text',
            'title' => 'Category Filter',
            'description' => 'Filter by category slug (leave empty for all categories)',
            'default' => '',
            'panel' => 'query',
            'sub_panel' => 'filters',
        ],
        'tag_filter' => [
            'type' => 'text',
            'title' => 'Tag Filter',
            'description' => 'Filter by tag slug (leave empty for all tags)',
            'default' => '',
            'panel' => 'query',
            'sub_panel' => 'filters',
        ],
        'exclude_posts' => [
            'type' => 'text',
            'title' => 'Exclude Posts',
            'description' => 'Comma-separated list of post IDs to exclude',
            'default' => '',
            'panel' => 'query',
            'sub_panel' => 'filters',
        ],
        'meta_filter_key' => [
            'type' => 'text',
            'title' => 'Meta Key Filter',
            'description' => 'Filter by custom meta key (advanced)',
            'default' => '',
            'panel' => 'query',
            'sub_panel' => 'filters',
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
            'sub_panel' => 'ordering',
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
            'sub_panel' => 'ordering',
        ],
        'offset' => [
            'type' => 'number',
            'title' => 'Offset',
            'description' => 'Number of posts to skip from the beginning',
            'default' => 0,
            'min' => 0,
            'panel' => 'query',
            'sub_panel' => 'ordering',
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
            'sub_panel' => 'layout',
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
            'sub_panel' => 'layout',
        ],
        'card_spacing' => [
            'type' => 'select',
            'title' => 'Card Spacing',
            'description' => 'Space between post cards',
            'options' => [
                'tight' => 'Tight',
                'normal' => 'Normal',
                'loose' => 'Loose',
            ],
            'default' => 'normal',
            'panel' => 'display',
            'sub_panel' => 'layout',
        ],
        'show_featured_image' => [
            'type' => 'checkbox',
            'title' => 'Show Featured Image',
            'description' => 'Display post featured images',
            'default' => true,
            'panel' => 'display',
            'sub_panel' => 'elements',
        ],
        'show_excerpt' => [
            'type' => 'checkbox',
            'title' => 'Show Excerpt',
            'description' => 'Display post excerpts',
            'default' => true,
            'panel' => 'display',
            'sub_panel' => 'elements',
        ],
        'excerpt_length' => [
            'type' => 'number',
            'title' => 'Excerpt Length',
            'description' => 'Number of words in excerpt',
            'default' => 30,
            'min' => 10,
            'max' => 100,
            'panel' => 'display',
            'sub_panel' => 'elements',
        ],
        'show_date' => [
            'type' => 'checkbox',
            'title' => 'Show Date',
            'description' => 'Display post publication date',
            'default' => true,
            'panel' => 'display',
            'sub_panel' => 'elements',
        ],
        'show_author' => [
            'type' => 'checkbox',
            'title' => 'Show Author',
            'description' => 'Display post author',
            'default' => true,
            'panel' => 'display',
            'sub_panel' => 'elements',
        ],
        'show_categories' => [
            'type' => 'checkbox',
            'title' => 'Show Categories',
            'description' => 'Display post categories',
            'default' => true,
            'panel' => 'display',
            'sub_panel' => 'elements',
        ],
        'show_read_more' => [
            'type' => 'checkbox',
            'title' => 'Show Read More',
            'description' => 'Display read more button',
            'default' => true,
            'panel' => 'display',
            'sub_panel' => 'interaction',
        ],
        'read_more_text' => [
            'type' => 'text',
            'title' => 'Read More Text',
            'description' => 'Text for the read more button',
            'default' => 'Read More',
            'panel' => 'display',
            'sub_panel' => 'interaction',
        ],
        'button_style' => [
            'type' => 'select',
            'title' => 'Button Style',
            'description' => 'Style for the read more button',
            'options' => [
                'text' => 'Text Link',
                'button' => 'Button',
                'pill' => 'Pill Button',
                'outline' => 'Outline Button',
            ],
            'default' => 'button',
            'panel' => 'display',
            'sub_panel' => 'interaction',
        ],
        'enable_hover_effects' => [
            'type' => 'checkbox',
            'title' => 'Enable Hover Effects',
            'description' => 'Add hover animations to post cards',
            'default' => true,
            'panel' => 'display',
            'sub_panel' => 'interaction',
        ],
    ],
]);