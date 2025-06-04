# Component Creation Guide

This guide explains how to create new categories and components for the Umbral Editor system. The system uses CMB2 for field management and a custom component registry for organization.

## Philosophy

The Umbral Editor follows a content-first approach:

- **Primary Focus**: Images and content fields should be the main interface
- **Optional Controls**: Design controls, query options, and layout settings are supplementary
- **Simplicity**: Don't add design/layout controls unless specifically required
- **CMB2 Integration**: All fields use CMB2 field types for consistency
- **Blocksy Design System**: Components should use the [Blocksy Style System](./BLOCKSY_STYLE_SYSTEM.md) for consistent styling

## ⚠️ CRITICAL: Common Mistakes to Avoid

Before starting, be aware of these **field rendering issues** that will break your component:

### Group Field Syntax Error (MOST COMMON)
```php
// ❌ WRONG - Component fields won't render:
'group_options' => [...] // ✅ Correct
'options' => [...]       // ❌ Wrong - breaks field rendering

// ✅ CORRECT Group Field Structure:
'repeatable_items' => [
    'type' => 'group',
    'group_options' => [    // ← MUST be 'group_options'
        'group_title' => 'Item {#}',
        'add_button' => 'Add Item'
    ],
    'fields' => [...]
]
```

### UI Configuration Requirements
```php
// ✅ REQUIRED - Every component MUST have:
'_ui_config' => [
    'style' => 'sections'    // Required for proper rendering
],
'_panels' => [...]           // Panel structure
```

### Panel Style Consistency
```php
// ✅ CORRECT - Use 'tabs' for equal importance sub-panels:
'rooms' => [
    'style' => 'tabs',       // For equal importance
    'sub_panels' => [...]
]

// ❌ AVOID - Mixing styles inconsistently:
'rooms' => [
    'style' => 'accordion',  // Don't use randomly
    'sub_panels' => [...]
]
```

## Related Documentation

- **[Field Design Guide](./field_design.md)** - **REQUIRED READING** - Official standards for component field design and organization
- **[Blocksy Style System](./BLOCKSY_STYLE_SYSTEM.md)** - Complete styling guide and design tokens
- **[Example Blocksy CSS](./example_blocksy.css)** - Full implementation of the Blocksy design system

## Component File Structure

Each component requires these files in its directory:

```
/inc/[create-files]/editor/components/CategoryName/component-name/
├── fields.php          # CMB2 field definitions and component registration
├── render.php          # PHP logic for data processing and context preparation
├── view.twig           # HTML template with Twig templating
├── example.js          # JavaScript example data for preview and testing
└── styles/             # Responsive CSS files
    ├── XS.css         # Mobile styles (< 576px)
    ├── SM.css         # Small tablets (≥ 576px)
    ├── MD.css         # Tablets (≥ 768px)
    ├── LG.css         # Desktop (≥ 992px)
    ├── XL.css         # Large desktop (≥ 1200px)
    └── 2XL.css        # Extra large (≥ 1400px)
```

### JavaScript File Organization

**IMPORTANT**: JavaScript files MUST be placed in a `scripts/` directory to be compiled and rendered properly by the system.

- ✅ **Required**: `/component-name/scripts/example.js`
- ❌ **Will not render**: `/component-name/example.js`

**Note**: While most existing components have `example.js` files in their root directories, these files are not being compiled or rendered. Only JavaScript files in the `scripts/` directory are processed by the asset compilation system.

```
/inc/[create-files]/editor/components/CategoryName/component-name/
├── scripts/            # JavaScript files directory (REQUIRED for compilation)
│   └── example.js     # Component JavaScript functionality
└── styles/            # CSS files directory
    ├── XS.css
    └── ...
```

## 1. Creating a New Category

Categories are automatically registered based on directory structure. Simply create a new category folder and the system will register it automatically.

### Create Category Directory

```bash
mkdir -p "/Users/broke/Herd/wordpress/wp-content/plugins/umbral-editor/inc/[create-files]/editor/components/YourCategory"
```

### Terminal Command Example:
```bash
# Create a new "Features" category
mkdir -p "/Users/broke/Herd/wordpress/wp-content/plugins/umbral-editor/inc/[create-files]/editor/components/Features"

# The category will be automatically registered when the directory is created
# No additional registration file needed
```

