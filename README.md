# Pattern

A theme for Wordpress by Foaud Vollmer

## Plugins

- GDY Modular Content
- ACF Pro
- Classic Editor
- Complianz GDPR

## Conventions

Use these rules to participate in development.

### SCSS Classes

**BEM – Block Elment Modifier** 
Use BEM for Class naming in SCSS. This supports nesting within SCSS classes and leads to a natural scoping of those classes.

1. Use the module or component as *block* (inhalt, navigation). **Important:** There should be an individual stylesheet for the block.
2. Give a meaningful name to your *element* (cta, mobile-trigger)
3. Create a *modifiers* if necessary (hidden, disabled)

Your class will then look like this: ´.navigation__mobile-trigger--hidden´
