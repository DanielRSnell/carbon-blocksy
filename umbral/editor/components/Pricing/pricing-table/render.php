<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Component compiler utilities are loaded globally in the main plugin file

/**
 * Pricing Card Component Renderer
 * Pricing plan card with features, pricing, and call-to-action
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

// Process features list
$features_text = $component_data['features'] ?? "10 GB Storage\n100 Email Accounts\n24/7 Support\nAdvanced Analytics\nCustom Integrations";
$features_array = array_filter(array_map('trim', explode("\n", $features_text)));

// Prepare component context
$component_context = [
    'plan_name' => $component_data['plan_name'] ?? 'Professional',
    'plan_subtitle' => $component_data['plan_subtitle'] ?? 'Perfect for growing businesses',
    'price' => $component_data['price'] ?? '29',
    'price_currency' => $component_data['price_currency'] ?? '$',
    'price_period' => $component_data['price_period'] ?? 'month',
    'features' => $features_array,
    'button_text' => $component_data['button_text'] ?? 'Get Started',
    'button_url' => $component_data['button_url'] ?? '#',
    'is_popular' => $component_data['is_popular'] ?? false,
    'badge_text' => $component_data['badge_text'] ?? 'Most Popular',
    'card_style' => $component_data['card_style'] ?? 'standard',
    'color_scheme' => $component_data['color_scheme'] ?? 'blue',
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
echo Timber::compile('@components/Pricing/pricing-card/view.twig', $merged_context);