## 2. Creating a New Component

### Step 1: Create Component Directory Structure

```bash
# Replace 'Features' and 'feature-grid' with your category and component names
CATEGORY="Features"
COMPONENT="feature-grid"
BASE_PATH="/Users/broke/Herd/wordpress/wp-content/plugins/umbral-editor/inc/[create-files]/editor/components"

# Create component directory
mkdir -p "$BASE_PATH/$CATEGORY/$COMPONENT"

# Create required directories
mkdir -p "$BASE_PATH/$CATEGORY/$COMPONENT/styles"
mkdir -p "$BASE_PATH/$CATEGORY/$COMPONENT/scripts"

# Create all required files
touch "$BASE_PATH/$CATEGORY/$COMPONENT/fields.php"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/render.php"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/view.twig"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/scripts/example.js"

# Create responsive CSS files
touch "$BASE_PATH/$CATEGORY/$COMPONENT/styles/XS.css"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/styles/SM.css"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/styles/MD.css"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/styles/LG.css"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/styles/XL.css"
touch "$BASE_PATH/$CATEGORY/$COMPONENT/styles/2XL.css"
```

### Step 2: Complete Terminal Command for New Component

```bash
#!/bin/bash
# Complete component creation script

CATEGORY="Features"
COMPONENT="feature-grid"
BASE_PATH="/Users/broke/Herd/wordpress/wp-content/plugins/umbral-editor/inc/[create-files]/editor/components"
COMPONENT_PATH="$BASE_PATH/$CATEGORY/$COMPONENT"

# Create directories
mkdir -p "$COMPONENT_PATH/styles"
mkdir -p "$COMPONENT_PATH/scripts"

# Create fields.php
cat > "$COMPONENT_PATH/fields.php" << 'EOF'
<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register feature-grid component
umbral_register_component('Features', 'feature-grid', [
    'label' => 'Feature Grid',
    'title' => 'Feature Grid',
    'description' => 'Display features in a grid layout with icons and descriptions',
    'icon' => '⭐',
    'fields' => [
        'title' => [
            'type' => 'text',
            'label' => 'Section Title',
            'default' => 'Our Amazing Features',
            'description' => 'The main heading for the features section'
        ],
        'subtitle' => [
            'type' => 'textarea',
            'label' => 'Section Subtitle',
            'default' => 'Discover what makes us special',
            'description' => 'Supporting text below the title'
        ],
        'features' => [
            'type' => 'group',
            'label' => 'Features',
            'description' => 'Add individual features',
            'repeatable' => true,
            'group_options' => [    // ✅ CRITICAL: Use 'group_options' NOT 'options'
                'group_title' => 'Feature {#}',
                'add_button' => 'Add Feature',
                'remove_button' => 'Remove Feature',
                'closed' => true,
                'sortable' => true,
            ],
            'fields' => [
                'icon' => [
                    'type' => 'text',
                    'label' => 'Icon',
                    'default' => '🚀',
                    'description' => 'Emoji or icon for this feature'
                ],
                'title' => [
                    'type' => 'text',
                    'label' => 'Feature Title',
                    'default' => 'Amazing Feature',
                    'description' => 'Name of the feature'
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Feature Description',
                    'default' => 'This feature will transform your experience.',
                    'description' => 'Brief description of the feature'
                ],
                'image' => [
                    'type' => 'file',
                    'label' => 'Feature Image',
                    'description' => 'Optional image for this feature'
                ]
            ]
        ]
    ]
]);
EOF

# Create render.php
cat > "$COMPONENT_PATH/render.php" << 'EOF'
<?php

if (!defined('ABSPATH')) {
    exit;
}

// Component compiler utilities are loaded globally in the main plugin file

/**
 * Feature Grid Component Renderer
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
    'title' => $component_data['title'] ?? 'Our Amazing Features',
    'subtitle' => $component_data['subtitle'] ?? '',
    'features' => [],
    'component_id' => $category_name . '-' . $component_name
];

// Process features data
$features = $component_data['features'] ?? [];
if (is_array($features)) {
    foreach ($features as $feature) {
        $processed_feature = [
            'icon' => $feature['icon'] ?? '🚀',
            'title' => $feature['title'] ?? 'Feature',
            'description' => $feature['description'] ?? '',
            'image' => null
        ];
        
        // Process image if provided
        if (!empty($feature['image'])) {
            $processed_feature['image'] = wp_get_attachment_image_url($feature['image'], 'medium');
        }
        
        $component_context['features'][] = $processed_feature;
    }
}

// Compile and auto-enqueue component assets (styles and scripts)
compileComponent($component_dir, $component_context);

// Merge with main context
$merged_context = array_merge($context, $component_context);

// Render component using Timber
echo Timber::compile('@components/Features/feature-grid/view.twig', $merged_context);
EOF

# Create view.twig
cat > "$COMPONENT_PATH/view.twig" << 'EOF'
{# Feature Grid Component Template #}

{# Styles and scripts are auto-enqueued by compileComponent() #}
{# No manual inclusion needed #}

{# Feature Grid Component HTML #}
<section id="{{ component_id }}" class="umbral-features feature-grid">
    {% if title or subtitle %}
    <div class="features-header">
        {% if title %}
        <h2 class="section-title">{{ title }}</h2>
        {% endif %}
        
        {% if subtitle %}
        <p class="section-subtitle">{{ subtitle }}</p>
        {% endif %}
    </div>
    {% endif %}
    
    {% if features %}
    <div class="features-grid">
        {% for feature in features %}
        <div class="feature-card">
            {% if feature.image %}
            <div class="feature-image">
                <img src="{{ feature.image }}" alt="{{ feature.title }}" loading="lazy">
            </div>
            {% endif %}
            
            <div class="feature-content">
                {% if feature.icon %}
                <div class="feature-icon">{{ feature.icon }}</div>
                {% endif %}
                
                <h3 class="feature-title">{{ feature.title }}</h3>
                
                {% if feature.description %}
                <p class="feature-description">{{ feature.description }}</p>
                {% endif %}
            </div>
        </div>
        {% endfor %}
    </div>
    {% else %}
    <div class="no-features">
        <p>No features configured yet.</p>
    </div>
    {% endif %}
</section>
EOF

# Create example.js
cat > "$COMPONENT_PATH/scripts/example.js" << 'EOF'
// Example data for Feature Grid component preview
const exampleData = {
    title: "Our Amazing Features",
    subtitle: "Discover what makes our product special",
    features: [
        {
            icon: "🚀",
            title: "Lightning Fast",
            description: "Experience blazing fast performance with our optimized system."
        },
        {
            icon: "🔒",
            title: "Secure & Safe",
            description: "Your data is protected with enterprise-grade security measures."
        },
        {
            icon: "💡",
            title: "Smart Technology",
            description: "Powered by AI and machine learning for intelligent automation."
        },
        {
            icon: "🎯",
            title: "Precise Control",
            description: "Fine-tune every aspect with our advanced control panel."
        }
    ]
};

export default exampleData;
EOF

# Create basic responsive CSS files using Blocksy system
cat > "$COMPONENT_PATH/styles/XS.css" << 'EOF'
/* Mobile styles (< 576px) - Using Blocksy design system */
.feature-grid .features-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--blocksy-space-md);
}

.feature-grid .feature-card {
    background: var(--blocksy-color-background);
    border: 1px solid var(--blocksy-color-background-secondary);
    border-radius: var(--blocksy-radius-lg);
    box-shadow: var(--blocksy-shadow);
    padding: var(--blocksy-space-lg);
    text-align: center;
    transition: var(--blocksy-transition);
}

.feature-grid .feature-icon {
    font-size: var(--blocksy-text-3xl);
    color: var(--blocksy-color-primary);
    margin-bottom: var(--blocksy-space-md);
}

.feature-grid .feature-title {
    font-size: var(--blocksy-text-xl);
    color: var(--blocksy-color-text);
    margin-bottom: var(--blocksy-space-sm);
}

.feature-grid .feature-description {
    font-size: var(--blocksy-text-base);
    color: var(--blocksy-color-text-light);
}
EOF

cat > "$COMPONENT_PATH/styles/SM.css" << 'EOF'
/* Small tablets (≥ 576px) - Enhanced with Blocksy */
.feature-grid .features-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: var(--blocksy-space-lg);
}
EOF

cat > "$COMPONENT_PATH/styles/MD.css" << 'EOF'
/* Tablets (≥ 768px) - Enhanced with Blocksy */
.feature-grid .features-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: var(--blocksy-space-xl);
}

.feature-grid .feature-card {
    padding: var(--blocksy-space-xl);
}
EOF

cat > "$COMPONENT_PATH/styles/LG.css" << 'EOF'
/* Desktop (≥ 992px) - Enhanced with Blocksy hover effects */
.feature-grid .features-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: var(--blocksy-space-xl);
}

.feature-grid .feature-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--blocksy-shadow-lg);
}
EOF

cat > "$COMPONENT_PATH/styles/XL.css" << 'EOF'
/* Large desktop (≥ 1200px) - Enhanced spacing */
.feature-grid .features-grid {
    grid-template-columns: repeat(4, 1fr);
    gap: var(--blocksy-space-2xl);
}
EOF

cat > "$COMPONENT_PATH/styles/2XL.css" << 'EOF'
/* Extra large (≥ 1400px) - Maximum spacing */
.feature-grid .features-grid {
    gap: var(--blocksy-space-3xl);
}

.feature-grid .feature-card {
    padding: var(--blocksy-space-2xl);
}
EOF

echo "✅ Component '$COMPONENT' created successfully in category '$CATEGORY'"
echo "📁 Location: $COMPONENT_PATH"
echo "📝 Next steps:"
echo "   1. Customize the fields in fields.php"
echo "   2. Add your logic in render.php"
echo "   3. Design your template in view.twig"
echo "   4. Style your component in the styles/ directory"
echo "   5. Test with example.js data"
```

