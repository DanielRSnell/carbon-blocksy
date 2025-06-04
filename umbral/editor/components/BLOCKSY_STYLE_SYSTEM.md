# Blocksy Style System for Umbral Components

This comprehensive guide explains how to design and implement components using the Blocksy theme design system with a CSS variable-driven responsive architecture.

## Table of Contents

1. [Core Philosophy](#core-philosophy)
2. [Blocksy Design Tokens](#blocksy-design-tokens)
3. [Component Architecture](#component-architecture)
4. [CSS Variable System](#css-variable-system)
5. [Responsive Breakpoint Strategy](#responsive-breakpoint-strategy)
6. [Implementation Guidelines](#implementation-guidelines)
7. [Best Practices](#best-practices)
8. [Common Patterns](#common-patterns)
9. [Troubleshooting](#troubleshooting)

## Core Philosophy

### Design Principles
1. **Blocksy-First**: Always use Blocksy theme variables for colors, typography, and base spacing
2. **Component-Scoped**: Create component-specific variables that extend Blocksy tokens
3. **Variable-Driven Responsive**: Breakpoints only change CSS variables, not rules
4. **Progressive Enhancement**: Start with mobile, enhance for larger screens
5. **Maintainability**: Single source of truth for all styling logic

### Architecture Overview
```
Component Styling Architecture:
├── LG.css (Base styles + all CSS rules)
├── XS.css (Mobile variable overrides)
├── SM.css (Small tablet variable overrides)
├── MD.css (Tablet variable overrides)
├── XL.css (Large desktop variable overrides)
└── 2XL.css (Extra large variable overrides)
```

## Blocksy Design Tokens

### Core Color System
```css
/* Primary Colors */
--theme-palette-color-1: #2872fa;  /* Primary blue */
--theme-palette-color-2: #1559ed;  /* Primary hover blue */
--theme-palette-color-3: #3A4F66;  /* Main text color */
--theme-palette-color-4: #192a3d;  /* Headings color */
--theme-palette-color-5: #e1e8ed;  /* Border color */
--theme-palette-color-6: #f2f5f7;  /* Light background */
--theme-palette-color-7: #FAFBFC;  /* Body background */
--theme-palette-color-8: #ffffff;  /* White/card background */

/* Semantic Variables */
--theme-text-color: var(--theme-palette-color-3);
--theme-headings-color: var(--theme-palette-color-4);
--theme-border-color: var(--theme-palette-color-5);
--theme-link-initial-color: var(--theme-palette-color-1);
--theme-link-hover-color: var(--theme-palette-color-2);
```

### Button System
```css
--theme-button-background-initial-color: var(--theme-palette-color-1);
--theme-button-background-hover-color: var(--theme-palette-color-2);
--theme-button-text-initial-color: #ffffff;
--theme-button-padding: 5px 20px;
--theme-button-min-height: 40px;
--theme-button-font-weight: 600;
--theme-button-font-size: 1rem;
```

### Typography Scale
```css
--theme-content-spacing: 1.5em;        /* Base spacing unit */
--theme-content-vertical-spacing: 60px; /* Section spacing */

/* Font sizes (use sparingly, prefer component-specific) */
--theme-font-size-small: 0.875rem;
--theme-font-size-base: 1rem;
--theme-font-size-large: 1.125rem;
```

## Component Architecture

### File Structure Pattern
```
component-name/
├── fields.php          # CMB2 field definitions
├── render.php          # PHP logic and context
├── view.twig           # HTML template
└── styles/             # Responsive CSS files
    ├── XS.css         # Mobile (< 576px)
    ├── SM.css         # Small tablets (≥ 576px)
    ├── MD.css         # Tablets (≥ 768px)
    ├── LG.css         # Desktop (≥ 992px) - BASE STYLES
    ├── XL.css         # Large desktop (≥ 1200px)
    └── 2XL.css        # Extra large (≥ 1400px)
```

### Compilation Process
The system automatically:
1. Compiles all CSS files in breakpoint order
2. Wraps breakpoint files in appropriate media queries
3. Injects compiled CSS inline with the component
4. Uses component ID for scoping: `#{{ component_id }}`

## CSS Variable System

### Variable Architecture Pattern

#### 1. LG.css - Base Styles (≥ 992px)
This file contains **ALL CSS rules** and **base variables**:

```css
/* Component-scoped variables using Blocksy colors */
#{{ component_id }} {
    /* Layout variables */
    --hero-padding: 80px;
    --container-max-width: 1200px;
    --container-padding: 24px;
    --content-gap: 60px;
    --content-grid-columns: 1fr 1.2fr;
    
    /* Typography variables */
    --title-font-size: 3.5rem;
    --title-line-height: 1.1;
    --title-letter-spacing: -0.02em;
    --subtitle-font-size: 1.25rem;
    --subtitle-max-width: 480px;
    
    /* Component variables */
    --card-border-radius: 24px;
    --card-padding: 24px;
    --button-padding: 16px 32px;
    --button-border-radius: 50px;
    
    /* Blocksy color integration */
    --hero-bg: #f0f1f2;
    --text-primary: var(--theme-headings-color);
    --text-secondary: var(--theme-text-color);
    --card-bg: var(--theme-palette-color-8);
    --button-bg: var(--theme-button-background-initial-color);
    --button-hover-bg: var(--theme-button-background-hover-color);
    --button-text: var(--theme-button-text-initial-color);
    
    /* Effects */
    --card-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ALL CSS RULES GO HERE - using variables */
.component-hero {
    background: var(--hero-bg);
    padding: var(--hero-padding) 0;
}

.component-hero__container {
    max-width: var(--container-max-width);
    margin: 0 auto;
    padding: 0 var(--container-padding);
}

.component-hero__content {
    display: grid;
    grid-template-columns: var(--content-grid-columns);
    gap: var(--content-gap);
}

.component-hero__title {
    font-size: var(--title-font-size);
    line-height: var(--title-line-height);
    letter-spacing: var(--title-letter-spacing);
    color: var(--text-primary);
}

.component-hero__button {
    padding: var(--button-padding);
    background: var(--button-bg);
    color: var(--button-text);
    border-radius: var(--button-border-radius);
    transition: var(--transition);
}

.component-hero__button:hover {
    background: var(--button-hover-bg);
}

/* All other CSS rules... */
```

#### 2. Breakpoint Files - Variable Overrides Only
Smaller breakpoints only override variables, no CSS rules:

**XS.css (Mobile < 576px):**
```css
/* Mobile variable overrides */
#{{ component_id }} {
    --hero-padding: 60px;
    --container-padding: 20px;
    --content-gap: 48px;
    --title-font-size: 2rem;
    --title-letter-spacing: -0.015em;
    --subtitle-font-size: 1rem;
    --card-border-radius: 20px;
    --card-padding: 20px;
    --button-padding: 14px 28px;
}

/* Layout-specific overrides only */
.component-hero__content {
    display: flex;
    flex-direction: column;
}

.component-hero__text-section {
    order: 2;
    text-align: center;
}

.component-hero__showcase {
    order: 1;
}
```

**SM.css (Small Tablets ≥ 576px):**
```css
#{{ component_id }} {
    --hero-padding: 70px;
    --title-font-size: 2.5rem;
    --content-grid-columns: 1.2fr 1fr;
}

/* Minimal layout overrides */
.component-hero__content {
    display: grid;
}
```

**MD.css (Tablets ≥ 768px):**
```css
#{{ component_id }} {
    --container-max-width: 1000px;
    --content-gap: 48px;
    --title-font-size: 3rem;
    --subtitle-font-size: 1.2rem;
}

.component-hero__text-section {
    text-align: left;
}
```

**XL.css (Large Desktop ≥ 1200px):**
```css
#{{ component_id }} {
    --hero-padding: 100px;
    --container-max-width: 1300px;
    --content-gap: 80px;
    --title-font-size: 4rem;
    --subtitle-font-size: 1.375rem;
    --card-padding: 28px;
}
```

**2XL.css (Extra Large ≥ 1400px):**
```css
#{{ component_id }} {
    --hero-padding: 120px;
    --container-max-width: 1400px;
    --content-gap: 100px;
    --title-font-size: 4.75rem;
    --title-letter-spacing: -0.03em;
    --subtitle-font-size: 1.5rem;
}
```

## Responsive Breakpoint Strategy

### Breakpoint Definitions
```css
/* XS: < 576px    - Mobile phones */
/* SM: ≥ 576px    - Large phones, small tablets */
/* MD: ≥ 768px    - Tablets */
/* LG: ≥ 992px    - Small laptops, large tablets (BASE) */
/* XL: ≥ 1200px   - Laptops, desktops */
/* 2XL: ≥ 1400px  - Large desktops, ultrawide */
```

### Design Approach
1. **LG as Base**: Desktop-first approach with LG containing all CSS rules
2. **Mobile Overrides**: XS/SM override variables for smaller screens
3. **Progressive Enhancement**: MD/XL/2XL enhance for larger screens
4. **Variable-Only Changes**: Breakpoints primarily change variables, not structure

### Scaling Patterns
```css
/* Typography Scaling */
Mobile (XS):    2rem    → 2.5rem    → 3rem     → 3.5rem   → 4rem     → 4.75rem
                (XS)      (SM)        (MD)       (LG base)  (XL)       (2XL)

/* Spacing Scaling */
Padding:        60px    → 70px      → 80px     → 80px     → 100px    → 120px
Gap:            48px    → 56px      → 48px     → 60px     → 80px     → 100px

/* Component Scaling */
Border Radius:  20px    → 22px      → 24px     → 24px     → 26px     → 28px
Button Padding: 14px 28px → 16px 32px → 16px 32px → 16px 32px → 18px 36px → 20px 40px
```

## Implementation Guidelines

### 1. Starting a New Component

**Step 1: Define Base Variables in LG.css**
```css
#{{ component_id }} {
    /* Layout */
    --component-padding: 80px;
    --container-max-width: 1200px;
    --content-gap: 60px;
    
    /* Typography */
    --title-size: 3.5rem;
    --subtitle-size: 1.25rem;
    
    /* Components */
    --card-radius: 24px;
    --button-radius: 50px;
    
    /* Blocksy Integration */
    --primary-bg: var(--theme-palette-color-1);
    --text-color: var(--theme-text-color);
    --card-bg: var(--theme-palette-color-8);
}
```

**Step 2: Write All CSS Rules Using Variables**
```css
.component-name {
    padding: var(--component-padding) 0;
    background: var(--primary-bg);
}

.component-name__title {
    font-size: var(--title-size);
    color: var(--text-color);
}
```

**Step 3: Create Responsive Overrides**
Only override the variables that need to change per breakpoint.

### 2. Variable Naming Conventions

**Hierarchy Pattern:**
```css
/* Layout */
--component-padding
--container-max-width
--content-gap
--section-spacing

/* Typography */
--title-font-size
--title-line-height
--title-letter-spacing
--subtitle-font-size
--body-font-size

/* Components */
--card-padding
--card-border-radius
--button-padding
--button-border-radius
--icon-size

/* Spacing */
--element-gap
--item-spacing
--margin-bottom
```

**Descriptive Names:**
```css
/* ✅ Good */
--hero-title-size
--product-card-padding
--cta-button-radius

/* ❌ Avoid */
--size-1
--padding-large
--radius
```

### 3. Blocksy Integration Patterns

**Color Integration:**
```css
/* Always use Blocksy variables for colors */
--primary-color: var(--theme-palette-color-1);
--secondary-color: var(--theme-palette-color-2);
--text-primary: var(--theme-headings-color);
--text-secondary: var(--theme-text-color);
--border-color: var(--theme-border-color);
--background-color: var(--theme-palette-color-8);
```

**Button Integration:**
```css
/* Extend Blocksy button system */
--button-bg: var(--theme-button-background-initial-color);
--button-hover-bg: var(--theme-button-background-hover-color);
--button-text: var(--theme-button-text-initial-color);
--button-min-height: var(--theme-button-min-height);
--button-font-weight: var(--theme-button-font-weight);
```

**Spacing Integration:**
```css
/* Use theme spacing as base, create component-specific */
--base-spacing: var(--theme-content-spacing);  /* 1.5em */
--component-gap: calc(var(--base-spacing) * 2); /* 3em */
--section-padding: calc(var(--base-spacing) * 4); /* 6em */
```

## Best Practices

### 1. Variable Organization
```css
#{{ component_id }} {
    /* 1. Layout variables first */
    --component-padding: 80px;
    --container-max-width: 1200px;
    
    /* 2. Typography variables */
    --title-font-size: 3.5rem;
    --subtitle-font-size: 1.25rem;
    
    /* 3. Component-specific variables */
    --card-border-radius: 24px;
    --button-padding: 16px 32px;
    
    /* 4. Blocksy color integration */
    --primary-color: var(--theme-palette-color-1);
    --text-color: var(--theme-text-color);
    
    /* 5. Effects and transitions */
    --box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}
```

### 2. Responsive Design Rules
1. **Mobile-First Mindset**: Design for mobile, enhance for desktop
2. **Variable Scaling**: Use consistent scaling ratios across breakpoints
3. **Layout Flexibility**: Change layout structure only when necessary
4. **Performance**: Minimize CSS rule duplication across breakpoints

### 3. Blocksy Integration
1. **Always Use Theme Colors**: Never hardcode colors that exist in Blocksy
2. **Extend, Don't Replace**: Build on Blocksy's button/typography system
3. **Semantic Variables**: Use semantic Blocksy variables over palette numbers
4. **Consistent Shadows**: Use similar shadow patterns to Blocksy components

## Common Patterns

### 1. Hero Section Pattern
```css
#{{ component_id }} {
    /* Hero-specific variables */
    --hero-min-height: 600px;
    --hero-content-gap: 60px;
    --hero-grid-columns: 1fr 1.2fr;
    
    /* Blocksy integration */
    --hero-bg: var(--theme-palette-color-7);
    --hero-text: var(--theme-text-color);
    --hero-heading: var(--theme-headings-color);
}

.hero-component {
    min-height: var(--hero-min-height);
    background: var(--hero-bg);
    color: var(--hero-text);
}

.hero-component__content {
    display: grid;
    grid-template-columns: var(--hero-grid-columns);
    gap: var(--hero-content-gap);
}
```

### 2. Card Grid Pattern
```css
#{{ component_id }} {
    --grid-columns: repeat(auto-fit, minmax(300px, 1fr));
    --grid-gap: 24px;
    --card-padding: 32px;
    --card-radius: 16px;
    --card-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    
    /* Blocksy colors */
    --card-bg: var(--theme-palette-color-8);
    --card-text: var(--theme-text-color);
    --card-border: var(--theme-border-color);
}

.card-grid {
    display: grid;
    grid-template-columns: var(--grid-columns);
    gap: var(--grid-gap);
}

.card {
    background: var(--card-bg);
    color: var(--card-text);
    padding: var(--card-padding);
    border-radius: var(--card-radius);
    box-shadow: var(--card-shadow);
    border: 1px solid var(--card-border);
}
```

### 3. Button Variants Pattern
```css
#{{ component_id }} {
    /* Primary button (uses Blocksy defaults) */
    --btn-primary-bg: var(--theme-button-background-initial-color);
    --btn-primary-hover: var(--theme-button-background-hover-color);
    --btn-primary-text: var(--theme-button-text-initial-color);
    
    /* Secondary button */
    --btn-secondary-bg: transparent;
    --btn-secondary-hover: var(--theme-palette-color-1);
    --btn-secondary-text: var(--theme-palette-color-1);
    --btn-secondary-border: var(--theme-palette-color-1);
    
    /* Button sizing */
    --btn-padding: var(--theme-button-padding);
    --btn-radius: 50px;
    --btn-min-height: var(--theme-button-min-height);
}

.component-button {
    padding: var(--btn-padding);
    border-radius: var(--btn-radius);
    min-height: var(--btn-min-height);
    font-weight: var(--theme-button-font-weight);
    transition: var(--transition);
}

.component-button--primary {
    background: var(--btn-primary-bg);
    color: var(--btn-primary-text);
}

.component-button--primary:hover {
    background: var(--btn-primary-hover);
}

.component-button--secondary {
    background: var(--btn-secondary-bg);
    color: var(--btn-secondary-text);
    border: 2px solid var(--btn-secondary-border);
}
```

## Troubleshooting

### Common Issues

**1. Variables Not Working**
```css
/* ❌ Problem: Variable not scoped to component */
:root {
    --title-size: 3rem;
}

/* ✅ Solution: Scope to component ID */
#{{ component_id }} {
    --title-size: 3rem;
}
```

**2. Responsive Scaling Issues**
```css
/* ❌ Problem: Inconsistent scaling */
--title-size: 2rem;    /* XS */
--title-size: 4rem;    /* SM - too big jump */

/* ✅ Solution: Progressive scaling */
--title-size: 2rem;    /* XS */
--title-size: 2.5rem;  /* SM */
--title-size: 3rem;    /* MD */
--title-size: 3.5rem;  /* LG */
```

**3. Color Consistency Issues**
```css
/* ❌ Problem: Hardcoded colors */
--card-bg: #ffffff;
--text-color: #333333;

/* ✅ Solution: Use Blocksy variables */
--card-bg: var(--theme-palette-color-8);
--text-color: var(--theme-text-color);
```

**4. Layout Breaking on Mobile**
```css
/* ❌ Problem: Desktop grid on mobile */
.component__content {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Breaks on mobile */
}

/* ✅ Solution: Override layout structure */
/* XS.css */
.component__content {
    display: flex;
    flex-direction: column;
}
```

### Debugging Tips
1. **Use Browser DevTools**: Inspect computed values of CSS variables
2. **Check Variable Scope**: Ensure variables are scoped to `#{{ component_id }}`
3. **Verify Media Queries**: Confirm breakpoint CSS is loading at correct screen sizes
4. **Test Blocksy Integration**: Check that Blocksy variables are available and working

### Performance Considerations
1. **Minimize Variable Count**: Only create variables for values that change
2. **Avoid Deep Nesting**: Keep variable calculations simple
3. **Group Related Variables**: Organize variables logically for better compression
4. **Use Semantic Names**: Descriptive names improve maintainability without performance cost

---

This system ensures consistent, maintainable, and scalable component styling that integrates seamlessly with the Blocksy theme while providing maximum flexibility for responsive design.