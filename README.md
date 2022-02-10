# Pattern

A theme for Wordpress by Foaud Vollmer

## Plugins

- GDY Modular Content
- ACF Pro
- Classic Editor
- Complianz GDPR

## Usage

1. Download latest release.
2. Place the unpacked theme folder in the themes folder.
3. Install & activate the required plugins.
4. Activate the theme.
6. Go to *ACF* menu and import the field group within the *Sync available* tab.
5. Go to *Theme* menu and add your smtp settings in the *Secrets* tab.
7. Create a new page and use it as your homepage.
8. Visit your frontend and start placing modules.

## Conventions

Use these rules to participate in development.

### SCSS Classes

**BEM – Block Elment Modifier** 
Use BEM for Class naming in SCSS. This supports nesting within SCSS classes and leads to a natural scoping of those classes.

1. Use the module or component as *block* (inhalt, navigation). **Important:** There should be an individual stylesheet for the block.
2. Give a meaningful name to your *element* (cta, mobile-trigger)
3. Create a *modifiers* if necessary (hidden, disabled)

Your class will then look like this: ´.navigation__mobile-trigger--hidden´
