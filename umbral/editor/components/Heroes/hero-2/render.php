<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Component compiler utilities are loaded globally in the main plugin file

/**
 * Hero-2 Component Renderer
 * Split layout hero with image and content
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

// Prepare component context
$component_context = [
    'title' => $component_data['title'] ?? 'Transform Your Business Today',
    'subtitle' => $component_data['subtitle'] ?? 'Discover innovative solutions that will revolutionize the way you work and accelerate your success.',
    'hero_image' => $component_data['hero_image'] ?? null,
    'button_text' => $component_data['button_text'] ?? 'Get Started',
    'button_url' => $component_data['button_url'] ?? '#',
    'secondary_button_text' => $component_data['secondary_button_text'] ?? 'Learn More',
    'secondary_button_url' => $component_data['secondary_button_url'] ?? '#',
    'layout' => $component_data['layout'] ?? 'image-right',
    'background_color' => $component_data['background_color'] ?? 'white',
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
echo Timber::compile('@components/Heroes/hero-2/view.twig', $merged_context);