## Component Architecture Deep Dive

### fields.php Anatomy

> **⚠️ IMPORTANT**: Before designing component fields, you **MUST** read the **[Field Design Guide](./field_design.md)** for official standards, patterns, and best practices. All field structures should follow the established guidelines.

The `fields.php` file is the foundation of each component. It defines:

#### 1. **Component Registration**
```php
umbral_register_component('CategoryName', 'component-name', [
    'label' => 'Display Name',        // Shows in component palette
    'title' => 'Full Title',          // Used in editor interface  
    'description' => 'Brief description', // Helps users understand purpose
    'icon' => '🎯',                   // Emoji icon for visual identification
    'fields' => [...]                // Field definitions array
]);
```

#### 2. **Field Organization Patterns**

> **📋 FIELD DESIGN REFERENCE**: For complete field organization standards, UI patterns, and decision trees, see the **[Field Design Guide](./field_design.md)**.

**Quick Reference - Organization Styles:**

**Simple Sections** (5-15 fields):
```php
'_ui_config' => ['style' => 'sections'],
'_panels' => [
    'content' => ['label' => 'Content', 'icon' => '📝'],
    'styling' => ['label' => 'Styling', 'icon' => '🎨']
]
```

**Nested Tabs** (15-30 fields):
```php
'_ui_config' => ['style' => 'sections'],
'_panels' => [
    'content' => [
        'style' => 'tabs',
        'sub_panels' => [
            'hero_content' => ['label' => 'Hero Content', 'icon' => '📋'],
            'call_to_action' => ['label' => 'Call to Action', 'icon' => '🎯']
        ]
    ]
]
```

