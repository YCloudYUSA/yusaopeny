<p align="center">
  <a href="https://ycloud.y.org/open-y-association-websites">
    <img alt="YMCA Website Services" src="https://www.ymcanorth.org/themes/custom/ymca/img/ymca-logo.svg" width="144">
  </a>
</p>

<h3 align="center">
  YMCA Website Services
</h3>
<p align="center">
  <a href="https://ycloud.y.org/open-y-association-websites">ycloud.y.org/open-y-association-websites</a>
</p>
<p align="center">
  An open-source platform for YMCAs, by YMCAs, built on <a href="https://drupal.org">Drupal</a>.
</p>

<p align="center">
  <a href="https://packagist.org/packages/ycloudyusa/yusaopeny"><img src="https://img.shields.io/packagist/v/ycloudyusa/yusaopeny.svg?style=flat-square"></a>
  <a href="https://packagist.org/packages/ycloudyusa/yusaopeny"><img src="https://img.shields.io/packagist/dm/ycloudyusa/yusaopeny.svg?style=flat-square"></a>
</p>

***

# YMCA Website Services Distribution

**YMCA Website Services** (formerly OpenY) is a Drupal distribution built specifically for YMCAs. This repository contains the installation profile that provides content types, modules, configuration, and features for building YMCA websites.

- **Distribution Repository**: https://github.com/YCloudYUSA/yusaopeny
- **Project Template**: https://github.com/YCloudYUSA/yusaopeny-project
- **Documentation**: https://ds-docs.y.org
- **Community**: https://ycloud.y.org/open-y-association-websites


## System Requirements

- **Drupal**: 11.1.x
- **PHP**: 8.3 or higher
- **Composer**: 2.0 or higher
- **Database**: MySQL 8.0+ or MariaDB 10.6+
- **Web Server**: Apache 2.4+ or Nginx 1.18+

