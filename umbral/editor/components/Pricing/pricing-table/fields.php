<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register pricing-table component
umbral_register_component('Pricing', 'pricing-table', [
    'label' => 'Pricing Table',
    'title' => 'Pricing Plans Table',
    'description' => 'Display multiple pricing plans in a responsive table layout',
    'icon' => '💳',
    'fields' => [
        '_ui_config' => [
            'style' => 'sections'
        ],
        '_panels' => [
            'content' => [
                'label' => 'Content',
                'icon' => '📝',
                'description' => 'Section content and pricing plans'
            ],
            'display' => [
                'label' => 'Display',
                'icon' => '🎨',
                'description' => 'Layout and styling options'
            ]
        ],
        'section_title' => [
            'type' => 'text',
            'title' => 'Section Title',
            'description' => 'Optional title for the pricing section',
            'default' => 'Choose Your Plan',
            'panel' => 'content',
        ],
        'section_subtitle' => [
            'type' => 'textarea',
            'title' => 'Section Subtitle',
            'description' => 'Optional subtitle or description for the section',
            'default' => 'Select the perfect plan for your needs. Upgrade or downgrade at any time.',
            'panel' => 'content',
        ],
        'plans' => [
            'type' => 'group',
            'title' => 'Pricing Plans',
            'description' => 'Add pricing plans',
            'repeatable' => true,
            'panel' => 'content',
            'fields' => [
                'plan_name' => [
                    'type' => 'text',
                    'title' => 'Plan Name',
                    'description' => 'Name of the pricing plan',
                ],
                'plan_subtitle' => [
                    'type' => 'text',
                    'title' => 'Plan Subtitle',
                    'description' => 'Short description of the plan',
                ],
                'price' => [
                    'type' => 'text',
                    'title' => 'Price',
                    'description' => 'Main price amount (numbers only)',
                ],
                'price_currency' => [
                    'type' => 'text',
                    'title' => 'Currency Symbol',
                    'description' => 'Currency symbol to display',
                    'default' => '$',
                ],
                'price_period' => [
                    'type' => 'select',
                    'title' => 'Billing Period',
                    'description' => 'How often the price is charged',
                    'options' => [
                        'month' => 'per month',
                        'year' => 'per year',
                        'one-time' => 'one-time',
                        'week' => 'per week',
                    ],
                    'default' => 'month',
                ],
                'features' => [
                    'type' => 'textarea',
                    'title' => 'Features List',
                    'description' => 'List of features (one per line)',
                ],
                'button_text' => [
                    'type' => 'text',
                    'title' => 'Button Text',
                    'description' => 'Text for the call-to-action button',
                    'default' => 'Get Started',
                ],
                'button_url' => [
                    'type' => 'text',
                    'title' => 'Button URL',
                    'description' => 'URL for the call-to-action button',
                    'default' => '#',
                ],
                'is_popular' => [
                    'type' => 'checkbox',
                    'title' => 'Popular Plan',
                    'description' => 'Mark this plan as most popular',
                    'default' => false,
                ],
                'badge_text' => [
                    'type' => 'text',
                    'title' => 'Badge Text',
                    'description' => 'Text for the badge (if popular plan)',
                    'default' => 'Most Popular',
                ],
            ],
        ],
        'table_columns' => [
            'type' => 'select',
            'title' => 'Table Columns',
            'description' => 'Number of columns for larger screens',
            'options' => [
                '1' => '1 Column',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns',
            ],
            'default' => '3',
            'panel' => 'display',
        ],
        'card_style' => [
            'type' => 'select',
            'title' => 'Card Style',
            'description' => 'Visual style for all pricing cards',
            'options' => [
                'standard' => 'Standard',
                'outlined' => 'Outlined',
                'elevated' => 'Elevated',
                'gradient' => 'Gradient',
            ],
            'default' => 'standard',
            'panel' => 'display',
        ],
        'color_scheme' => [
            'type' => 'select',
            'title' => 'Color Scheme',
            'description' => 'Color theme for the cards',
            'options' => [
                'blue' => 'Blue',
                'purple' => 'Purple',
                'green' => 'Green',
                'orange' => 'Orange',
                'neutral' => 'Neutral',
            ],
            'default' => 'blue',
            'panel' => 'display',
        ],
        'section_background' => [
            'type' => 'select',
            'title' => 'Section Background',
            'description' => 'Background color for the entire section',
            'options' => [
                'transparent' => 'Transparent',
                'white' => 'White',
                'light-gray' => 'Light Gray',
                'dark' => 'Dark',
            ],
            'default' => 'transparent',
            'panel' => 'display',
        ],
    ],
]);