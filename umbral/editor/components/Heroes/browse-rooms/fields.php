<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register browse-rooms component
umbral_register_component('Heroes', 'browse-rooms', [
    'label' => 'Browse by Rooms',
    'title' => 'Browse by Rooms',
    'description' => 'Showcase furniture organized by room categories with beautiful imagery',
    'icon' => '🏠',
    'fields' => [
        '_ui_config' => [
            'style' => 'sections'
        ],
        '_panels' => [
            'content' => [
                'label' => 'Content & Layout',
                'icon' => '📝',
                'description' => 'Section content and room configuration',
                'style' => 'tabs',
                'sub_panels' => [
                    'section_content' => [
                        'label' => 'Section Content',
                        'icon' => '📋',
                        'description' => 'Title and description'
                    ],
                    'room_layout' => [
                        'label' => 'Room Layout',
                        'icon' => '📐',
                        'description' => 'Grid and display settings'
                    ]
                ]
            ],
            'rooms' => [
                'label' => 'Room Categories',
                'icon' => '🏠',
                'description' => 'Configure individual room categories',
                'style' => 'tabs',
                'sub_panels' => [
                    'featured_room' => [
                        'label' => 'Featured Room (Large)',
                        'icon' => '⭐',
                        'description' => 'Main large room card'
                    ],
                    'room_grid' => [
                        'label' => 'Room Grid (Small)',
                        'icon' => '▦',
                        'description' => 'Grid of smaller room cards'
                    ]
                ]
            ],
            'styling' => [
                'label' => 'Visual Design',
                'icon' => '🎨',
                'description' => 'Colors, spacing, and visual effects'
            ]
        ],

        // Section Content
        'section_title' => [
            'type' => 'text',
            'title' => 'Section Title',
            'default' => 'Browse by rooms',
            'description' => 'Main heading for the rooms section',
            'panel' => 'content',
            'sub_panel' => 'section_content'
        ],
        'section_description' => [
            'type' => 'textarea',
            'title' => 'Section Description',
            'default' => 'Sit massa etiam urna id. Non pulvinar aenean ultrices lectus vitae imperdiet vulputate a eu. Aliquet ullamcorper leo mi vel sit pretium euismod eget.',
            'description' => 'Supporting text below the title',
            'panel' => 'content',
            'sub_panel' => 'section_content'
        ],
        'title_color' => [
            'type' => 'colorpicker',
            'title' => 'Title Color',
            'default' => '#ffffff',
            'description' => 'Color for the section title',
            'panel' => 'content',
            'sub_panel' => 'section_content'
        ],
        'description_color' => [
            'type' => 'colorpicker',
            'title' => 'Description Color',
            'default' => '#ffffff',
            'description' => 'Color for the section description',
            'panel' => 'content',
            'sub_panel' => 'section_content'
        ],

        // Room Layout Settings
        'layout_style' => [
            'type' => 'select',
            'title' => 'Layout Style',
            'options' => [
                'featured_left' => 'Featured Room Left',
                'featured_right' => 'Featured Room Right',
                'centered' => 'Centered Layout'
            ],
            'default' => 'featured_left',
            'description' => 'Choose how to arrange the room cards',
            'panel' => 'content',
            'sub_panel' => 'room_layout'
        ],
        'card_style' => [
            'type' => 'select',
            'title' => 'Card Style',
            'options' => [
                'overlay' => 'Text Overlay',
                'bottom' => 'Text Below Image',
                'corner' => 'Corner Badge'
            ],
            'default' => 'overlay',
            'description' => 'How to display room names and product counts',
            'panel' => 'content',
            'sub_panel' => 'room_layout'
        ],

        // Featured Room (Large Card)
        'featured_room_name' => [
            'type' => 'text',
            'title' => 'Room Name',
            'default' => 'Living Room',
            'description' => 'Name of the featured room',
            'panel' => 'rooms',
            'sub_panel' => 'featured_room'
        ],
        'featured_room_image' => [
            'type' => 'file',
            'title' => 'Room Image',
            'description' => 'Large background image for the featured room',
            'query_args' => ['type' => 'image'],
            'panel' => 'rooms',
            'sub_panel' => 'featured_room'
        ],
        'featured_room_product_count' => [
            'type' => 'number',
            'title' => 'Product Count',
            'default' => 15,
            'min' => 0,
            'description' => 'Number of products in this room category',
            'panel' => 'rooms',
            'sub_panel' => 'featured_room'
        ],
        'featured_room_url' => [
            'type' => 'text_url',
            'title' => 'Room URL',
            'default' => '/shop/living-room/',
            'description' => 'Link to the room category page',
            'panel' => 'rooms',
            'sub_panel' => 'featured_room'
        ],

        // Room Grid (Multiple Small Cards)
        'room_grid_items' => [
            'type' => 'group',
            'title' => 'Room Categories',
            'description' => 'Add room categories for the grid',
            'repeatable' => true,
            'panel' => 'rooms',
            'sub_panel' => 'room_grid',
            'group_options' => [
                'group_title' => 'Room {#}',
                'add_button' => 'Add Room',
                'remove_button' => 'Remove Room',
                'closed' => true,
                'sortable' => true,
                'limit' => 6
            ],
            'fields' => [
                'room_name' => [
                    'type' => 'text',
                    'title' => 'Room Name',
                    'description' => 'Name of this room category'
                ],
                'room_image' => [
                    'type' => 'file',
                    'title' => 'Room Image',
                    'description' => 'Background image for this room',
                    'query_args' => ['type' => 'image']
                ],
                'product_count' => [
                    'type' => 'number',
                    'title' => 'Product Count',
                    'default' => 24,
                    'min' => 0,
                    'description' => 'Number of products in this category'
                ],
                'room_url' => [
                    'type' => 'text_url',
                    'title' => 'Room URL',
                    'description' => 'Link to this room category page'
                ]
            ]
        ],

        // Styling Options
        'background_color' => [
            'type' => 'colorpicker',
            'title' => 'Background Color',
            'default' => '#2c3e2d',
            'description' => 'Background color for the entire section',
            'panel' => 'styling'
        ],
        'card_overlay_color' => [
            'type' => 'colorpicker',
            'title' => 'Card Overlay Color',
            'default' => 'rgba(0, 0, 0, 0.4)',
            'description' => 'Overlay color for better text readability',
            'panel' => 'styling'
        ],
        'card_border_radius' => [
            'type' => 'select',
            'title' => 'Card Border Radius',
            'options' => [
                'small' => 'Small (12px)',
                'medium' => 'Medium (20px)',
                'large' => 'Large (24px)',
                'extra_large' => 'Extra Large (32px)'
            ],
            'default' => 'large',
            'description' => 'Roundness of the room cards',
            'panel' => 'styling'
        ],
        'hover_effect' => [
            'type' => 'select',
            'title' => 'Hover Effect',
            'options' => [
                'none' => 'None',
                'lift' => 'Lift Up',
                'scale' => 'Scale Up',
                'fade' => 'Fade Overlay'
            ],
            'default' => 'lift',
            'description' => 'Interactive effect when hovering over cards',
            'panel' => 'styling'
        ]
    ]
]);