For detailed server requirements, see the [YMCA Website Services server requirements](https://ds-docs.y.org/docs/development/server-requirements/).

## Quick Start

### Create a New Project

**Latest stable release:**
```bash
composer create-project ycloudyusa/yusaopeny-project MY_PROJECT --no-interaction
cd MY_PROJECT
```

**Latest development version (Drupal 11):**
```bash
composer create-project ycloudyusa/yusaopeny-project:dev-main-development MY_PROJECT --no-interaction
cd MY_PROJECT
```

### Development Environments

#### Docksal (Recommended)

[Docksal](https://docksal.io) provides a complete Docker-based development environment:

```bash
# Install Docksal (if not already installed)
# See https://docksal.io/installation

# Initialize the project
fin init

# Access the site
# Default URL: http://yusaopeny.docksal.site
```

For more details, see the [installation documentation](https://ds-docs.y.org/docs/development/installationwithdrush/).

#### DDEV

DDEV support is available with basic configuration in the `.ddev/` directory.

#### Manual Installation

If using your own environment, after creating the project:

```bash
# Configure your database settings
# Edit docroot/sites/default/settings.php

# Install Drupal with the Web UI
# Visit your site in a browser and follow the installation wizard

# OR install via Drush (recommended for developers)
cd docroot
drush site:install openy \
  openy_configure_profile.preset=complete \
  openy_theme_select.theme=openy_carnation \
  openy_terms_of_use.agree_openy_terms=1 \
  install_configure_form.enable_update_status_emails=NULL \
  --account-name=admin \
  --site-name='YMCA Website Services' \
  --yes
```

### Installation Presets

The profile offers installation presets that determine which feature packages are enabled:

**Small Y** (Recommended - Default)
- **Status**: Standard and Small Y profiles are being merged into this unified installation
- Streamlined installation suitable for most YMCA organizations
- Includes: Alerts, Analytics, Editorial, Locations, Scheduler, Search, SEO, Translation, Webforms, Layout Builder
- Best for: Most YMCA websites, especially smaller to mid-size organizations
- This will become the primary installation option

**Standard**
- **Status**: Being phased out - merging with Small Y
- Legacy installation type maintained for backward compatibility
- Includes: Alerts, Editorial tools, News, SEO, Webforms, Layout Builder
- **Recommendation**: New installations should use Small Y instead

**Extended**
- For organizations requiring advanced features and complex integrations
- Adds: Analytics, Events, Locations, Membership, Translation, Search, Activity Finder, Home Branch
- Includes CRM integrations (GroupEx Pro, ActiveNet, Daxko)
- Best for: Large organizations with complex program management needs

**Complete** (Developers Only)
- **For development and testing purposes only**
- Full feature set with all packages and demo content
- Includes: ActiveNet, Daxko, GroupEx Pro, Programs, Camps, Blog, and every available package
- Only available via Drush installation (hidden from web UI)
- Best for: Development, testing, evaluation, and demonstrations
- **Not recommended for production sites**

Specify preset via Drush:
```bash
openy_configure_profile.preset=small_y     # Recommended for most sites
openy_configure_profile.preset=extended    # For complex usage
openy_configure_profile.preset=complete    # Developers only
```

> **Migration Note**: Sites currently using the Standard preset will continue to work. The Standard preset remains available for backward compatibility but is not recommended for new installations.

### Available Themes

- **openy_carnation** - The default theme for Y USA

Specify with: `openy_theme_select.theme=openy_carnation`

## Contributing & Development

### Working with a Fork

To contribute to YMCA Website Services, you'll work with a fork of this repository:

1. **Fork the repository** on GitHub: https://github.com/YCloudYUSA/yusaopeny

2. **Add your fork as a composer repository** in your project's `composer.json`:
   ```json
   "repositories": [
       {
           "type": "vcs",
           "url": "https://github.com/YOUR_USERNAME/yusaopeny"
       }
   ]
   ```

3. **Point to your development branch**. Branch names map to composer versions:
   - `bugfix` → `dev-bugfix`
   - `feature/my-feature` → `dev-feature/my-feature`
   - `main` → `dev-main`

   ```json
   "require": {
       "ycloudyusa/yusaopeny": "dev-YOUR-BRANCH-NAME"
   }
   ```

4. **Update dependencies**:
   ```bash
   composer update ycloudyusa/yusaopeny --with-dependencies
   ```

5. **Make your changes** in `docroot/profiles/contrib/yusaopeny/` (or `docroot/profiles/contrib/openy/`)

6. **Test your changes** thoroughly (see Testing section below)

7. **Submit a pull request** to the main repository

For detailed contribution guidelines, review:
- [Pull Request Standards](https://ds-docs.y.org/docs/development/open-y-pull-requests-review-standard/)
- [Code Review Best Practices](https://ds-docs.y.org/docs/development/code-review-quality-best-practices/)
- [Developer Documentation](https://ds-docs.y.org/docs/development/)

### Code Standards

This project follows Drupal coding standards. Before submitting code:

```bash
# Run code sniffers (from project root)
cd docroot
./runsniffers.sh

# Auto-fix code style issues
./runcodestyleautofix.sh
```

### Testing

For testing procedures, see [SMOKE_TESTS.md](SMOKE_TESTS.md) for manual testing or the [Smoke Tests Index](https://ds-docs.y.org/docs/development/open-y-smoke-tests-index/) for comprehensive testing guidelines.

## Key Features

The distribution is organized into **packages** - logical groupings of related functionality. Each installation preset enables different combinations of packages.

### Core Packages

- **Editorial** - Content components for building flexible pages (galleries, banners, grids, breadcrumbs)
- **[Layout Builder](https://ds-docs.y.org/docs/user-documentation/layout-builder/)** - Drupal's drag-and-drop page builder with 30+ custom components
- **Alerts** - Create and manage website [alerts](https://ds-docs.y.org/docs/user-documentation/content-types/alert/)
- **News** - [News posts](https://ds-docs.y.org/docs/user-documentation/content-types/news/) with listings, featured content, and taxonomy
- **Webforms** - Advanced form building with submission handling
- **SEO** - Metatags, sitemaps, and search engine optimization tools

### Location & Membership Packages

- **Locations** - [Branch](https://ds-docs.y.org/docs/user-documentation/content-types/branch/) and [facility](https://ds-docs.y.org/docs/user-documentation/content-types/facility/) management with hours, amenities, maps, and alerts
- **Membership** - [Membership](https://ds-docs.y.org/docs/user-documentation/content-types/membership/) content types and calculators
- **Camps** - [Camp](https://ds-docs.y.org/docs/user-documentation/content-types/camp/) management and location finder integration
- **Home Branch** - Personalized branch selection for users

### Program & Events Packages

- **Programs** - [Program](https://ds-docs.y.org/docs/user-documentation/content-types/program/) content types with [subcategories](https://ds-docs.y.org/docs/user-documentation/content-types/program-subcategory/)
- **Events** - [Event](https://ds-docs.y.org/docs/user-documentation/content-types/event/) management with listings and calendars
- **Blog** - [Blog posts](https://ds-docs.y.org/docs/user-documentation/content-types/blog/) with multiple listing types
- **Scheduler** - Schedule content publishing and unpublishing

### Integration Packages

- **ActiveNet** - ActiveNet CRM integration
- **Daxko** - Daxko program and membership integration
- **GroupEx Pro** - Group exercise class scheduling
- **Personify** - Personify CRM integration
- **Activity Finder** - Program search with registration integration

### Additional Packages

- **Analytics** - Google Analytics and Google Tag Manager integration
- **Search** - Solr or Google Custom Search integration
- **Translation** - Multilingual support
- **Social** - Social posts and feeds
- **Social Sharing** - AddThis social sharing integration
- **Theme Customization** - Color schemes and CSS editing

See `openy.packages.yml` for the complete list of packages and their modules, or browse the [Content Structure documentation](https://ds-docs.y.org/docs/content-structure/) for detailed information about each feature.

## Architecture

### Package-Based System

YMCA Website Services uses a **package-based architecture**:

1. **Packages** (`openy.packages.yml`) - Logical groupings of modules by functionality
   - Each package has: name, description, help text, and list of modules
   - Examples: `editorial`, `locations`, `blog`, `activity_finder`

2. **Installation Types** (`openy.installation_types.yml`) - Presets that combine packages
   - Each preset specifies which packages to install
   - `standard`, `extended`, `small_y`, `complete`

3. **Module Installation** - During installation:
   - User selects a preset (or specifies via Drush)
   - System loads packages for that preset
   - Installs all modules from those packages (with dependencies)
   - Optionally imports demo content for selected preset

### Directory Structure

| Path | Purpose |
|------|---------|
| `config/install/` | Default configuration installed with profile |
| `config/optional/` | Optional configuration for specific features |
| `src/` | Profile PHP classes (forms, services, plugins) |
| `src/Form/` | Installation wizard forms |
| `patches/` | Contrib module patches |
| `build/` | Testing and CI/CD configurations |
| `themes/` | Base theme definitions |
| `openy.packages.yml` | Package definitions |
| `openy.installation_types.yml` | Installation preset definitions |
| `openy.profile` | Installation tasks and hooks |
| `openy.install` | Install and update hooks |

### Custom Modules Location

Custom modules are **not** stored in this repository. They are managed as separate composer packages:
- `open-y-subprojects/*` - Core custom modules (openy_map, openy_focal_point, etc.)
- `ycloudyusa/*` - Y USA maintained packages (y_lb, yusaopeny_activity_finder, etc.)
- Installed to: `docroot/modules/contrib/`

See [CLAUDE.md](CLAUDE.md) for detailed development documentation.

## Resources

### Documentation

- **Main Documentation**: https://ds-docs.y.org
- **User Guides**: https://ds-docs.y.org/docs/user-documentation/
  - [Content Types](https://ds-docs.y.org/docs/user-documentation/content-types/)
  - [Layout Builder](https://ds-docs.y.org/docs/user-documentation/layout-builder/)
  - [Blocks](https://ds-docs.y.org/docs/user-documentation/blocks/)
- **Developer Documentation**: https://ds-docs.y.org/docs/development/
  - [Installation Guide](https://ds-docs.y.org/docs/development/installationwithdrush/)
  - [Pull Request Standards](https://ds-docs.y.org/docs/development/open-y-pull-requests-review-standard/)
  - [Code Review Best Practices](https://ds-docs.y.org/docs/development/code-review-quality-best-practices/)
  - [Smoke Tests](https://ds-docs.y.org/docs/development/open-y-smoke-tests-index/)
- **Content Structure**: https://ds-docs.y.org/docs/content-structure/

### Community & Support

- **Community**: https://ycloud.y.org/open-y-association-websites
- **Issue Queue**: https://github.com/YCloudYUSA/yusaopeny/issues
- **Changelog**: [GitHub Releases](https://github.com/YCloudYUSA/yusaopeny/releases)

## Support

YMCA Website Services is maintained by:
- Y-USA Digital Services
- ITCare
- ImageX
- Five Jars

For implementation support, training, and customization services, contact the [Y-USA Digital Services team](https://ycloud.y.org/open-y-association-websites).

## License

YMCA Website Services is licensed under the [GPL-2.0-or-later](LICENSE.txt). This is free and open-source software.

---

**Note**: This distribution was formerly known as "OpenY". References to "openy" in code and paths are maintained for backward compatibility.
