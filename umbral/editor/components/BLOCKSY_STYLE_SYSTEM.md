# Blocksy Style System for Umbral Components

This document outlines how to use the actual Blocksy theme's CSS variable system when creating components for the Umbral Editor. The system provides a comprehensive set of CSS variables that ensure consistency with the Blocksy WordPress theme and maintainability across your components.

## Overview

The Blocksy style system is built around:
- **Theme CSS Variables**: Comprehensive design tokens that match the actual Blocksy WordPress theme
- **Component-Scoped Variables**: Custom variables that extend the base system for specific component needs
- **Responsive Design**: Mobile-first approach with consistent breakpoints
- **WordPress Integration**: Direct integration with Blocksy theme customizer settings

## Reference Files

- **[Component Creation Guide](./COMPONENT_CREATION_GUIDE.md)** - Complete guide for creating components
- **[Example Blocksy CSS](./example_blocksy.css)** - Actual Blocksy theme CSS variable implementation

## Blocksy Theme Variables (From example_blocksy.css)

### Color Palette
The Blocksy theme provides an 8-color palette system:

```css
/* Primary Brand Colors */
--theme-palette-color-1: #2872fa;  /* Primary blue */
--theme-palette-color-2: #1559ed;  /* Primary hover blue */

/* Text Colors */
--theme-palette-color-3: #3A4F66;  /* Main text color */
--theme-palette-color-4: #192a3d;  /* Headings color */

/* Background Colors */
--theme-palette-color-5: #e1e8ed;  /* Border color */
--theme-palette-color-6: #f2f5f7;  /* Light background */
--theme-palette-color-7: #FAFBFC;  /* Body background */
--theme-palette-color-8: #ffffff;  /* White/card background */

/* Semantic Color Variables */
--theme-text-color: var(--theme-palette-color-3);
--theme-headings-color: var(--theme-palette-color-4);
--theme-border-color: var(--theme-palette-color-5);
--theme-link-initial-color: var(--theme-palette-color-1);
--theme-link-hover-color: var(--theme-palette-color-2);
```

### Typography
```css
/* Font Properties */
--theme-font-family: var(--theme-font-stack-default);
--theme-font-weight: 400;
--theme-font-size: 16px;
--theme-line-height: 1.65;

/* Heading Sizes (from example_blocksy.css) */
/* h1 */ --theme-font-size: 40px; --theme-line-height: 1.5; --theme-font-weight: 700;
/* h2 */ --theme-font-size: 35px; --theme-line-height: 1.5; --theme-font-weight: 700;
/* h3 */ --theme-font-size: 30px; --theme-line-height: 1.5; --theme-font-weight: 700;
/* h4 */ --theme-font-size: 25px; --theme-line-height: 1.5; --theme-font-weight: 700;
/* h5 */ --theme-font-size: 20px; --theme-line-height: 1.5; --theme-font-weight: 700;
/* h6 */ --theme-font-size: 16px; --theme-line-height: 1.5; --theme-font-weight: 700;
```

### Spacing & Layout
```css
/* Content Spacing */
--theme-content-spacing: 1.5em;              /* Primary spacing unit */
--theme-content-vertical-spacing: 60px;      /* Section spacing */

/* Container Widths */
--theme-normal-container-max-width: 1290px;
--theme-narrow-container-max-width: 750px;
--theme-wide-offset: 130px;
--theme-container-edge-spacing: 90vw;
```

### Buttons
```css
/* Button Styling */
--theme-button-min-height: 40px;
--theme-button-font-weight: 500;
--theme-button-font-size: 15px;
--theme-button-padding: 5px 20px;
--theme-button-text-initial-color: #ffffff;
--theme-button-text-hover-color: #ffffff;
--theme-button-background-initial-color: var(--theme-palette-color-1);
--theme-button-background-hover-color: var(--theme-palette-color-2);
--theme-button-border: none;
--theme-button-shadow: none;
--theme-button-transform: none;
```

## Component Styling Architecture

### 1. Component CSS Variables and Base Stylesheet

**LG.css as Base Stylesheet**: The `LG.css` file serves as the base stylesheet for each component. This is where you should:

1. **Define component-scoped CSS variables** that extend the Blocksy theme system
2. **Add custom styles or variables** that don't exist in the [example_blocksy.css](./example_blocksy.css)
3. **Scope all variables to the component** to prevent conflicts with other components

