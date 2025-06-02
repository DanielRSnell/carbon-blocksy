<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register testimonials-grid component
umbral_register_component('Testimonials', 'testimonials-grid', [
    'label' => 'Testimonials Grid',
    'title' => 'Customer Testimonials Grid',
    'description' => 'Display multiple customer testimonials in a responsive grid layout',
    'icon' => '⭐',
    'fields' => [
        '_ui_config' => [
            'style' => 'accordion',
            'default_open' => ['content']
        ],
        '_panels' => [
            'content' => [
                'label' => 'Content',
                'icon' => '📝',
                'description' => 'Section content and testimonials'
            ],
            'display' => [
                'label' => 'Display',
                'icon' => '🎨',
                'description' => 'Layout and styling options'
            ]
        ],
        'section_title' => [
            'type' => 'text',
            'title' => 'Section Title',
            'description' => 'Optional title for the testimonials section',
            'default' => 'What Our Customers Say',
            'panel' => 'content',
        ],
        'section_subtitle' => [
            'type' => 'textarea',
            'title' => 'Section Subtitle',
            'description' => 'Optional subtitle or description for the section',
            'default' => 'See what our amazing customers have to say about their experience with our products and services.',
            'panel' => 'content',
        ],
        'testimonials' => [
            'type' => 'group',
            'title' => 'Testimonials',
            'description' => 'Add customer testimonials',
            'repeatable' => true,
            'panel' => 'content',
            'fields' => [
                'quote' => [
                    'type' => 'textarea',
                    'title' => 'Quote',
                    'description' => 'The testimonial quote text',
                ],
                'author_name' => [
                    'type' => 'text',
                    'title' => 'Author Name',
                    'description' => 'Name of the person giving the testimonial',
                ],
                'author_title' => [
                    'type' => 'text',
                    'title' => 'Author Title',
                    'description' => 'Job title or position of the author',
                ],
                'author_image' => [
                    'type' => 'file',
                    'title' => 'Author Photo',
                    'description' => 'Photo of the testimonial author',
                    'query_args' => [
                        'type' => 'image',
                    ],
                ],
                'rating' => [
                    'type' => 'select',
                    'title' => 'Star Rating',
                    'description' => 'Number of stars for the review',
                    'options' => [
                        '5' => '5 Stars',
                        '4' => '4 Stars',
                        '3' => '3 Stars',
                        '2' => '2 Stars',
                        '1' => '1 Star',
                    ],
                    'default' => '5',
                ],
                'company_logo' => [
                    'type' => 'file',
                    'title' => 'Company Logo',
                    'description' => 'Optional company logo',
                    'query_args' => [
                        'type' => 'image',
                    ],
                ],
            ],
        ],
        'grid_columns' => [
            'type' => 'select',
            'title' => 'Grid Columns',
            'description' => 'Number of columns for larger screens',
            'options' => [
                '1' => '1 Column',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns',
            ],
            'default' => '3',
            'panel' => 'display',
        ],
        'card_style' => [
            'type' => 'select',
            'title' => 'Card Style',
            'description' => 'Visual style for all testimonial cards',
            'options' => [
                'card' => 'Card Style',
                'minimal' => 'Minimal Style',
                'featured' => 'Featured Style',
            ],
            'default' => 'card',
            'panel' => 'display',
        ],
        'background_color' => [
            'type' => 'select',
            'title' => 'Card Background',
            'description' => 'Background color for testimonial cards',
            'options' => [
                'white' => 'White',
                'light-gray' => 'Light Gray',
                'blue' => 'Blue Gradient',
                'purple' => 'Purple Gradient',
            ],
            'default' => 'white',
            'panel' => 'display',
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
            'panel' => 'display',
        ],
    ],
]);