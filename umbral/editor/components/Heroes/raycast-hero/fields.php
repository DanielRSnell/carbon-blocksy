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
        '_ui_config' => [
            'style' => 'sections'
        ],
        '_panels' => [
            'content' => [
                'label' => 'Content & Interface',
                'icon' => '📝',
                'description' => 'Hero text content and command palette interface',
                'style' => 'tabs',
                'sub_panels' => [
                    'hero_content' => [
                        'label' => 'Hero Content',
                        'icon' => '📋',
                        'description' => 'Main title and subtitle'
                    ],
                    'command_interface' => [
                        'label' => 'Command Interface',
                        'icon' => '🔍',
                        'description' => 'Search bar and shortcuts configuration'
                    ],
                    'call_to_action' => [
                        'label' => 'Call to Action',
                        'icon' => '🎯',
                        'description' => 'CTA button configuration'
                    ]
                ]
            ],
            'features' => [
                'label' => 'Feature Cards',
                'icon' => '⭐',
                'description' => 'Floating feature cards displayed around the interface'
            ]
        ],

        // Hero Content
        'hero_title' => [
            'type' => 'text',
            'title' => 'Hero Title',
            'default' => 'Your work, supercharged',
            'description' => 'Primary headline for the hero section',
            'panel' => 'content',
            'sub_panel' => 'hero_content'
        ],
        'hero_subtitle' => [
            'type' => 'textarea',
            'title' => 'Hero Subtitle',
            'default' => 'A collection of powerful shortcuts, commands, and tools to streamline your workflow.',
            'description' => 'Supporting text below the main title',
            'panel' => 'content',
            'sub_panel' => 'hero_content'
        ],
        'title_alignment' => [
            'type' => 'select',
            'title' => 'Title Alignment',
            'options' => [
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ],
            'default' => 'center',
            'description' => 'Text alignment for hero titles',
            'panel' => 'content',
            'sub_panel' => 'hero_content'
        ],

        // Command Interface
        'search_placeholder' => [
            'type' => 'text',
            'title' => 'Search Placeholder',
            'default' => 'Search for anything...',
            'description' => 'Placeholder text in the search bar',
            'panel' => 'content',
            'sub_panel' => 'command_interface'
        ],
        'search_shortcut_key' => [
            'type' => 'text',
            'title' => 'Search Shortcut Display',
            'default' => '⌘K',
            'description' => 'Keyboard shortcut shown in search bar',
            'panel' => 'content',
            'sub_panel' => 'command_interface'
        ],
        'show_shortcuts_section' => [
            'type' => 'checkbox',
            'title' => 'Show Shortcuts Section',
            'default' => true,
            'description' => 'Display quick action shortcuts below search bar',
            'panel' => 'content',
            'sub_panel' => 'command_interface'
        ],
        'shortcuts' => [
            'type' => 'group',
            'title' => 'Search Shortcuts',
            'description' => 'Quick access items displayed below search bar',
            'repeatable' => true,
            'panel' => 'content',
            'sub_panel' => 'command_interface',
            'group_options' => [
                'group_title' => 'Shortcut {#}',
                'add_button' => 'Add Shortcut',
                'remove_button' => 'Remove Shortcut',
                'closed' => true,
                'sortable' => true,
                'limit' => 6
            ],
            'fields' => [
                'icon' => [
                    'type' => 'text',
                    'title' => 'Icon',
                    'default' => '⌘',
                    'description' => 'Emoji or icon for this shortcut'
                ],
                'text' => [
                    'type' => 'text',
                    'title' => 'Shortcut Text',
                    'default' => 'Quick Action',
                    'description' => 'Display text for the shortcut'
                ],
                'keystroke' => [
                    'type' => 'text',
                    'title' => 'Keystroke',
                    'default' => '⌘K',
                    'description' => 'Keyboard combination to trigger this action'
                ]
            ]
        ],

        // Call to Action
        'cta_text' => [
            'type' => 'text',
            'title' => 'Button Text',
            'default' => 'Get Started',
            'description' => 'Text for the call-to-action button',
            'panel' => 'content',
            'sub_panel' => 'call_to_action'
        ],
        'cta_url' => [
            'type' => 'text_url',
            'title' => 'Button URL',
            'default' => '#',
            'description' => 'Link destination for the CTA button',
            'panel' => 'content',
            'sub_panel' => 'call_to_action'
        ],
        'cta_style' => [
            'type' => 'select',
            'title' => 'Button Style',
            'options' => [
                'default' => 'Default',
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'glass' => 'Glass Effect'
            ],
            'default' => 'glass',
            'description' => 'Visual style for the CTA button',
            'panel' => 'content',
            'sub_panel' => 'call_to_action'
        ],
        'show_cta_arrow' => [
            'type' => 'checkbox',
            'title' => 'Show Arrow Icon',
            'default' => true,
            'description' => 'Display arrow icon in CTA button',
            'panel' => 'content',
            'sub_panel' => 'call_to_action'
        ],

        // Feature Cards
        'feature_cards' => [
            'type' => 'group',
            'title' => 'Feature Cards',
            'description' => 'Floating feature cards displayed around the command interface',
            'repeatable' => true,
            'panel' => 'features',
            'group_options' => [
                'group_title' => 'Feature Card {#}',
                'add_button' => 'Add Feature Card',
                'remove_button' => 'Remove Feature Card',
                'closed' => true,
                'sortable' => true,
                'limit' => 6
            ],
            'fields' => [
                'icon' => [
                    'type' => 'text',
                    'title' => 'Feature Icon',
                    'default' => '🚀',
                    'description' => 'Emoji or icon representing this feature'
                ],
                'title' => [
                    'type' => 'text',
                    'title' => 'Feature Title',
                    'default' => 'Feature Name',
                    'description' => 'Name of the feature'
                ],
                'description' => [
                    'type' => 'textarea',
                    'title' => 'Feature Description',
                    'default' => 'Brief feature description',
                    'description' => 'Short description of what this feature does'
                ]
            ]
        ],
        'cards_layout' => [
            'type' => 'select',
            'title' => 'Cards Layout',
            'options' => [
                'sides' => 'Left & Right Sides',
                'scattered' => 'Scattered Around',
                'grid_below' => 'Grid Below Interface'
            ],
            'default' => 'sides',
            'description' => 'How to position the feature cards',
            'panel' => 'features'
        ],
        'cards_animation' => [
            'type' => 'select',
            'title' => 'Cards Animation',
            'options' => [
                'none' => 'None',
                'fade_in' => 'Fade In',
                'slide_in' => 'Slide In',
                'float_up' => 'Float Up'
            ],
            'default' => 'slide_in',
            'description' => 'Animation effect for feature cards',
            'panel' => 'features'
        ]
    ]
]);