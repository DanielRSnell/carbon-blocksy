<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Component compiler utilities are loaded globally in the main plugin file

/**
 * Furniture Hero Component Renderer
 * Modern furniture hero section with product showcase and promotional cards
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

// Process expert avatars with flat structure
$expert_avatars = [];
for ($i = 1; $i <= 3; $i++) {
    $avatar_key = "expert_avatar_$i";
    if (!empty($component_data[$avatar_key])) {
        $expert_avatars[] = [
            'image_id' => $component_data[$avatar_key],
            'alt_text' => "Expert avatar $i"
        ];
    }
}

// Provide fallback avatars if none are uploaded
if (empty($expert_avatars)) {
    $expert_avatars = [
        [
            'image_id' => null,
            'fallback_url' => 'https://startersites.io/blocksy/furniture/wp-content/uploads/2024/05/home-avatar-1.webp',
            'alt_text' => 'Expert avatar 1'
        ],
        [
            'image_id' => null,
            'fallback_url' => 'https://startersites.io/blocksy/furniture/wp-content/uploads/2024/05/home-avatar-2.webp',
            'alt_text' => 'Expert avatar 2'
        ],
        [
            'image_id' => null,
            'fallback_url' => 'https://startersites.io/blocksy/furniture/wp-content/uploads/2024/05/home-avatar-3.webp',
            'alt_text' => 'Expert avatar 3'
        ]
    ];
}

// Process product cards with flat structure
$product_cards = [];
for ($i = 1; $i <= 2; $i++) {
    $name_key = "product_{$i}_name";
    $price_key = "product_{$i}_price";
    $image_key = "product_{$i}_image";
    $url_key = "product_{$i}_url";
    $desc_key = "product_{$i}_description";
    
    $product_cards[] = [
        'name' => $component_data[$name_key] ?? ($i == 1 ? 'Wooden Chair' : 'Pretium Elite'),
        'price' => $component_data[$price_key] ?? ($i == 1 ? '$199' : '$130'),
        'description' => $component_data[$desc_key] ?? '',
        'image_id' => $component_data[$image_key] ?? null,
        'url' => $component_data[$url_key] ?? '/shop/'
    ];
}

// Process promotion card with flat structure
$promotion_card = [
    'title' => $component_data['promo_title'] ?? '25% OFF',
    'title_color' => $component_data['promo_title_color'] ?? '#ffffff',
    'description' => $component_data['promo_description'] ?? 'Donec ac odio tempor dapibus.',
    'badge_text' => $component_data['promo_badge_text'] ?? '',
    'button_text' => $component_data['promo_button_text'] ?? 'Explore Now',
    'button_url' => $component_data['promo_button_url'] ?? '/shop/'
];

// Prepare component context
$component_context = [
    'title' => $component_data['title'] ?? 'Exquisite design combined with functionalities',
    'subtitle' => $component_data['subtitle'] ?? 'Pellentesque ullamcorper dignissim condimentum volutpat consequat mauris nunc lacinia quis.',
    'title_alignment' => $component_data['title_alignment'] ?? 'left',
    'expert_avatars' => $expert_avatars,
    'expert_text' => $component_data['expert_text'] ?? 'Contact with our expert',
    'show_expert_section' => $component_data['show_expert_section'] ?? true,
    'cta_text' => $component_data['cta_text'] ?? 'Shop Now',
    'cta_url' => $component_data['cta_url'] ?? '/shop/',
    'cta_style' => $component_data['cta_style'] ?? 'primary',
    'cta_size' => $component_data['cta_size'] ?? 'medium',
    'product_cards' => $product_cards,
    'product_card_style' => $component_data['product_card_style'] ?? 'default',
    'product_hover_effect' => $component_data['product_hover_effect'] ?? 'lift',
    'show_product_descriptions' => $component_data['show_product_descriptions'] ?? false,
    'promotion_card' => $promotion_card,
    'promo_style' => $component_data['promo_style'] ?? 'default',
    'promo_animation' => $component_data['promo_animation'] ?? 'none',
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
echo Timber::compile('@components/Heroes/furniture-hero/view.twig', $merged_context);