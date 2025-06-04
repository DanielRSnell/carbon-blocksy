<?php

if (!defined('ABSPATH')) {
    exit; // WordPress security check
}

// Component path detection
$component_dir = dirname(__FILE__);
$component_name = basename($component_dir);
$category_name = basename(dirname($component_dir));

// Extract field data with defaults (updated field names)
$hero_title = $component_data['hero_title'] ?? 'Your work, supercharged';
$hero_subtitle = $component_data['hero_subtitle'] ?? 'A collection of powerful shortcuts, commands, and tools to streamline your workflow.';
$title_alignment = $component_data['title_alignment'] ?? 'center';
$search_placeholder = $component_data['search_placeholder'] ?? 'Search for anything...';
$search_shortcut_key = $component_data['search_shortcut_key'] ?? '⌘K';
$show_shortcuts_section = $component_data['show_shortcuts_section'] ?? true;
$cta_text = $component_data['cta_text'] ?? 'Get Started';
$cta_url = $component_data['cta_url'] ?? '#';
$cta_style = $component_data['cta_style'] ?? 'glass';
$show_cta_arrow = $component_data['show_cta_arrow'] ?? true;
$cards_layout = $component_data['cards_layout'] ?? 'sides';
$cards_animation = $component_data['cards_animation'] ?? 'slide_in';

// Process shortcuts data
$shortcuts = $component_data['shortcuts'] ?? [];
if (empty($shortcuts)) {
    // Provide fallback content for empty state
    $shortcuts = [
        [
            'icon' => '⌘',
            'text' => 'Quick Actions',
            'keystroke' => '⌘K'
        ],
        [
            'icon' => '🔍',
            'text' => 'Search Files',
            'keystroke' => '⌘F'
        ],
        [
            'icon' => '📁',
            'text' => 'Browse Folders',
            'keystroke' => '⌘B'
        ]
    ];
}

// Process feature cards data
$feature_cards = $component_data['feature_cards'] ?? [];
if (empty($feature_cards)) {
    // Provide fallback content for empty state
    $feature_cards = [
        [
            'icon' => '⚡',
            'title' => 'Lightning Fast',
            'description' => 'Execute commands in milliseconds'
        ],
        [
            'icon' => '🎯',
            'title' => 'Precise Control',
            'description' => 'Find exactly what you need'
        ],
        [
            'icon' => '🚀',
            'title' => 'Boost Productivity',
            'description' => 'Save hours every week'
        ]
    ];
}

// Prepare component context with updated field names
$component_context = [
    'hero_title' => $hero_title,
    'hero_subtitle' => $hero_subtitle,
    'title_alignment' => $title_alignment,
    'search_placeholder' => $search_placeholder,
    'search_shortcut_key' => $search_shortcut_key,
    'show_shortcuts_section' => $show_shortcuts_section,
    'shortcuts' => $shortcuts,
    'feature_cards' => $feature_cards,
    'cta_text' => $cta_text,
    'cta_url' => $cta_url,
    'cta_style' => $cta_style,
    'show_cta_arrow' => $show_cta_arrow,
    'cards_layout' => $cards_layout,
    'cards_animation' => $cards_animation,
    'component_id' => $category_name . '-' . $component_name
];

// Compile and auto-enqueue component assets (styles and scripts)
compileComponent($component_dir, $component_context);

// Merge component context with global Timber context
$merged_context = array_merge($context, $component_context);

// Render using Timber template engine
echo Timber::compile('@components/' . $category_name . '/' . $component_name . '/view.twig', $merged_context);