**📖 For detailed patterns, decision trees, and examples, read the [Field Design Guide](./field_design.md).**

#### 3. **Field Structure Patterns**

**Basic Field**:
```php
'field_name' => [
    'type' => 'text',
    'label' => 'Field Label',        // Required: Shows in editor
    'description' => 'Help text',    // Optional: User guidance
    'default' => 'Default value',    // Optional: Initial value
    'panel' => 'content',           // Optional: Panel assignment
]
```

**Repeatable Group** (for dynamic content):
```php
'testimonials' => [
    'type' => 'group',
    'title' => 'Testimonials',      // Note: 'title' instead of 'label' for groups
    'description' => 'Add testimonials',
    'repeatable' => true,
    'panel' => 'content',
    'fields' => [
        'quote' => [
            'type' => 'textarea',
            'title' => 'Quote Text',   // Note: 'title' for subfields
        ],
        // ... more subfields
    ]
]
```

#### 4. **Field Naming Conventions**

- **Descriptive names**: `section_title` vs `title`
- **Consistent patterns**: `show_*` for toggles, `*_style` for appearance
- **Logical grouping**: Related fields use similar prefixes

### view.twig Structure Breakdown

**Template Pattern**:
```twig
{# Component Template #}

{# Styles and scripts are auto-enqueued by compileComponent() #}
{# No manual inclusion needed #}

{# Component HTML #}
<section id="{{ component_id }}" class="component-class">
    {# Template content here #}
</section>
```


