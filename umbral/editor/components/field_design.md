# Field Design Guide for Umbral Editor Components

This comprehensive guide establishes standards and best practices for designing component fields in the Umbral Editor system. It provides LLMs and developers with clear patterns for creating intuitive, scalable, and maintainable field structures.

## Table of Contents

1. [Core Principles](#core-principles)
2. [UI Organization Patterns](#ui-organization-patterns)
3. [Field Structure Standards](#field-structure-standards)
4. [Organizational Decision Tree](#organizational-decision-tree)
5. [Panel and Sub-Panel Design](#panel-and-sub-panel-design)
6. [Field Types and Naming](#field-types-and-naming)
7. [Implementation Examples](#implementation-examples)
8. [Common Patterns Library](#common-patterns-library)
9. [Troubleshooting Guide](#troubleshooting-guide)

## Core Principles

### 1. Content-First Philosophy
- **Primary Focus**: Content fields (text, images, URLs) should be the main interface
- **Secondary Controls**: Design options, styling, and layout controls are supplementary
- **User Experience**: Prioritize what users need most frequently

### 2. Logical Grouping
- **Related Functionality**: Group fields that work together conceptually
- **User Workflow**: Organize fields in the order users typically configure them
- **Cognitive Load**: Reduce mental overhead by creating clear, logical sections

### 3. Progressive Disclosure
- **Essential First**: Show the most important fields prominently
- **Advanced Hidden**: Use tabs/accordions for advanced or optional settings
- **Contextual Visibility**: Show fields only when relevant (conditional logic)

### 4. Consistent Naming
- **Descriptive Labels**: Use clear, specific field names
- **Consistent Patterns**: Follow established naming conventions
- **Context-Aware**: Adapt field names to their organizational context

## UI Organization Patterns

### Pattern 1: Simple Sections (Recommended for 5-15 fields)

**When to Use:**
- Components with 5-15 total fields
- Clear logical groupings (2-4 sections)
- No repeating field sets

**Structure:**
```php
'_ui_config' => [
    'style' => 'sections'
],
'_panels' => [
    'content' => [
        'label' => 'Content',
        'icon' => '📝',
        'description' => 'Main content and text'
    ],
    'styling' => [
        'label' => 'Styling',
        'icon' => '🎨', 
        'description' => 'Visual appearance options'
    ]
]
```

**Example Components:** hero-1, blog-posts-sections

### Pattern 2: Nested Tabs (Recommended for 15-30 fields)

**When to Use:**
- Components with 15-30 total fields
- Multiple related sub-groupings within sections
- Complex functionality requiring detailed organization

**Structure:**
```php
'_ui_config' => [
    'style' => 'sections'
],
'_panels' => [
    'content' => [
        'label' => 'Content & CTA',
        'icon' => '📝',
        'description' => 'Content and call-to-action settings',
        'style' => 'tabs',
        'sub_panels' => [
            'hero_content' => [
                'label' => 'Hero Content',
                'icon' => '📋',
                'description' => 'Main title and subtitle'
            ],
            'call_to_action' => [
                'label' => 'Call to Action',
                'icon' => '🎯',
                'description' => 'CTA button configuration'
            ]
        ]
    ]
]
```

**Example Components:** furniture-hero, blog-posts-nested

### Pattern 3: Mixed Organization (For Complex Components)

**When to Use:**
- Components with 30+ fields
- Mix of simple sections and complex nested areas
- Different types of content requiring different organization styles

**Structure:**
```php
'_panels' => [
    'content' => [
        'style' => 'tabs',    // Complex section with multiple tabs
        'sub_panels' => [...]
    ],
    'query' => [
        'style' => 'accordion', // Medium complexity with accordion
        'sub_panels' => [...]
    ],
    'display' => [
        // Simple section with no sub_panels
    ]
]
```

## Field Structure Standards

### Basic Field Definition
```php
'field_name' => [
    'type' => 'text',
    'title' => 'Field Label',           // Required: User-facing label
    'description' => 'Help text',       // Required: User guidance
    'default' => 'Default value',       // Recommended: Sensible default
    'panel' => 'section_name',          // Required: Panel assignment
    'sub_panel' => 'tab_name',          // Optional: Sub-panel assignment
]
```

### Field Naming Conventions

**✅ Good Naming Patterns:**
- `hero_title` - Context + purpose
- `cta_button_text` - Group + element + property
- `show_expert_section` - Action + target
- `product_card_style` - Target + property

**❌ Avoid These Patterns:**
- `title` - Too generic
- `button1_text` - Numbers without context
- `text_color_1` - Unclear purpose
- `setting` - Non-descriptive

### Required vs Optional Fields

**Always Required:**
- `type` - Field type (text, textarea, select, etc.)
- `title` - User-facing label
- `panel` - Panel assignment

**Recommended:**
- `description` - User guidance and context
- `default` - Sensible default value

**Optional:**
- `sub_panel` - For nested organization
- Field-specific options (min, max, options, etc.)

## Organizational Decision Tree

### Step 1: Count Total Fields
- **5-15 fields** → Use Simple Sections
- **15-30 fields** → Consider Nested Tabs
- **30+ fields** → Use Mixed Organization

### Step 2: Analyze Field Relationships
- **Tightly related groups** → Group in same panel/sub_panel
- **Loosely related** → Separate panels
- **Repeating patterns** → Use sub_panels with tabs/accordion

### Step 3: Consider User Workflow
- **Primary tasks** → Top-level sections
- **Configuration details** → Sub-panels within relevant sections
- **Advanced options** → Nested deeper or separate advanced section

### Step 4: Choose Sub-Panel Style
- **Tabs** - When sub-sections are equally important
- **Accordion** - When one sub-section is primary, others secondary
- **No sub-panels** - When fields fit naturally in a flat structure

## Panel and Sub-Panel Design

### Main Panel Standards

**Naming Convention:**
- Use clear, action-oriented names
- Include primary function in description
- Use relevant emoji icons

**Examples:**
```php
'content' => [
    'label' => 'Content & CTA',
    'icon' => '📝',
    'description' => 'Hero text content and call-to-action settings'
],
'products' => [
    'label' => 'Product Showcase', 
    'icon' => '🛋️',
    'description' => 'Featured product cards with images and details'
],
'styling' => [
    'label' => 'Visual Design',
    'icon' => '🎨',
    'description' => 'Colors, styles, and appearance options'
]
```

### Critical UI Configuration Rules

**⚠️ REQUIRED**: Always include proper `_ui_config` structure
```php
'_ui_config' => [
    'style' => 'sections'    // ✅ REQUIRED for all components
],
```

**Panel Style Consistency Rules:**
- **`'style' => 'tabs'`** - For sub_panels that are equally important
- **`'style' => 'accordion'`** - For sub_panels where one is primary  
- **No style specified** - For simple panels without sub_panels

**❌ COMMON MISTAKES:**
```php
// Wrong: Missing _ui_config
'_panels' => [...] // Will cause rendering issues

// Wrong: Inconsistent panel styles
'rooms' => [
    'style' => 'accordion',    // ❌ Don't mix styles randomly
    'sub_panels' => [...]
]

// Correct: Consistent panel organization
'rooms' => [
    'style' => 'tabs',         // ✅ Use 'tabs' for equal importance
    'sub_panels' => [...]
]
```

### Sub-Panel Organization

**Within Content Panels:**
- `hero_content` - Main text content
- `media` - Images, videos, files
- `call_to_action` - Buttons and links

**Within Product/Item Panels:**
- `product_1`, `product_2` - Individual item configuration
- `display_settings` - Overall layout and behavior

**Within Styling Panels:**
- `colors` - Color scheme options
- `typography` - Font and text settings
- `effects` - Animations and interactions

### Field Assignment Patterns

**Simple Assignment:**
```php
'title' => [
    'panel' => 'content',
    // No sub_panel for simple sections
]
```

**Nested Assignment:**
```php
'product_1_name' => [
    'panel' => 'products',
    'sub_panel' => 'product_1',
]
```

## Field Types and Naming

### Core Field Types

**Text Fields:**
```php
'text' => 'Single-line text input',
'textarea' => 'Multi-line text input', 
'text_url' => 'URL input with validation',
'email' => 'Email input with validation'
```

**Choice Fields:**
```php
'select' => 'Dropdown with predefined options',
'radio' => 'Radio button selection',
'checkbox' => 'Boolean toggle',
'multicheck' => 'Multiple checkbox selection'
```

**Media Fields:**
```php
'file' => 'File upload (images, documents)',
'colorpicker' => 'Color selection tool'
```

**Advanced Fields:**
```php
'number' => 'Numeric input with validation',
'date' => 'Date picker',
'wysiwyg' => 'Rich text editor',
'group' => 'Repeatable group of fields'
```

### Group Field Structure (CRITICAL SYNTAX)

**⚠️ IMPORTANT**: Group fields use `group_options` NOT `options`

```php
'repeatable_items' => [
    'type' => 'group',
    'title' => 'Repeatable Items',
    'description' => 'Add multiple items',
    'repeatable' => true,
    'panel' => 'content',
    'sub_panel' => 'items',
    'group_options' => [    // ✅ CORRECT: Use 'group_options'
        'group_title' => 'Item {#}',
        'add_button' => 'Add Item',
        'remove_button' => 'Remove Item',
        'closed' => true,
        'sortable' => true,
        'limit' => 10
    ],
    'fields' => [
        'item_name' => [
            'type' => 'text',
            'title' => 'Item Name'
        ],
        'item_description' => [
            'type' => 'textarea',
            'title' => 'Item Description'
        ]
    ]
]
```

**❌ COMMON MISTAKE**: Using `options` instead of `group_options`
```php
// THIS WILL BREAK THE COMPONENT:
'group_options' => [...] // ✅ Correct
'options' => [...]       // ❌ Wrong - will prevent fields from rendering
```

### Contextual Field Naming

**Within Hero Content Sub-Panel:**
- `title` → `Hero Title` (context provided by sub-panel)
- `subtitle` → `Hero Subtitle`
- `alignment` → `Title Alignment`

**Within Product 1 Sub-Panel:**
- `name` → `Product Name` (context: this is product 1)
- `price` → `Product Price`
- `image` → `Background Image`

**Within CTA Sub-Panel:**
- `text` → `Button Text`
- `url` → `Button URL`
- `style` → `Button Style`

## Implementation Examples

### Example 1: Simple Hero Component (10 fields)

```php
umbral_register_component('Heroes', 'simple-hero', [
    'fields' => [
        '_ui_config' => ['style' => 'sections'],
        '_panels' => [
            'content' => [
                'label' => 'Content',
                'icon' => '📝',
                'description' => 'Hero text and button'
            ],
            'styling' => [
                'label' => 'Styling', 
                'icon' => '🎨',
                'description' => 'Colors and layout'
            ]
        ],
        'title' => [
            'type' => 'text',
            'title' => 'Hero Title',
            'panel' => 'content'
        ],
        'background_color' => [
            'type' => 'select',
            'title' => 'Background Color',
            'panel' => 'styling'
        ]
    ]
]);
```

### Example 2: Complex Product Component (25 fields)

```php
umbral_register_component('Products', 'product-showcase', [
    'fields' => [
        '_ui_config' => ['style' => 'sections'],
        '_panels' => [
            'content' => [
                'label' => 'Content & Layout',
                'icon' => '📝',
                'description' => 'Section content and layout options',
                'style' => 'tabs',
                'sub_panels' => [
                    'section_content' => [
                        'label' => 'Section Content',
                        'icon' => '📋',
                        'description' => 'Title and description'
                    ],
                    'layout_options' => [
                        'label' => 'Layout Options',
                        'icon' => '📐',
                        'description' => 'Grid and display settings'
                    ]
                ]
            ],
            'products' => [
                'label' => 'Product Configuration',
                'icon' => '🛍️',
                'description' => 'Individual product settings',
                'style' => 'accordion',
                'sub_panels' => [
                    'product_1' => [
                        'label' => 'Featured Product',
                        'icon' => '⭐',
                        'description' => 'Main featured product'
                    ],
                    'product_2' => [
                        'label' => 'Secondary Product',
                        'icon' => '🔸',
                        'description' => 'Secondary product display'
                    ]
                ]
            ]
        ],
        'section_title' => [
            'type' => 'text',
            'title' => 'Section Title',
            'panel' => 'content',
            'sub_panel' => 'section_content'
        ],
        'grid_columns' => [
            'type' => 'select',
            'title' => 'Grid Columns',
            'panel' => 'content',
            'sub_panel' => 'layout_options'
        ],
        'product_name' => [
            'type' => 'text',
            'title' => 'Product Name',
            'panel' => 'products',
            'sub_panel' => 'product_1'
        ]
    ]
]);
```

## Common Patterns Library

### Pattern: Content + CTA Organization
```php
'content' => [
    'style' => 'tabs',
    'sub_panels' => [
        'main_content' => ['label' => 'Main Content'],
        'call_to_action' => ['label' => 'Call to Action']
    ]
]
```

### Pattern: Repeating Items
```php
'items' => [
    'style' => 'tabs', // or 'accordion'
    'sub_panels' => [
        'item_1' => ['label' => 'Item 1'],
        'item_2' => ['label' => 'Item 2'],
        'item_settings' => ['label' => 'Display Settings']
    ]
]
```

### Pattern: Query + Display
```php
'query' => [
    'style' => 'tabs',
    'sub_panels' => [
        'source' => ['label' => 'Data Source'],
        'filters' => ['label' => 'Filters'],
        'ordering' => ['label' => 'Ordering']
    ]
],
'display' => [
    'style' => 'tabs',
    'sub_panels' => [
        'layout' => ['label' => 'Layout'],
        'elements' => ['label' => 'Elements'],
        'styling' => ['label' => 'Styling']
    ]
]
```

## Troubleshooting Guide

### Common Issues and Solutions

**Issue: Fields not rendering in editor**
- **Symptom**: Component loads but specific fields/panels are missing
- **Common Causes**:
  - Using `'options'` instead of `'group_options'` for group fields
  - Missing `_ui_config` structure
  - Inconsistent panel style declarations
- **Solution**: Check field syntax and UI configuration structure

**Issue: Group fields broken**
- **Symptom**: Repeatable group fields don't appear or function
- **Cause**: Using `'options'` instead of `'group_options'`
- **Solution**: Change to `'group_options'` for all group field configurations

**Issue: Panel organization not working**  
- **Symptom**: Sub-panels not displaying correctly
- **Cause**: Missing or incorrect panel style declarations
- **Solution**: Ensure consistent use of `'style' => 'tabs'` or `'style' => 'accordion'`

**Issue: Too many fields in one panel**
- **Solution**: Break into sub_panels with logical groupings
- **Example**: Split "Content" into "Hero Text" and "CTA Button"

**Issue: Confusing field names**
- **Solution**: Use context-aware naming within sub_panels
- **Example**: "Product Name" instead of "name" in product_1 sub_panel

**Issue: Unclear organization**
- **Solution**: Add meaningful descriptions to panels and sub_panels
- **Example**: "Hero text content and call-to-action settings"

**Issue: Inconsistent styling**
- **Solution**: Choose one style per panel (tabs, accordion, or simple)
- **Example**: Don't mix tabs and accordion in same panel

### Validation Checklist

**Before Implementation:**
- [ ] All fields have `type`, `title`, and `panel`
- [ ] Panel structure matches component complexity
- [ ] Field names are descriptive and consistent
- [ ] Default values are provided where appropriate
- [ ] Descriptions provide helpful user guidance

**During Testing:**
- [ ] Field organization feels intuitive to users
- [ ] No confusion about where to find specific settings
- [ ] Sub-panels provide logical groupings
- [ ] Interface doesn't feel overwhelming or cluttered

## Best Practices Summary

### ✅ Do This
- Use Simple Sections for straightforward components
- Group related fields logically 
- Provide helpful descriptions for all fields
- Use consistent naming patterns
- Start with content fields, then styling
- Test the user experience flow

### ❌ Avoid This
- Mixing organizational styles inconsistently
- Generic field names without context
- Too many top-level panels (max 4-5)
- Deep nesting beyond 2 levels
- Missing descriptions or defaults
- Overwhelming users with too many options at once

---

This guide should be referenced for all new component field design and can be used to audit and improve existing components. Following these patterns ensures consistency, usability, and maintainability across the entire Umbral Editor system.