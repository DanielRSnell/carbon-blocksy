<?php
/**
 * Hero-2 Component Fields Definition
 * Split layout with image on one side, content on the other
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register component with dynamic system
umbral_register_component('Heroes', 'hero-2', [
    'label' => 'Hero Split Layout',
    'title' => 'Hero Split Layout',
    'description' => 'Split layout hero with image on one side and content on the other',
    'icon' => '🎭',
    'fields' => [
        'title' => [
            'type' => 'text',
            'label' => 'Main Title',
            'default' => 'Transform Your Business Today',
            'description' => 'The main headline for your hero section'
        ],
        'subtitle' => [
            'type' => 'textarea',
            'label' => 'Subtitle',
            'default' => 'Discover innovative solutions that will revolutionize the way you work and accelerate your success.',
            'description' => 'Supporting text that appears below the title'
        ],
        'hero_image' => [
            'type' => 'file',
            'label' => 'Hero Image',
            'description' => 'Image displayed on the right side of the hero section'
        ],
        'button_text' => [
            'type' => 'text',
            'label' => 'Button Text',
            'default' => 'Get Started',
            'description' => 'Text for the call-to-action button'
        ],
        'button_url' => [
            'type' => 'text_url',
            'label' => 'Button URL',
            'default' => '#',
            'description' => 'Link destination for the button'
        ],
        'secondary_button_text' => [
            'type' => 'text',
            'label' => 'Secondary Button Text',
            'default' => 'Learn More',
            'description' => 'Text for the secondary button (optional)'
        ],
        'secondary_button_url' => [
            'type' => 'text_url',
            'label' => 'Secondary Button URL',
            'default' => '#',
            'description' => 'Link destination for the secondary button'
        ],
        'layout' => [
            'type' => 'select',
            'label' => 'Layout Direction',
            'options' => [
                'image-right' => 'Image on Right',
                'image-left' => 'Image on Left'
            ],
            'default' => 'image-right',
            'description' => 'Choose which side the image appears on'
        ],
        'background_color' => [
            'type' => 'select',
            'label' => 'Background Color',
            'options' => [
                'white' => 'White',
                'light-gray' => 'Light Gray',
                'dark' => 'Dark',
                'gradient' => 'Gradient'
            ],
            'default' => 'white',
            'description' => 'Background color for the hero section'
        ]
    ]
]);