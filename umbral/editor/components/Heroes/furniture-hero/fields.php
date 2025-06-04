<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register furniture-hero component
umbral_register_component('Heroes', 'furniture-hero', [
    'label' => 'Furniture Hero',
    'title' => 'Furniture Hero Section',
    'description' => 'Modern furniture hero section with product showcase and promotional cards',
    'icon' => '🛋️',
    'fields' => [
        '_ui_config' => [
            'style' => 'sections'
        ],
        '_panels' => [
            'content' => [
                'label' => 'Content & CTA',
                'icon' => '📝',
                'description' => 'Hero text content, expert section, and call-to-action',
                'style' => 'tabs',
                'sub_panels' => [
                    'hero_content' => [
                        'label' => 'Hero Content',
                        'icon' => '📋',
                        'description' => 'Main title and subtitle content'
                    ],
                    'expert_section' => [
                        'label' => 'Expert Section',
                        'icon' => '👥',
                        'description' => 'Expert avatars and contact information'
                    ],
                    'call_to_action' => [
                        'label' => 'Call to Action',
                        'icon' => '🎯',
                        'description' => 'Primary CTA button configuration'
                    ]
                ]
            ],
            'products' => [
                'label' => 'Product Showcase',
                'icon' => '🛋️',
                'description' => 'Featured product cards with images and details',
                'style' => 'tabs',
                'sub_panels' => [
                    'product_1' => [
                        'label' => 'Product 1',
                        'icon' => '🪑',
                        'description' => 'First featured product configuration'
                    ],
                    'product_2' => [
                        'label' => 'Product 2', 
                        'icon' => '🛏️',
                        'description' => 'Second featured product configuration'
                    ],
                    'product_settings' => [
                        'label' => 'Display Settings',
                        'icon' => '⚙️',
                        'description' => 'Product showcase layout and behavior'
                    ]
                ]
            ],
            'promotion' => [
                'label' => 'Promotional Card',
                'icon' => '🎯',
                'description' => 'Special offer promotional card content and styling',
                'style' => 'tabs',
                'sub_panels' => [
                    'promo_content' => [
                        'label' => 'Promo Content',
                        'icon' => '💬',
                        'description' => 'Promotional text and messaging'
                    ],
                    'promo_styling' => [
                        'label' => 'Styling & CTA',
                        'icon' => '🎨',
                        'description' => 'Visual style and call-to-action button'
                    ]
                ]
            ]
        ],
        'title' => [
            'type' => 'text',
            'title' => 'Hero Title',
            'description' => 'Primary headline for the hero section',
            'default' => 'Exquisite design combined with functionalities',
            'panel' => 'content',
            'sub_panel' => 'hero_content',
        ],
        'subtitle' => [
            'type' => 'textarea',
            'title' => 'Hero Subtitle',
            'description' => 'Supporting text below the main title',
            'default' => 'Pellentesque ullamcorper dignissim condimentum volutpat consequat mauris nunc lacinia quis.',
            'panel' => 'content',
            'sub_panel' => 'hero_content',
        ],
        'title_alignment' => [
            'type' => 'select',
            'title' => 'Title Alignment',
            'description' => 'Text alignment for hero titles',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            'default' => 'left',
            'panel' => 'content',
            'sub_panel' => 'hero_content',
        ],
        'expert_avatar_1' => [
            'type' => 'file',
            'title' => 'Expert Avatar 1',
            'description' => 'First expert avatar image (recommended 30x48px)',
            'panel' => 'content',
            'sub_panel' => 'expert_section',
        ],
        'expert_avatar_2' => [
            'type' => 'file',
            'title' => 'Expert Avatar 2',
            'description' => 'Second expert avatar image (recommended 30x48px)',
            'panel' => 'content',
            'sub_panel' => 'expert_section',
        ],
        'expert_avatar_3' => [
            'type' => 'file',
            'title' => 'Expert Avatar 3',
            'description' => 'Third expert avatar image (recommended 30x48px)',
            'panel' => 'content',
            'sub_panel' => 'expert_section',
        ],
        'expert_text' => [
            'type' => 'text',
            'title' => 'Expert Contact Text',
            'description' => 'Text displayed next to expert avatars',
            'default' => 'Contact with our expert',
            'panel' => 'content',
            'sub_panel' => 'expert_section',
        ],
        'show_expert_section' => [
            'type' => 'checkbox',
            'title' => 'Show Expert Section',
            'description' => 'Display the expert contact section',
            'default' => true,
            'panel' => 'content',
            'sub_panel' => 'expert_section',
        ],
        'cta_text' => [
            'type' => 'text',
            'title' => 'Button Text',
            'description' => 'Text for the call-to-action button',
            'default' => 'Shop Now',
            'panel' => 'content',
            'sub_panel' => 'call_to_action',
        ],
        'cta_url' => [
            'type' => 'text_url',
            'title' => 'Button URL',
            'description' => 'Link destination for the CTA button',
            'default' => '/shop/',
            'panel' => 'content',
            'sub_panel' => 'call_to_action',
        ],
        'cta_style' => [
            'type' => 'select',
            'title' => 'Button Style',
            'description' => 'Visual style for the CTA button',
            'options' => [
                'default' => 'Default',
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'outline' => 'Outline',
            ],
            'default' => 'primary',
            'panel' => 'content',
            'sub_panel' => 'call_to_action',
        ],
        'cta_size' => [
            'type' => 'select',
            'title' => 'Button Size',
            'description' => 'Size of the CTA button',
            'options' => [
                'small' => 'Small',
                'medium' => 'Medium',
                'large' => 'Large',
            ],
            'default' => 'medium',
            'panel' => 'content',
            'sub_panel' => 'call_to_action',
        ],
        'product_1_name' => [
            'type' => 'text',
            'title' => 'Product Name',
            'description' => 'Name of the first product',
            'default' => 'Wooden Chair',
            'panel' => 'products',
            'sub_panel' => 'product_1',
        ],
        'product_1_price' => [
            'type' => 'text',
            'title' => 'Product Price',
            'description' => 'Price of the first product',
            'default' => '$199',
            'panel' => 'products',
            'sub_panel' => 'product_1',
        ],
        'product_1_image' => [
            'type' => 'file',
            'title' => 'Background Image',
            'description' => 'Background image for first product card (recommended 600x800px)',
            'panel' => 'products',
            'sub_panel' => 'product_1',
        ],
        'product_1_url' => [
            'type' => 'text_url',
            'title' => 'Product URL',
            'description' => 'Link for the first product',
            'default' => '/shop/',
            'panel' => 'products',
            'sub_panel' => 'product_1',
        ],
        'product_1_description' => [
            'type' => 'textarea',
            'title' => 'Product Description',
            'description' => 'Optional short description for the product',
            'default' => '',
            'panel' => 'products',
            'sub_panel' => 'product_1',
        ],
        'product_2_name' => [
            'type' => 'text',
            'title' => 'Product Name',
            'description' => 'Name of the second product',
            'default' => 'Pretium Elite',
            'panel' => 'products',
            'sub_panel' => 'product_2',
        ],
        'product_2_price' => [
            'type' => 'text',
            'title' => 'Product Price',
            'description' => 'Price of the second product',
            'default' => '$130',
            'panel' => 'products',
            'sub_panel' => 'product_2',
        ],
        'product_2_image' => [
            'type' => 'file',
            'title' => 'Background Image',
            'description' => 'Background image for second product card (recommended 600x400px)',
            'panel' => 'products',
            'sub_panel' => 'product_2',
        ],
        'product_2_url' => [
            'type' => 'text_url',
            'title' => 'Product URL',
            'description' => 'Link for the second product',
            'default' => '/shop/',
            'panel' => 'products',
            'sub_panel' => 'product_2',
        ],
        'product_2_description' => [
            'type' => 'textarea',
            'title' => 'Product Description',
            'description' => 'Optional short description for the product',
            'default' => '',
            'panel' => 'products',
            'sub_panel' => 'product_2',
        ],
        'product_card_style' => [
            'type' => 'select',
            'title' => 'Product Card Style',
            'description' => 'Visual style for product cards',
            'options' => [
                'default' => 'Default',
                'modern' => 'Modern',
                'minimal' => 'Minimal',
                'elevated' => 'Elevated',
            ],
            'default' => 'default',
            'panel' => 'products',
            'sub_panel' => 'product_settings',
        ],
        'product_hover_effect' => [
            'type' => 'select',
            'title' => 'Hover Effect',
            'description' => 'Hover animation for product cards',
            'options' => [
                'none' => 'None',
                'lift' => 'Lift Up',
                'zoom' => 'Zoom In',
                'tilt' => 'Slight Tilt',
            ],
            'default' => 'lift',
            'panel' => 'products',
            'sub_panel' => 'product_settings',
        ],
        'show_product_descriptions' => [
            'type' => 'checkbox',
            'title' => 'Show Product Descriptions',
            'description' => 'Display product descriptions on cards',
            'default' => false,
            'panel' => 'products',
            'sub_panel' => 'product_settings',
        ],
        'promo_title' => [
            'type' => 'text',
            'title' => 'Promotion Title',
            'description' => 'Title for the promotional card',
            'default' => '25% OFF',
            'panel' => 'promotion',
            'sub_panel' => 'promo_content',
        ],
        'promo_title_color' => [
            'type' => 'colorpicker',
            'title' => 'Title Color',
            'description' => 'Custom color for the promotion title text',
            'default' => '#ffffff',
            'panel' => 'promotion',
            'sub_panel' => 'promo_content',
        ],
        'promo_description' => [
            'type' => 'textarea',
            'title' => 'Promotion Description',
            'description' => 'Description text for the promotional card',
            'default' => 'Donec ac odio tempor dapibus.',
            'panel' => 'promotion',
            'sub_panel' => 'promo_content',
        ],
        'promo_badge_text' => [
            'type' => 'text',
            'title' => 'Badge Text',
            'description' => 'Optional badge text (e.g., "LIMITED TIME")',
            'default' => '',
            'panel' => 'promotion',
            'sub_panel' => 'promo_content',
        ],
        'promo_button_text' => [
            'type' => 'text',
            'title' => 'Button Text',
            'description' => 'Text for the promotion button',
            'default' => 'Explore Now',
            'panel' => 'promotion',
            'sub_panel' => 'promo_styling',
        ],
        'promo_button_url' => [
            'type' => 'text_url',
            'title' => 'Button URL',
            'description' => 'Link for the promotion button',
            'default' => '/shop/',
            'panel' => 'promotion',
            'sub_panel' => 'promo_styling',
        ],
        'promo_style' => [
            'type' => 'select',
            'title' => 'Card Style',
            'description' => 'Visual style for the promotional card',
            'options' => [
                'default' => 'Default',
                'gradient' => 'Gradient',
                'dark' => 'Dark Theme',
                'accent' => 'Accent Color',
            ],
            'default' => 'default',
            'panel' => 'promotion',
            'sub_panel' => 'promo_styling',
        ],
        'promo_animation' => [
            'type' => 'select',
            'title' => 'Card Animation',
            'description' => 'Animation effect for the promotional card',
            'options' => [
                'none' => 'None',
                'pulse' => 'Pulse',
                'float' => 'Float',
                'glow' => 'Glow',
            ],
            'default' => 'none',
            'panel' => 'promotion',
            'sub_panel' => 'promo_styling',
        ],
    ],
]);