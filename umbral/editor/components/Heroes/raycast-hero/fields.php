<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register Raycast-inspired hero component
umbral_register_component('Heroes', 'raycast-hero', [
    'label' => 'Raycast Hero',
    'title' => 'Raycast Hero',
    'description' => 'Modern command palette-style hero with search interface and gradient background',
    'icon' => '⚡',
    'fields' => [
        'title' => [
            'type' => 'text',
            'label' => 'Main Title',
            'default' => 'Your work, supercharged',
            'description' => 'Primary headline for the hero section'
        ],
        'subtitle' => [
            'type' => 'textarea',
            'label' => 'Subtitle',
            'default' => 'A collection of powerful shortcuts, commands, and tools to streamline your workflow.',
            'description' => 'Supporting text below the main title'
        ],
        'search_placeholder' => [
            'type' => 'text',
            'label' => 'Search Placeholder',
            'default' => 'Search for anything...',
            'description' => 'Placeholder text in the search bar'
        ],
        'shortcuts' => [
            'type' => 'group',
            'title' => 'Search Shortcuts',
            'description' => 'Quick access items displayed below search bar',
            'repeatable' => true,
            'fields' => [
                'icon' => [
                    'type' => 'text',
                    'title' => 'Icon',
                    'default' => '⌘'
                ],
                'text' => [
                    'type' => 'text',
                    'title' => 'Shortcut Text',
                    'default' => 'Quick Action'
                ],
                'keystroke' => [
                    'type' => 'text',
                    'title' => 'Keystroke',
                    'default' => '⌘K'
                ]
            ]
        ],
        'feature_cards' => [
            'type' => 'group',
            'title' => 'Feature Cards',
            'description' => 'Floating feature cards around the interface',
            'repeatable' => true,
            'fields' => [
                'icon' => [
                    'type' => 'text',
                    'title' => 'Icon',
                    'default' => '🚀'
                ],
                'title' => [
                    'type' => 'text',
                    'title' => 'Card Title',
                    'default' => 'Feature Name'
                ],
                'description' => [
                    'type' => 'textarea',
                    'title' => 'Description',
                    'default' => 'Brief feature description'
                ]
            ]
        ],
        'cta_text' => [
            'type' => 'text',
            'label' => 'CTA Button Text',
            'default' => 'Get Started',
            'description' => 'Call-to-action button text'
        ],
        'cta_url' => [
            'type' => 'text_url',
            'label' => 'CTA Button URL',
            'default' => '#',
            'description' => 'Call-to-action button link'
        ]
    ]
]);