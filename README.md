# PWMP Plugin — Pressure Washing Marketing Pros

WordPress plugin for **Pressure Washing Marketing Pros**: marketing and business tools for pressure washing professionals.

## Requirements

- WordPress 5.8+
- PHP 7.4+

## Installation

1. Copy the plugin folder into `wp-content/plugins/`.
2. Activate **PWMP Plugin** in **Plugins** in the WordPress admin.
3. Go to **Settings → Pressure Washing Marketing Pros** to access the settings page.

## Structure

```
wordpress-boilerplate-plugin/
├── wordpress-boilerplate-plugin.php   # Main plugin file & bootstrap
├── uninstall.php                      # Runs on uninstall (cleans options)
├── includes/
│   ├── class-pwmp-activator.php       # Activation logic
│   ├── class-pwmp-deactivator.php     # Deactivation logic
│   ├── class-pwmp-loader.php          # Registers actions/filters
│   └── class-pwmp.php                 # Core plugin class
├── admin/
│   ├── class-pwmp-admin.php           # Admin menu, settings, assets
│   ├── css/admin.css
│   └── js/admin.js
├── public/
│   ├── class-pwmp-public.php          # Front-end assets & logic
│   ├── css/public.css
│   └── js/public.js
└── languages/                         # For .pot / translations
```

## Customization

- **Constants**: Edit `PWMP_*` in the main plugin file if you rename the plugin.
- **Text domain**: Use `pwmp-plugin` for all `__()`, `_e()`, etc.
- **Settings**: Add more fields in `admin/class-pwmp-admin.php` and sanitize in `sanitize_settings()`.
- **Hooks**: Register new actions/filters in `includes/class-pwmp.php` via `$this->loader`.

## Security

- All entry points use `defined( 'ABSPATH' ) || exit;`
- Settings are sanitized and capability-checked (`manage_options`)
- Use `wp_create_nonce()` and `wp_verify_nonce()` for forms and AJAX

## License

GPL-2.0+