### render.php Structure Breakdown

The `render.php` file processes component data and prepares it for the template. Every render.php follows this consistent pattern:

#### 1. **File Header & Security**
```php
<?php
if (!defined('ABSPATH')) {
    exit; // WordPress security check
}

// Component compiler utilities are loaded globally in the main plugin file
```

#### 2. **Component Path Detection**
```php
// Get component directory for file paths
$component_dir = dirname(__FILE__);
$component_name = basename($component_dir);          // e.g., 'hero-1'
$category_name = basename(dirname($component_dir));  // e.g., 'Heroes'
```

#### 3. **Data Processing Patterns**

**Simple Data Extraction** (hero-1):
```php
// Prepare component context
$component_context = [
    'title' => $component_data['title'] ?? 'Default Title',
    'subtitle' => $component_data['subtitle'] ?? '',
    'background_image' => $component_data['background_image'] ?? null,
    'component_id' => $category_name . '-' . $component_name
];
```

**Complex Data Processing** (blog-posts):
```php
// Build WordPress query from component options
$query_args = [
    'post_status' => 'publish',
    'posts_per_page' => $component_data['posts_per_page'] ?? 6,
    'orderby' => $component_data['orderby'] ?? 'date',
];

// Execute query and process results
$posts_query = new WP_Query($query_args);
$posts = [];
while ($posts_query->have_posts()) {
    // Process each post...
}
```

**Default Content Handling** (testimonials):
```php
$testimonials = $component_data['testimonials'] ?? [];

// Provide fallback content for empty state
if (empty($testimonials)) {
    $testimonials = [
        [
            'quote' => 'Sample testimonial...',
            'author_name' => 'John Doe',
            // ... more default data
        ]
    ];
}
```

#### 4. **Asset Compilation System**
```php
// Simplified system: One function handles everything
// Automatically compiles and enqueues component assets (styles and scripts)
compileComponent($component_dir, $component_context);
```


#### 5. **Template Rendering**
```php
// Compile and auto-enqueue component assets (styles and scripts)
compileComponent($component_dir, $component_context);

// Merge component context with global Timber context
$merged_context = array_merge($context, $component_context);

// Render using Timber template engine
echo Timber::compile('@components/CategoryName/component-name/view.twig', $merged_context);
```

### Key render.php Responsibilities

1. **Data Validation**: Apply defaults and sanitize user input
2. **WordPress Integration**: Handle queries, media, taxonomies
3. **Context Preparation**: Structure data for template consumption  
4. **Asset Management**: Auto-compile and enqueue styles/scripts with `compileComponent()`
5. **Template Rendering**: Output final HTML via Timber

### Common Patterns in render.php

- **Always use null coalescing**: `$data['field'] ?? 'default'`
- **Component ID generation**: `$category_name . '-' . $component_name`
- **WordPress query handling**: Proper `wp_reset_postdata()` calls
- **Image processing**: Convert attachment IDs to URLs
- **Asset compilation**: Use `compileComponent($component_dir, $component_context)`
- **Context merging**: Always merge with global context before rendering

## Field Types Reference

> **📋 COMPLETE REFERENCE**: For detailed field type documentation, naming conventions, and implementation examples, see the **[Field Design Guide](./field_design.md)**.

