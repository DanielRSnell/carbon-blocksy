<?php
/**
 * Pricing Table Carbon Block
 *
 * @package CarbonBlocks
 */

use Carbon_Fields\Block;
use Carbon_Fields\Field;

if (! defined('ABSPATH')) {
    exit;
}

// Get component name from parent directory
$component = basename(dirname(__FILE__));

// Get category from grandparent directory
$category = basename(dirname(dirname(__FILE__)));

/**
 * Register Pricing Table Gutenberg Block
 */
Block::make(__(ucwords(str_replace('-', ' ', $component))))
    ->add_fields([
        Field::make('text', 'title', __('Section Title'))
            ->set_default_value('Choose Your Plan')
            ->set_help_text('Main heading for the pricing section'),
            
        Field::make('textarea', 'subtitle', __('Section Subtitle'))
            ->set_default_value('Select the perfect plan for your needs')
            ->set_help_text('Supporting text below the title'),
            
        Field::make('complex', 'plans', __('Pricing Plans'))
            ->set_help_text('Add pricing plans to display')
            ->add_fields([
                Field::make('text', 'name', __('Plan Name'))
                    ->set_default_value('Basic Plan'),
                    
                Field::make('text', 'price', __('Price'))
                    ->set_default_value('$29')
                    ->set_help_text('Price display (e.g., $29, Free, Custom)'),
                    
                Field::make('text', 'billing_period', __('Billing Period'))
                    ->set_default_value('per month')
                    ->set_help_text('Billing frequency (e.g., per month, per year, one-time)'),
                    
                Field::make('textarea', 'description', __('Plan Description'))
                    ->set_default_value('Perfect for individuals getting started')
                    ->set_help_text('Brief description of the plan'),
                    
                Field::make('checkbox', 'featured', __('Featured Plan'))
                    ->set_help_text('Mark this plan as featured/popular'),
                    
                Field::make('text', 'featured_badge', __('Featured Badge Text'))
                    ->set_default_value('Popular')
                    ->set_help_text('Text to display on the featured badge (only shows when plan is featured)'),
                    
                Field::make('complex', 'features', __('Features'))
                    ->set_help_text('List of features included in this plan')
                    ->add_fields([
                        Field::make('text', 'feature', __('Feature'))
                            ->set_default_value('Feature name'),
                            
                        Field::make('text', 'icon', __('Feature Icon'))
                            ->set_default_value('✓')
                            ->set_help_text('Icon/emoji to display (e.g., ✓, ⚡, 🔒, 📊)'),
                            
                        Field::make('checkbox', 'included', __('Included'))
                            ->set_default_value(true)
                            ->set_help_text('Is this feature included?'),
                    ]),
                    
                Field::make('text', 'cta_text', __('Button Text'))
                    ->set_default_value('Get Started')
                    ->set_help_text('Call-to-action button text'),
                    
                Field::make('text', 'cta_url', __('Button URL'))
                    ->set_default_value('#')
                    ->set_help_text('Call-to-action button link'),
                    
                Field::make('select', 'cta_style', __('Button Style'))
                    ->set_options([
                        'primary' => 'Primary (filled)',
                        'secondary' => 'Secondary (outline)',
                        'ghost' => 'Ghost (transparent)',
                    ])
                    ->set_default_value('primary')
                    ->set_help_text('Visual style of the CTA button'),
            ]),
            
        Field::make('select', 'columns', __('Columns Layout'))
            ->set_options([
                'auto' => 'Auto (responsive)',
                '2' => '2 columns',
                '3' => '3 columns',
                '4' => '4 columns',
            ])
            ->set_default_value('auto')
            ->set_help_text('Number of columns to display plans in'),
            
        Field::make('checkbox', 'highlight_featured', __('Highlight Featured Plans'))
            ->set_default_value(true)
            ->set_help_text('Apply special styling to featured plans'),
            
        Field::make('select', 'theme', __('Color Theme'))
            ->set_options([
                'light' => 'Light Theme',
                'dark' => 'Dark Theme',
            ])
            ->set_default_value('light')
            ->set_help_text('Choose the visual theme for the pricing table'),
            
        Field::make('checkbox', 'background_pattern', __('Show Grid Background'))
            ->set_default_value(false)
            ->set_help_text('Display a subtle grid pattern background'),
    ])
    ->set_category('carbon-blocks-' . $category)
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) use ($component, $category) {
        carbon_blocks_render_gutenberg($category . '/' . $component, $fields, $attributes, $inner_blocks);
    });