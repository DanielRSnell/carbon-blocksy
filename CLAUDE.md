# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

```bash
# Install PHP dependencies
composer install

# No build process needed - CSS/JS compiled dynamically
```

## Architecture Overview

This repository contains **two component systems**:

1. **Carbon Blocks Framework** (`src/blocks/`) - Main Gutenberg blocks system
2. **Umbral Editor Components** (`umbral/editor/components/`) - Alternative component system

## Carbon Blocks Framework Architecture

This is a **zero-configuration WordPress development framework** that combines Carbon Fields, Timber (Twig), and Gutenberg with file-based auto-discovery.

### Core Concept: File-Based Routing

The framework automatically discovers and registers components based on directory structure. No manual registration required.

### Framework Components

#### 1. Gutenberg Blocks (`src/blocks/`)
```
blocks/
└── {Category}/              # Auto-creates block category "carbon-blocks-{category}"
    └── {block-name}/        # Block component
        ├── block.php        # Uses reusable template - auto-detects name/category
        ├── block.twig       # Timber template with context
        ├── components/      # Reusable Twig components
        ├── scripts/         # Auto-compiled and concatenated JavaScript
        └── styles/          # Responsive CSS files (XS.css, LG.css, 2XL.css, etc.)
```

#### 2. Custom Post Types (`src/post-types/`)
```
post-types/
└── {post-type-slug}/
    ├── config.php           # Auto-registers post type via $post_type_slug global
    └── field-groups/        # Carbon Fields meta boxes (auto-assigned)
        └── *.php            # Uses carbon_create_post_meta() helpers
```

#### 3. Taxonomies (`src/taxonomy/`)
```
taxonomy/
└── {post-types}/            # COMMA-SEPARATED post type names
    └── {taxonomy-slug}/
        ├── config.php       # Auto-registers taxonomy via globals
        └── field-groups/    # Term meta fields
            └── *.php
```

#### 4. Admin Pages (`src/admin-pages/`)
```
admin-pages/
└── {page-slug}/
    ├── page.php             # Main admin page
    └── {sub-page}/          # Nested sub-pages supported
        └── page.php
```

### Responsive CSS System

**Breakpoint Configuration** (`src/config/breakpoints.php`):
- **LG** (base) - No media query wrapper, serves as foundation
- **XS, SM, MD, XL, 2XL** - Auto-wrapped with Bootstrap-inspired media queries

**Compilation Process**:
1. Block styles are compiled on-demand via `carbon_blocks_compile_styles()`
2. LG.css content serves as base styles (no wrapper)
3. Other breakpoint files get wrapped in appropriate media queries
4. Final CSS injected inline with blocks

### Key Helper Functions

All blocks use the same reusable `block.php` template:
```php
$component = basename(dirname(__FILE__));
$category = basename(dirname(dirname(__FILE__)));

Block::make(__(ucwords(str_replace('-', ' ', $component))))
    ->set_category('carbon-blocks-' . $category)
    ->set_render_callback(function ($fields, $attributes, $inner_blocks) use ($component, $category) {
        carbon_blocks_render_gutenberg($category . '/' . $component, $fields, $attributes, $inner_blocks);
    });
```

**Post Type/Taxonomy helpers**:
- `carbon_create_post_type($slug, $config)`
- `carbon_create_post_meta_with_tabs($post_type, $title, $tabs)`
- `carbon_create_taxonomy($slug, $post_types, $config)`

### Hook Timing

Critical initialization order in `src/config/setup.php`:
- `init` - Register post types and taxonomies
- `carbon_fields_register_fields` - Register blocks, admin pages, and field groups

### Development Workflow

1. **Adding Blocks**: Create directory structure in `src/blocks/{Category}/{block-name}/`
2. **Adding Post Types**: Create directory in `src/post-types/{slug}/` with `config.php`
3. **Adding Taxonomies**: Use comma-separated post types in directory name
4. **Responsive Styles**: Create breakpoint-specific CSS files (LG.css = base)
5. **Components**: Store reusable Twig templates in `components/` subdirectories

### CSS Naming Convention

BEM methodology: `carbon-block--{block-name}__element`

All components are auto-discovered and registered. The framework handles compilation, routing, and template rendering automatically.

## Umbral Editor Components Architecture

The **Umbral Editor Components** (`umbral/editor/components/`) system provides an alternative component architecture with different patterns:

### Component Structure
```
umbral/editor/components/
├── _categories.php          # Central category registration
└── {Category}/              # Category directory (Content, Heroes, etc.)
    └── {component-name}/    # Component directory
        ├── fields.php       # Component field definitions with panels/tabs
        ├── render.php       # Component renderer with query logic
        ├── view.twig        # Timber template
        ├── example.js       # Example/demo JavaScript
        └── styles/          # Responsive CSS files
            ├── XS.css
            ├── SM.css
            ├── MD.css
            ├── LG.css
            ├── XL.css
            └── 2XL.css
```

### Key Differences from Carbon Blocks

**Registration Pattern**:
- Uses centralized `_categories.php` for category registration
- Components registered via `umbral_register_component()` function
- Categories registered via `umbral_register_component_category()` function

**Field Configuration**:
- Advanced UI configuration with panels and tabs
- Built-in panel system (`content`, `query`, `display`)
- Rich field types with descriptions and defaults

**Rendering System**:
- Separate `render.php` files handle business logic
- Query building and data processing in render files
- Uses `compile_component_styles()` and `compile_component_scripts()` helpers
- Merges component context with main Timber context

### Umbral Component Development

**Adding a New Component**:
1. Create directory structure in `umbral/editor/components/{Category}/{component-name}/`
2. Define fields in `fields.php` using `umbral_register_component()`
3. Implement rendering logic in `render.php`
4. Create Timber template in `view.twig`
5. Add responsive styles in `styles/` directory

**Component Registration Example**:
```php
// In fields.php
umbral_register_component('Content', 'blog-posts', [
    'label' => 'Blog Posts',
    'description' => 'Display dynamic blog posts with advanced controls',
    'fields' => [
        '_ui_config' => ['style' => 'tabs'],
        '_panels' => [
            'content' => ['label' => 'Content', 'icon' => '📝'],
            'query' => ['label' => 'Query', 'icon' => '🔍'],
            'display' => ['label' => 'Display', 'icon' => '🎨']
        ],
        // Field definitions...
    ]
]);
```

### Development Guidelines

**When to Use Each System**:
- **Carbon Blocks**: Standard Gutenberg blocks, simple components, WordPress-native integration
- **Umbral Components**: Complex components with advanced UI, query-heavy components, custom workflows

**Shared Concepts**:
- Both systems use responsive CSS compilation
- Both use Timber/Twig for templating
- Both follow file-based auto-discovery patterns
- Both support component isolation and reusability