### Core Field Types Quick Reference:
- `text` - Single line text input
- `textarea` - Multi-line text input
- `text_url` - URL input with validation
- `email` - Email input with validation
- `number` - Number input
- `select` - Dropdown selection
- `checkbox` - Boolean toggle
- `file` - File upload (images, documents)
- `colorpicker` - Color picker
- `wysiwyg` - Rich text editor

**📖 For complete field specifications, validation options, and advanced patterns, read the [Field Design Guide](./field_design.md).**

### Advanced Field Examples:

**Select Field with Options**:
```php
'text_color' => [
    'type' => 'select',
    'label' => 'Text Color',
    'options' => [
        'white' => 'White',
        'dark' => 'Dark', 
        'custom' => 'Custom'
    ],
    'default' => 'white',
    'description' => 'Color scheme for text content'
]
```

**File Upload with Constraints**:
```php
'author_image' => [
    'type' => 'file',
    'label' => 'Author Photo',
    'description' => 'Photo of the author',
    'query_args' => [
        'type' => 'image',  // Restrict to images only
    ],
]
```

**Number Field with Limits**:
```php
'posts_per_page' => [
    'type' => 'number',
    'label' => 'Number of Posts',
    'default' => 6,
    'min' => 1,
    'max' => 50,
    'description' => 'How many posts to display'
]
```

## Best Practices

### Field Design (REQUIRED)
> **🎯 ESSENTIAL**: All field design must follow the **[Field Design Guide](./field_design.md)** standards.

1. **Read Field Design Guide**: Follow official patterns for field organization
2. **Content First**: Always start with content fields (title, text, images)
3. **Logical Grouping**: Use appropriate UI organization patterns
4. **Consistent Naming**: Follow established naming conventions

### Development Standards
5. **Blocksy Styling**: Use the [Blocksy Style System](./BLOCKSY_STYLE_SYSTEM.md) for consistent design
6. **CSS Variables**: Leverage Blocksy design tokens and create component-scoped variables
7. **Responsive**: Always include all breakpoint CSS files (XS, SM, MD, LG, XL, 2XL)
8. **Semantic HTML**: Use proper HTML structure in view.twig
9. **Accessibility**: Include alt text, proper headings, and ARIA labels
10. **Performance**: Use lazy loading for images, optimize CSS

## Styling Components

All components should follow the [Blocksy Style System](./BLOCKSY_STYLE_SYSTEM.md) for consistent styling:

- **Use Blocksy CSS Variables**: Leverage design tokens for colors, typography, spacing
- **Component-Scoped Variables**: Create component-specific CSS variables that extend Blocksy
- **Mobile-First Responsive**: Start with mobile styles in XS.css, enhance for larger screens
- **Utility Classes**: Use Blocksy utility classes when appropriate
- **Consistent Patterns**: Follow established patterns for cards, buttons, grids, etc.

### Example Component Styling Structure:

**view.twig**:
```html
{# Styles are auto-enqueued by compileComponent() #}
<section id="{{ component_id }}" class="blocksy-container">
    <!-- Component HTML using Blocksy utility classes -->
</section>
```

**styles/XS.css** (Mobile-first):
```css
/* Use Blocksy variables for consistent styling */
.component-element {
    background: var(--component-bg);
    color: var(--component-text);
    padding: var(--component-spacing);
    border-radius: var(--blocksy-radius-lg);
    box-shadow: var(--blocksy-shadow);
}
```

For complete styling guidance, see the [Blocksy Style System documentation](./BLOCKSY_STYLE_SYSTEM.md) and [example CSS implementation](./example_blocksy.css).

## Component Registration

Components are automatically registered when you use `umbral_register_component()` in your fields.php file. The system will:

1. Register the component with the category
2. Make it available in the command palette
3. Load fields for the editor interface
4. Compile styles and scripts
5. Render using the view.twig template

## Testing Your Component

1. **Preview**: Use the example.js data to preview your component
2. **Responsive**: Test all breakpoints in browser dev tools
3. **Content**: Test with various content lengths and types
4. **Validation**: Ensure all fields validate properly
5. **Performance**: Check loading speed and CSS efficiency

---

This guide ensures consistent, maintainable components that follow the Umbral Editor's content-first philosophy. **All field design must adhere to the standards outlined in the [Field Design Guide](./field_design.md)** for optimal user experience and system consistency.