**LG.css Structure:**
```css
/* Component-scoped variables extending Blocksy theme system */
#{{ component_id }} {
    /* Always scope variables to the component ID */
    --component-bg: var(--theme-palette-color-8);
    --component-text: var(--theme-text-color);
    --component-accent: var(--theme-palette-color-1);
    --component-spacing: var(--theme-content-spacing);
    --component-border: var(--theme-border-color);
    
    /* Custom variables not in Blocksy theme system */
    --component-custom-gradient: linear-gradient(135deg, var(--theme-palette-color-1), var(--theme-palette-color-2));
    --component-hover-lift: -4px;
    --component-shadow: 0px 12px 18px -6px rgba(34, 56, 101, 0.04);
    --component-transition: all 0.15s ease;
}

/* Desktop-specific component styles */
.my-component .element {
    background: var(--component-bg);
    color: var(--component-text);
    padding: var(--component-spacing);
    border: 1px solid var(--component-border);
    transition: var(--component-transition);
}

.my-component .element:hover {
    transform: translateY(var(--component-hover-lift));
    box-shadow: var(--component-shadow);
}
```

**Best Practices for LG.css:**
- ✅ **Use actual Blocksy theme variables** from [example_blocksy.css](./example_blocksy.css)
- ✅ **Scope all custom variables** to `#{{ component_id }}`
- ✅ **Use semantic variable names** that describe purpose, not appearance
- ✅ **Extend theme variables** rather than creating completely new values
- ❌ **Don't create variables** that already exist in the Blocksy theme system

**Key Theme Variables to Use:**
- Colors: `--theme-palette-color-1` through `--theme-palette-color-8`
- Typography: `--theme-text-color`, `--theme-headings-color`, `--theme-font-size`
- Spacing: `--theme-content-spacing`, `--theme-content-vertical-spacing`
- Buttons: `--theme-button-*` variables
- Layout: `--theme-normal-container-max-width`, `--theme-border-color`

### 2. Responsive CSS Structure

Each component uses separate CSS files for different breakpoints:

```
styles/
├── XS.css     # Mobile (< 576px)
├── SM.css     # Small tablets (≥ 576px)
├── MD.css     # Tablets (≥ 768px)
├── LG.css     # Desktop Base (≥ 992px) - Contains component CSS variables
├── XL.css     # Large desktop (≥ 1200px)
└── 2XL.css    # Extra large (≥ 1400px)
```

**Important**: The `LG.css` file serves as the **base stylesheet** for each component. This is where you should define component-scoped CSS variables and any custom styles that don't exist in the [example_blocksy.css](./example_blocksy.css). Always prefer using existing Blocksy theme variables before creating custom ones.

### 3. Breakpoint-Specific Styling

**XS.css** (Mobile-first):
```css
/* Mobile styles using Blocksy theme variables */
.feature-grid .grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--theme-content-spacing);
    padding: var(--theme-content-spacing);
}

.feature-grid .card {
    padding: var(--theme-content-spacing);
    border-radius: 8px;
    background: var(--theme-palette-color-8);
    border: 1px solid var(--theme-border-color);
}
```

**LG.css** (Desktop Base Stylesheet):
```css
/* Component-scoped variables (define in LG.css) */
#{{ component_id }} {
    --grid-columns: 3;
    --grid-gap: calc(var(--theme-content-spacing) * 1.5);
    --card-hover-lift: -4px;
    --card-transition: all 0.15s ease;
    --card-shadow: 0px 12px 18px -6px rgba(34, 56, 101, 0.04);
    --card-shadow-hover: 0px 15px 25px -5px rgba(34, 56, 101, 0.15);
}

/* Desktop styles using component variables */
.feature-grid .grid {
    grid-template-columns: repeat(var(--grid-columns), 1fr);
    gap: var(--grid-gap);
    padding: calc(var(--theme-content-spacing) * 1.5);
}

.feature-grid .card {
    box-shadow: var(--card-shadow);
    transition: var(--card-transition);
}

.feature-grid .card:hover {
    transform: translateY(var(--card-hover-lift));
    box-shadow: var(--card-shadow-hover);
}
```

## Component Patterns

### Card Pattern
```css
.my-component .card {
    /* Use Blocksy theme card pattern */
    background: var(--theme-palette-color-8);
    border: 1px solid var(--theme-border-color);
    border-radius: 8px;
    box-shadow: 0px 12px 18px -6px rgba(34, 56, 101, 0.04);
    padding: var(--theme-content-spacing);
    transition: all 0.15s ease;
}

.my-component .card:hover {
    box-shadow: 0px 15px 25px -5px rgba(34, 56, 101, 0.15);
    transform: translateY(-4px);
}
```

### Button Pattern
```css
.my-component .button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: var(--theme-button-padding);
    background: var(--theme-button-background-initial-color);
    color: var(--theme-button-text-initial-color);
    border-radius: 4px;
    font-weight: var(--theme-button-font-weight);
    font-size: var(--theme-button-font-size);
    min-height: var(--theme-button-min-height);
    border: var(--theme-button-border);
    text-decoration: none;
    transition: all 0.15s ease;
}

.my-component .button:hover {
    background: var(--theme-button-background-hover-color);
    color: var(--theme-button-text-hover-color);
    transform: translateY(-2px);
}
```

