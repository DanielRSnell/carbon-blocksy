<?php

if (!defined('ABSPATH')) {
    exit; // WordPress security check
}

// Component path detection
$component_dir = dirname(__FILE__);
$component_name = basename($component_dir);
$category_name = basename(dirname($component_dir));

// Extract field data with defaults
$title = $component_data['title'] ?? 'Your work, supercharged';
$subtitle = $component_data['subtitle'] ?? 'A collection of powerful shortcuts, commands, and tools to streamline your workflow.';
$search_placeholder = $component_data['search_placeholder'] ?? 'Search for anything...';
$cta_text = $component_data['cta_text'] ?? 'Get Started';
$cta_url = $component_data['cta_url'] ?? '#';

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

// Prepare component context
$component_context = [
    'title' => $title,
    'subtitle' => $subtitle,
    'search_placeholder' => $search_placeholder,
    'shortcuts' => $shortcuts,
    'feature_cards' => $feature_cards,
    'cta_text' => $cta_text,
    'cta_url' => $cta_url,
    'component_id' => $category_name . '-' . $component_name
];

// Compile and auto-enqueue component assets (styles and scripts)
compileComponent($component_dir, $component_context);

// Merge component context with global Timber context
$merged_context = array_merge($context, $component_context);

// Render using Timber template engine
echo Timber::compile('@components/' . $category_name . '/' . $component_name . '/view.twig', $merged_context);