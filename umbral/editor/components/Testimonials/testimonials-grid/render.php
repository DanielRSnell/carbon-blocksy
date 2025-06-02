<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Component compiler utilities are loaded globally in the main plugin file

/**
 * Testimonials Grid Component Renderer
 * Multiple customer testimonials in a responsive grid layout
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

// Process testimonials data
$testimonials = $component_data['testimonials'] ?? [];

// Add default testimonials if none provided
if (empty($testimonials)) {
    $testimonials = [
        [
            'quote' => 'This product has completely transformed our business. The results exceeded our expectations and the support team is outstanding.',
            'author_name' => 'Sarah Johnson',
            'author_title' => 'CEO, TechCorp',
            'rating' => '5',
        ],
        [
            'quote' => 'Amazing quality and incredible customer service. I would highly recommend this to anyone looking for a reliable solution.',
            'author_name' => 'Mike Chen',
            'author_title' => 'Marketing Director, StartupXYZ',
            'rating' => '5',
        ],
        [
            'quote' => 'The ease of use and powerful features make this an essential tool for our team. Game changer!',
            'author_name' => 'Emily Rodriguez',
            'author_title' => 'Product Manager, InnovateCorp',
            'rating' => '4',
        ],
    ];
}

// Prepare component context
$component_context = [
    'section_title' => $component_data['section_title'] ?? 'What Our Customers Say',
    'section_subtitle' => $component_data['section_subtitle'] ?? 'See what our amazing customers have to say about their experience with our products and services.',
    'testimonials' => $testimonials,
    'grid_columns' => $component_data['grid_columns'] ?? '3',
    'card_style' => $component_data['card_style'] ?? 'card',
    'background_color' => $component_data['background_color'] ?? 'white',
    'section_background' => $component_data['section_background'] ?? 'transparent',
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
echo Timber::compile('@components/Testimonials/testimonials-grid/view.twig', $merged_context);