### Grid Pattern
```css
.my-component .grid {
    display: grid;
    gap: var(--theme-content-spacing);
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    max-width: var(--theme-normal-container-max-width);
    margin: 0 auto;
}
```

### Typography Pattern
```css
.my-component .title {
    font-size: 2rem; /* or use heading variables from example_blocksy.css */
    color: var(--theme-headings-color);
    font-weight: 700;
    line-height: 1.5;
    margin-bottom: calc(var(--theme-content-spacing) * 0.5);
}

.my-component .text {
    color: var(--theme-text-color);
    font-size: var(--theme-font-size);
    line-height: var(--theme-line-height);
}

.my-component .link {
    color: var(--theme-link-initial-color);
    text-decoration: none;
}

.my-component .link:hover {
    color: var(--theme-link-hover-color);
}
```

## Best Practices

### 1. Always Use Blocksy Theme Variables
```css
/* ✅ Good - Using actual Blocksy theme variables */
.component {
    color: var(--theme-text-color);
    padding: var(--theme-content-spacing);
    border: 1px solid var(--theme-border-color);
    background: var(--theme-palette-color-8);
}

/* ❌ Bad - Hard-coded values */
.component {
    color: #3A4F66;
    padding: 24px;
    border: 1px solid #e1e8ed;
    background: #ffffff;
}
```

### 2. Scope Variables to Components (Always in LG.css)
```css
/* ✅ Good - Component-scoped variables in LG.css */
#{{ component_id }} {
    --card-bg: var(--theme-palette-color-8);
    --card-hover-bg: var(--theme-palette-color-7);
    --card-border: var(--theme-border-color);
    --card-text: var(--theme-text-color);
    --card-accent: var(--theme-palette-color-1);
    
    /* Custom variables for component-specific needs */
    --card-shadow: 0px 12px 18px -6px rgba(34, 56, 101, 0.04);
    --card-hover-lift: -4px;
    --card-transition: all 0.15s ease;
}

#{{ component_id }} .card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    color: var(--card-text);
    box-shadow: var(--card-shadow);
    transition: var(--card-transition);
}

#{{ component_id }} .card:hover {
    background: var(--card-hover-bg);
    transform: translateY(var(--card-hover-lift));
}
```

### 3. Mobile-First Responsive Design
```css
/* XS.css - Mobile first */
.component {
    padding: var(--theme-content-spacing);
    font-size: var(--theme-font-size);
}

/* LG.css - Desktop enhancement */
.component {
    padding: calc(var(--theme-content-spacing) * 1.5);
    font-size: 1.125rem;
}
```

### 4. Consistent Hover States
```css
.component .interactive-element {
    transition: all 0.15s ease;
}

.component .interactive-element:hover {
    transform: translateY(-2px);
    box-shadow: 0px 12px 18px -6px rgba(34, 56, 101, 0.04);
}
```

### 5. Respect Theme Customizer Settings
The Blocksy theme variables automatically reflect user customizer settings:

```css
/* Variables automatically use customizer settings */
.component {
    background: var(--theme-palette-color-8); /* Uses user's white color choice */
    color: var(--theme-text-color); /* Uses user's text color choice */
    border-color: var(--theme-border-color); /* Uses user's border color choice */
}
```

### 6. Use Semantic Variable Names in Components
```css
/* ✅ Good - Semantic component variable names */
#{{ component_id }} {
    --pricing-card-bg: var(--theme-palette-color-8);
    --pricing-featured-border: var(--theme-palette-color-1);
    --pricing-text-muted: var(--theme-text-color);
}

/* ❌ Bad - Non-semantic names */
#{{ component_id }} {
    --blue-border: var(--theme-palette-color-1);
    --white-bg: var(--theme-palette-color-8);
}
```

## Implementation Example: Pricing Card Component

Here's a complete example showing the corrected pricing card component using the actual Blocksy theme system:

