<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Component compiler utilities are loaded globally in the main plugin file

/**
 * Browse by Rooms Component Renderer
 * Room-based product browsing section with featured room and grid layout
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

// Process featured room data
$featured_room = [
    'name' => $component_data['featured_room_name'] ?? 'Living Room',
    'image_id' => $component_data['featured_room_image'] ?? null,
    'product_count' => $component_data['featured_room_product_count'] ?? 15,
    'url' => $component_data['featured_room_url'] ?? '/shop/living-room/',
    'alt_text' => $component_data['featured_room_name'] ?? 'Living Room'
];

// Process room grid items
$room_grid_items = $component_data['room_grid_items'] ?? [];
$processed_rooms = [];

if (!empty($room_grid_items) && is_array($room_grid_items)) {
    foreach ($room_grid_items as $room) {
        $processed_rooms[] = [
            'name' => $room['room_name'] ?? 'Room',
            'image_id' => $room['room_image'] ?? null,
            'product_count' => $room['product_count'] ?? 24,
            'url' => $room['room_url'] ?? '/shop/',
            'alt_text' => $room['room_name'] ?? 'Room'
        ];
    }
}

// Provide default room grid if none configured
if (empty($processed_rooms)) {
    $processed_rooms = [
        [
            'name' => 'Bedroom',
            'image_id' => null,
            'product_count' => 24,
            'url' => '/shop/bedroom/',
            'alt_text' => 'Bedroom'
        ],
        [
            'name' => 'Walk-in Closet',
            'image_id' => null,
            'product_count' => 30,
            'url' => '/shop/closet/',
            'alt_text' => 'Walk-in Closet'
        ],
        [
            'name' => 'Kitchen',
            'image_id' => null,
            'product_count' => 24,
            'url' => '/shop/kitchen/',
            'alt_text' => 'Kitchen'
        ]
    ];
}

// Process styling options
$card_border_radius_map = [
    'small' => '12px',
    'medium' => '20px',
    'large' => '24px',
    'extra_large' => '32px'
];

$selected_radius = $component_data['card_border_radius'] ?? 'large';
$border_radius = $card_border_radius_map[$selected_radius] ?? '24px';

// Prepare component context
$component_context = [
    'section_title' => $component_data['section_title'] ?? 'Browse by rooms',
    'section_description' => $component_data['section_description'] ?? 'Sit massa etiam urna id. Non pulvinar aenean ultrices lectus vitae imperdiet vulputate a eu. Aliquet ullamcorper leo mi vel sit pretium euismod eget.',
    'title_color' => $component_data['title_color'] ?? '#ffffff',
    'description_color' => $component_data['description_color'] ?? '#ffffff',
    'layout_style' => $component_data['layout_style'] ?? 'featured_left',
    'card_style' => $component_data['card_style'] ?? 'overlay',
    'featured_room' => $featured_room,
    'room_grid' => $processed_rooms,
    'background_color' => $component_data['background_color'] ?? '#2c3e2d',
    'card_overlay_color' => $component_data['card_overlay_color'] ?? 'rgba(0, 0, 0, 0.4)',
    'card_border_radius' => $border_radius,
    'hover_effect' => $component_data['hover_effect'] ?? 'lift',
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
echo Timber::compile('@components/Heroes/browse-rooms/view.twig', $merged_context);