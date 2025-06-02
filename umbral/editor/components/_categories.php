<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Centralized Category Registration
 * Register all component categories once to avoid duplicates
 */

// Register Heroes category
umbral_register_component_category('Heroes', [
    'label' => 'Heroes',
    'description' => 'Hero sections and banner components',
    'icon' => '🎯',
]);

// Register Testimonials category  
umbral_register_component_category('Testimonials', [
    'label' => 'Testimonials',
    'description' => 'Customer testimonials and review components',
    'icon' => '💬',
]);

// Register Pricing category
umbral_register_component_category('Pricing', [
    'label' => 'Pricing',
    'description' => 'Pricing tables, cards, and subscription components',
    'icon' => '💰',
]);

// Register Content category
umbral_register_component_category('Content', [
    'label' => 'Content',
    'description' => 'Dynamic content components like blog posts, news, and articles',
    'icon' => '📝',
]);