**view.twig**:
```html
{# Styles and scripts are auto-enqueued by compileComponent() #}
<section id="{{ component_id }}" class="pricing-card">
    <div class="pricing-card-container {{ card_style }} {{ alignment }} {% if featured %}featured{% endif %}">
        {% if featured and featured_badge %}
            <div class="featured-badge">{{ featured_badge }}</div>
        {% endif %}
        
        <div class="card-header">
            <h3 class="plan-name">{{ plan_name }}</h3>
            {% if plan_description %}
                <p class="plan-description">{{ plan_description }}</p>
            {% endif %}
        </div>
        
        <div class="card-pricing">
            <div class="price">{{ price }}</div>
            {% if billing_period %}
                <div class="billing-period">{{ billing_period }}</div>
            {% endif %}
        </div>
        
        {% if features %}
            <div class="card-features">
                <ul class="features-list">
                    {% for feature in features %}
                        <li class="feature-item {{ feature.included ? 'included' : 'not-included' }}">
                            <span class="feature-icon">{{ feature.included ? '✓' : '✗' }}</span>
                            <span class="feature-text">{{ feature.text }}</span>
                        </li>
                    {% endfor %}
                </ul>
            </div>
        {% endif %}
        
        <div class="card-actions">
            <a href="{{ cta_url }}" class="cta-button primary">{{ cta_text }}</a>
        </div>
    </div>
</section>
```

**styles/XS.css**:
```css
/* Mobile styles using Blocksy theme variables */
.pricing-card {
    padding: calc(var(--theme-content-spacing) * 0.75);
}

.pricing-card .pricing-card-container {
    padding: var(--theme-content-spacing);
    width: 100%;
    max-width: 100%;
}

.pricing-card .plan-name {
    font-size: 1.125rem;
}

.pricing-card .price {
    font-size: 2rem;
}

.pricing-card .feature-item {
    padding: calc(var(--theme-content-spacing) * 0.4) 0;
}

.pricing-card .card-actions {
    flex-direction: column;
    gap: calc(var(--theme-content-spacing) * 0.4);
}
```

**styles/LG.css** (Base Stylesheet with Blocksy variables):
```css
/* Component-scoped variables extending Blocksy theme system */
#{{ component_id }} {
    --card-bg: var(--theme-palette-color-8);
    --card-border: var(--theme-palette-color-5);
    --card-featured-border: var(--theme-palette-color-1);
    --card-hover-lift: -6px;
    --card-transition: all 0.15s ease;
    --card-gradient: linear-gradient(135deg, var(--theme-palette-color-1), var(--theme-palette-color-2));
    --card-shadow: 0px 12px 18px -6px rgba(34, 56, 101, 0.04);
    --card-shadow-hover: 0px 15px 25px -5px rgba(34, 56, 101, 0.15);
    --card-padding: var(--theme-content-spacing);
    --card-border-radius: 8px;
}

/* Desktop styles using component variables and Blocksy system */
.pricing-card {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: var(--card-padding);
}

.pricing-card .pricing-card-container {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--card-border-radius);
    box-shadow: var(--card-shadow);
    padding: var(--card-padding);
    position: relative;
    transition: var(--card-transition);
    width: 100%;
    max-width: 400px;
}

.pricing-card .pricing-card-container:hover {
    transform: translateY(var(--card-hover-lift));
    box-shadow: var(--card-shadow-hover);
}

.pricing-card .pricing-card-container.featured {
    border-color: var(--card-featured-border);
    transform: scale(1.02);
    box-shadow: var(--card-shadow-hover);
}

.pricing-card .pricing-card-container.card-style-gradient {
    background: var(--card-gradient);
    color: var(--theme-palette-color-8);
    border: none;
}

.pricing-card .plan-name {
    font-size: 1.25rem;
    color: var(--theme-headings-color);
    margin-bottom: calc(var(--theme-content-spacing) * 0.5);
    font-weight: var(--theme-font-weight);
}

.pricing-card .price {
    font-size: 2.5rem;
    color: var(--theme-headings-color);
    font-weight: 700;
    margin-bottom: calc(var(--theme-content-spacing) * 0.25);
}

.pricing-card .cta-button {
    padding: var(--theme-button-padding);
    background: var(--theme-button-background-initial-color);
    color: var(--theme-button-text-initial-color);
    font-weight: var(--theme-button-font-weight);
    font-size: var(--theme-button-font-size);
    min-height: var(--theme-button-min-height);
    text-decoration: none;
    border-radius: 4px;
    transition: var(--card-transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.pricing-card .cta-button:hover {
    background: var(--theme-button-background-hover-color);
    color: var(--theme-button-text-hover-color);
    transform: translateY(-2px);
}
```

This implementation demonstrates:

1. **Proper use of Blocksy theme variables** from `example_blocksy.css`
2. **Component-scoped custom variables** in the `LG.css` file
3. **Responsive design** with mobile-first approach
4. **Semantic variable naming** that describes purpose, not appearance
5. **Integration with WordPress theme customizer** settings through Blocksy variables

## Related Documentation

- **[Component Creation Guide](./COMPONENT_CREATION_GUIDE.md)** - Complete guide for creating components
- **[Example Blocksy CSS](./example_blocksy.css)** - Actual Blocksy theme CSS variable implementation used in this project