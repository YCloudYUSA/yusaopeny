# Open Y Distribution Releases

## 11.1.0.0-beta3 (November 7, 2025)

### Overview
This beta release includes critical patch cleanup, dependency updates, demo content fixes, and updates to multiple Layout Builder components.

### Core Changes

#### PR #309: Remove failing patches that are fixed or merged
**Author:** podarok
**Merged:** November 7, 2025
**Related:** [ITCR-829](https://jet-dev.atlassian.net/browse/ITCR-829)

Removed 8 patches that fail to apply due to being fixed in newer versions, merged upstream, or closed as duplicates:
- **drupal/colorapi**: Both patches removed (merged/fixed)
- **drupal/media_library_form_element** #3341978: Merged
- **drupal/scheduler** #3446881: Fixed
- **drupal/inline_entity_form**: Remove MR #94 & #95 (keep #2581223)
- **drupal/responsive_favicons** #3376766: Fixed
- **drupal/redirect** #3373123: Fixed
- **drupal/editor_advanced_link** #3423208: Fixed
- **drupal/migrate_tools** #3534606: Fixed
- **drupal/search_api_solr** #3449292: Fixed
- **drupal/core**: Remove MR #8585 (keep other patches)

[View PR #309](https://github.com/YCloudYUSA/yusaopeny/pull/309)

#### PR #308: Update drupal/openy_gtranslate to 2.0.0
**Author:** svicervlad
**Merged:** November 7, 2025

Updated composer.json to require drupal/openy_gtranslate: ^2.0.0

**Changes:**
- Updated dependency constraint from ^1.0 to ^2.0.0
- Please test compatibility with openy_gtranslate 2.0.0 functionality

[View PR #308](https://github.com/YCloudYUSA/yusaopeny/pull/308)

#### PR #310: Fix Demo Content
**Author:** podarok
**Merged:** November 7, 2025
**Fixes:** [ITCR-863](https://jet-dev.atlassian.net/browse/ITCR-863)

**Problem:** Partners block "Our Partners" not displaying partner logos on demo Who We Are page.

**Solution:**
- Created `y_lb_demo_block_partners_tier` migration
- Updated `y_lb_demo_block_partners` to reference tiers

**Structure:**
```
lb_partners → field_partners → partners_tier → field_partners_items → lb_partner_item
```

**Testing:**
```bash
ddev drush mim y_lb_demo_block_partners_item,y_lb_demo_block_partners_tier,y_lb_demo_block_partners,y_lb_demo_page_who_we_are --update
```

Visit `/demo-who-we-are` - partner logos now display correctly.

[View PR #310](https://github.com/YCloudYUSA/yusaopeny/pull/310)

### Component Updates

#### Y Layout Builder (y_lb) - 3.10.8
**Released:** August 5, 2025

**Changes:**
- Fixed missing level-3 menu title on desktop

[View Release](https://github.com/YCloudYUSA/y_lb/releases/tag/3.10.8)

#### Open Y Custom (openy_custom) - 2.8.0
**Released:** August 19, 2025

**Changes:**
- Replace jquery.once & jquery.cookie in openy_custom

[View Release](https://github.com/open-y-subprojects/openy_custom/releases/tag/2.8.0)

#### Activity Finder - 5.4.0
**Released:** October 31, 2025

**Changes:**
- Replace deprecated package 'node-sass' with 'sass' package
- Modernizes build tooling by migrating from deprecated node-sass to actively maintained sass package

[View Release](https://github.com/YCloudYUSA/yusaopeny_activity_finder/releases/tag/5.4.0)

#### Activity Finder - 5.4.1
**Released:** October 31, 2025

**Bug Fix:** Fix double-counting issue where activities starting at exactly 5pm were incorrectly appearing in both "afternoon" (time_value 2) and "evening" (time_value 3) search results.

**Changes:**
- Fixed time comparison logic in `WeekdaysPartsOfDay` processor
- Activities starting at 5pm now correctly show only as "evening"

**Note:** Solr indexes should be rebuilt after applying this fix to reflect the changes.

**Credit:** YMCA Greater Dayton

[View Release](https://github.com/YCloudYUSA/yusaopeny_activity_finder/releases/tag/5.4.1)

### Drupal.org Module Updates

#### openy_mappings - 1.1.1
**Released:** July 23, 2025
**Type:** Bug Fix Release
**Compatibility:** Drupal 10 and 11

**Changes:**
- Resolved issue #3537349: Fixed error where code attempted to call `addMessage()` on a null value
- Ensures proper message handling functionality

[View Release](https://www.drupal.org/project/openy_mappings/releases/1.1.1)

#### lb_hero - 1.5.2
**Released:** October 15, 2025
**Compatibility:** Drupal 9, 10, and 11

**Changes:**
- Fixed issue #3551562: Render description field and update template

[View Release](https://www.drupal.org/project/lb_hero/releases/1.5.2)

#### lb_ping_pong - 1.2.14
**Released:** October 15, 2025
**Compatibility:** Drupal 9, 10, and 11

**Changes:**
- Fixed issue #3551553: Render description field and update template

[View Release](https://www.drupal.org/project/lb_ping_pong/releases/1.2.14)

#### lb_grid_cta - 3.1.3
**Released:** October 15, 2025
**Compatibility:** Drupal 9, 10, and 11

**Changes:**
- Fixed issue #3551566: Description field should be rendered
- Render description field and update template

[View Release](https://www.drupal.org/project/lb_grid_cta/releases/3.1.3)

#### lb_carousel - 2.1.1
**Released:** October 16, 2025
**Compatibility:** Drupal 9, 10, and 11

**Changes:**
- Fixed issue #3551912: Description field should be rendered
- Update template to render description field

[View Release](https://www.drupal.org/project/lb_carousel/releases/2.1.1)

#### lb_cards - 2.2.1
**Released:** October 16, 2025
**Compatibility:** Drupal 9, 10, and 11

**Changes:**
- Fixed issue #3551909: Description field rendering
- Updated template to properly render description field

[View Release](https://www.drupal.org/project/lb_cards/releases/2.2.1)

#### lb_theme_switcher - 1.1.0
**Released:** November 7, 2025
**Compatibility:** Drupal 10 and later

**Changes:**
- Feature issue #3554090: Adds automation capabilities
- Introduces "all" and "--dry-run" options
- Enables developers to apply modifications across multiple content types simultaneously
- Test changes without committing them to the system

[View Release](https://www.drupal.org/project/lb_theme_switcher/releases/1.1.0)

### Installation

```bash
composer require 'drupal/openy:11.1.0.0-beta3'
```

### Full Changelog
https://github.com/YCloudYUSA/yusaopeny/compare/11.1.0.0-beta2...11.1.0.0-beta3
