<?php
/**
 * Hero-1 Component Fields Definition
 * Full-width hero section with background image overlay
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register component with dynamic system
umbral_register_component('Heroes', 'hero-1', [
    'label' => 'Hero Banner',
    'title' => 'Hero Banner',
    'description' => 'Full-width hero section with title, subtitle, button and background image',
    'icon' => '🎯',
    'fields' => [
        'title' => [
            'type' => 'text',
            'label' => 'Hero Title',
            'default' => 'Welcome to Our Amazing Site',
            'description' => 'The main headline for your hero section'
        ],
        'subtitle' => [
            'type' => 'textarea',
            'label' => 'Hero Subtitle',
            'default' => 'Discover the possibilities and transform your experience with our innovative solutions.',
            'description' => 'Supporting text that appears below the title'
        ],
        'background_image' => [
            'type' => 'file',
            'label' => 'Background Image',
            'description' => 'Background image for the hero section (recommended: 1920x1080px)'
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
        'text_color' => [
            'type' => 'select',
            'label' => 'Text Color',
            'options' => [
                'white' => 'White',
                'dark' => 'Dark',
                'custom' => 'Custom'
            ],
            'default' => 'white',
            'description' => 'Color scheme for the text content'
        ],
        'overlay_opacity' => [
            'type' => 'select',
            'label' => 'Background Overlay',
            'options' => [
                '0' => 'None',
                '0.3' => 'Light (30%)',
                '0.5' => 'Medium (50%)',
                '0.7' => 'Dark (70%)'
            ],
            'default' => '0.5',
            'description' => 'Dark overlay to improve text readability'
        ],
        'height' => [
            'type' => 'select',
            'label' => 'Hero Height',
            'options' => [
                'small' => 'Small (400px)',
                'medium' => 'Medium (600px)',
                'large' => 'Large (800px)',
                'fullscreen' => 'Full Screen'
            ],
            'default' => 'large',
            'description' => 'Height of the hero section'
        ]
    ]
]);
