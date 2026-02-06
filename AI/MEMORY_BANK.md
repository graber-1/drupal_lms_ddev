# Drupal LMS Development - Memory Bank

**Last Updated:** February 6, 2026  
**Project Focus:** Custom Module Development & Drupal LMS Development

---

## 1. PROJECT OVERVIEW

This is a Drupal 11-based Learning Management System (LMS) project using DDEV for local development. The project emphasizes custom module development to extend and customize the LMS functionality.

**Project Repository:** git@github.com:graber-1/drupal_lms_ddev.git  
**Current Working Directory:** `/Users/graber/Environments/lms`

### Key Characteristics
- **Drupal Version:** 11.x
- **PHP Version:** Compatible with Drupal 11 requirements
- **Development Environment:** DDEV
- **Code Quality:** Enforced through PHPStan, PHPCS, and PHPUnit

---

## 2. TECHNOLOGY STACK

### Core Framework
- **Drupal Core:** 11.x
- **PHP:** 8.1+ (Drupal 11 requirement)
- **Database:** MySQL/MariaDB (via DDEV)
- **Web Server:** Apache/Nginx (via DDEV)

### Development Tools
- **DDEV:** Local development environment
- **Composer:** Dependency management
- **Drush:** Drupal CLI tool (v13.3+)
- **Git:** Version control

### Code Quality & Testing
- **PHPStan:** Static analysis with strict rules
- **PHPCS (PHP_CodeSniffer):** Code style checking (Drupal coding standards)
- **PHPUnit:** Unit and functional testing (v9 or v10.5)
- **PHPCBF:** Auto-formatting

### Key Drupal Contributed Modules
- **admin_toolbar (^3.4):** Enhanced admin interface
- **group:** Group-based content and user management
- **message / message_notifications:** Notification system
- **token (^1.15):** Token replacement
- **views_bulk_operations (^4.3):** Bulk operations
- **webform:** Form builder
- **h5p:** Interactive content

---

## 3. CUSTOM MODULES

### Component Variants Module
**Location:** `web/modules/custom/component_variants`

A custom module that extends Drupal's component system to support variants.

#### Structure
```
component_variants/
├── component_variants.info.yml
├── component_variants.routing.yml
├── component_variants.services.yml
├── components/
│   └── teaser_test_variant/
│       ├── teaser_test_variant.component_variant.yml
│       └── teaser_test_variant.twig
└── src/
    ├── ComponentVariantDirectoryDiscovery.php
    ├── ComponentVariantDirectoryPluginDiscovery.php
    ├── ComponentVariantLoader.php
    ├── ComponentVariantPluginManager.php
    ├── Controller/
    │   └── TestController.php
    ├── Entity/
    │   └── ComponentVariant.php
    ├── Exception/
    │   ├── InvalidComponentVariantException.php
    │   └── VariantLoaderException.php
    ├── Hook/
    │   └── ComponentVariantsHooks.php
    ├── Plugin/
    │   └── ComponentVariantPlugin.php
    └── Render/
        └── ComponentVariantRenderCallback.php
```

#### Key Features
- **Plugin System:** Uses Drupal's plugin architecture
- **Component Discovery:** Custom discovery mechanisms for variants
- **Twig Integration:** Renders variants through Twig templates
- **Loader Pattern:** Dedicated loader for component variants

---

## 4. LMS MODULE STRUCTURE

### Main LMS Module
**Location:** `web/modules/contrib/lms`

The core LMS functionality provided by the community module.

#### Core Services & Managers
- **ActivityAnswerManager.php:** Manages activity answers
- **BlockBuilder.php:** Builds LMS-specific blocks
- **DataIntegrityChecker.php:** Ensures data consistency
- **LmsBreadcrumbBuilder.php:** Custom breadcrumb generation
- **LmsContentImporter.php:** Content import functionality
- **ModalSubformManager.php:** Modal form handling
- **TrainingManager.php:** Training/course management

#### Key Directories
- **Entity/:** Custom entity definitions (Activities, Answers, Lessons, etc.)
- **Plugin/:** Plugin implementations
- **Form/:** Form builders
- **Controller/:** Page controllers
- **Event/:** Event subscribers and dispatchers
- **Hook/:** Drupal 11 hook implementations (OOP hooks)
- **Drush/:** Drush commands

### LMS Extension Modules
All located in `web/modules/contrib/`:

1. **lms_file_upload (^1.0):** File upload activity type
2. **lms_h5p (^1.0@alpha):** H5P integration for interactive content
3. **lms_membership_request (1.1.x-dev):** Course membership requests
4. **lms_messages (1.0.x-dev):** LMS-specific messaging
5. **lms_webform (^1.0@beta):** Webform integration
6. **lms_xapi (dev-1.0.x):** xAPI/TinCan support

---

## 5. ENTITY TYPES IN LMS

Based on configuration files, the following custom entity types exist:

### LMS Activity
**Machine Name:** `lms_activity`

Activity types (bundles):
- `file_upload` - File submission activities
- `free_text` - Text-based responses
- `free_text_feedback` - Text responses with feedback
- `no_answer` - Information-only activities
- `select_multiple` - Multiple choice (multiple answers)
- `select_multiple_feedback` - Multiple choice with feedback
- `select_single` - Single choice questions
- `select_single_feedback` - Single choice with feedback
- `true_false` - True/False questions
- `true_false_feedback` - True/False with feedback
- `webform` - Webform-based activities
- `xapi_tincan` - xAPI activities

### LMS Answer
**Machine Name:** `lms_answer`

Stores student responses to activities.

### LMS Lesson
**Machine Name:** `lms_lesson`

Represents individual lessons within courses.

### LMS Course Status
**Machine Name:** `lms_course_status`

Tracks student progress through courses.

### LMS Lesson Status
**Machine Name:** `lms_lesson_status`

Tracks completion status of individual lessons.

### Group Types
- **lms_course:** Course groups
- **lms_class:** Class groups (subgroups of courses)

### Comment Type
- **lms_answer_comment:** Comments on student answers

### Message Types
Used for notifications:
- `lms_messages_answer_comment`
- `lms_messages_approved_request`
- `lms_messages_course_evaluated`
- `lms_messages_course_evaluation`
- `lms_messages_new_request`
- `lms_messages_rejected_request`

---

## 6. DEVELOPMENT WORKFLOW

### Initial Setup
```bash
# 1. Clone repository
git clone git@github.com:graber-1/drupal_lms_ddev.git
cd drupal_lms_ddev

# 2. Start DDEV
ddev start

# 3. Install dependencies
ddev composer install

# 4. Install Drupal site
ddev composer si    # Basic install
ddev composer sid   # Install with demo content + developer console
```

### Working on LMS Modules
```bash
# Navigate to LMS module
cd web/modules/contrib/lms

# Add your fork
git remote add your-fork-name your-fork-ssh

# Create/checkout feature branch
git checkout -b feature/issue-123-description

# Make changes, then run quality checks before committing
```

### Creating Test Environment
```bash
ddev composer test-environment
```

This creates:
- Minimal Drupal installation
- Claro admin theme enabled
- LMS core modules enabled
- Test content via `drush lms-ctt --simple-passwords`

---

## 7. CODE QUALITY & TESTING

### Running Tests
```bash
# Inside DDEV container
ddev ssh

# Create browser output directory (first time only)
mkdir -p web/sites/default/files/simpletest/browser_output

# Run tests for a module
composer test [module_name]
# Example: composer test lms
```

### Static Analysis (PHPStan)
```bash
# Run PHPStan
composer phpstan [module_name]

# Generate baseline (to track existing issues)
composer phpstan-baseline [module_name]
```

### Code Style (PHPCS)
```bash
# Check coding standards
composer phpcs [module_name]

# Auto-fix coding standards
composer phpcbf [module_name]
```

### Configuration Files
- **phpcs.xml:** PHP CodeSniffer configuration
- **phpstan.neon:** PHPStan configuration
- **phpunit.xml:** PHPUnit configuration
- **phpstan-baseline.neon:** PHPStan baseline (existing issues)

---

## 8. CUSTOM MODULE DEVELOPMENT GUIDELINES

### Module Structure (Drupal 11 Standards)

```
your_module/
├── your_module.info.yml        # Module metadata
├── your_module.module          # Legacy hooks (if needed)
├── your_module.oop-hooks.php   # OOP hooks (Drupal 11+)
├── your_module.services.yml    # Service definitions
├── your_module.routing.yml     # Route definitions
├── your_module.permissions.yml # Permissions
├── your_module.libraries.yml   # JS/CSS libraries
├── composer.json               # Composer metadata
├── phpcs.xml                   # Coding standards config
├── phpstan.neon                # Static analysis config
├── README.md                   # Documentation
├── config/                     # Configuration schemas
│   ├── schema/
│   └── install/
├── src/                        # PHP classes
│   ├── Entity/                 # Entity definitions
│   ├── Plugin/                 # Plugin implementations
│   ├── Form/                   # Form classes
│   ├── Controller/             # Page controllers
│   ├── Hook/                   # OOP hook implementations
│   ├── EventSubscriber/        # Event subscribers
│   └── Service/                # Custom services
├── templates/                  # Twig templates
├── components/                 # SDC components (Drupal 10+)
└── tests/                      # PHPUnit tests
    ├── src/
    │   ├── Unit/
    │   ├── Kernel/
    │   └── Functional/
```

### Drupal 11 OOP Hooks Pattern

**File:** `your_module.oop-hooks.php`

```php
<?php

declare(strict_types=1);

use Drupal\Core\Hook\Attribute\Hook;

/**
 * Implements hook_theme().
 */
#[Hook('theme')]
function your_module_theme(): array {
  return [
    'your_template' => [
      'variables' => ['data' => NULL],
    ],
  ];
}
```

**File:** `src/Hook/YourModuleHooks.php`

```php
<?php

declare(strict_types=1);

namespace Drupal\your_module\Hook;

use Drupal\Core\Hook\Attribute\Hook;

/**
 * Hook implementations for your_module.
 */
class YourModuleHooks {

  #[Hook('entity_type_alter')]
  public function entityTypeAlter(array &$entity_types): void {
    // Implementation
  }

}
```

### Service Definition Pattern

**File:** `your_module.services.yml`

```yaml
services:
  your_module.manager:
    class: Drupal\your_module\YourManager
    arguments:
      - '@entity_type.manager'
      - '@current_user'
      - '@logger.factory'
```

### Plugin System Pattern

```php
<?php

namespace Drupal\your_module\Plugin\PluginType;

use Drupal\Core\Plugin\PluginBase;
use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Base class for Your Plugin plugins.
 */
abstract class YourPluginBase extends PluginBase implements YourPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function label(): string {
    return $this->pluginDefinition['label'];
  }

}
```

### Best Practices

1. **Type Declarations:** Always use strict types (`declare(strict_types=1);`)
2. **Dependency Injection:** Use constructor injection for services
3. **Interfaces:** Define interfaces for all plugins and services
4. **Documentation:** Use PHPDoc blocks for all classes and methods
5. **Testing:** Write unit and functional tests for custom code
6. **Code Standards:** Follow Drupal coding standards (verified by PHPCS)
7. **Static Analysis:** Ensure code passes PHPStan checks
8. **Configuration Management:** Export all configuration to YAML
9. **OOP Hooks:** Prefer OOP hooks over procedural hooks in Drupal 11
10. **Components:** Use Single Directory Components (SDC) for reusable UI

---

## 9. COMMON DEVELOPMENT TASKS

### Creating a Custom Entity Type

1. Define entity class in `src/Entity/YourEntity.php`
2. Create entity annotation with `@ContentEntityType`
3. Define base fields in `baseFieldDefinitions()`
4. Create entity forms in `src/Form/`
5. Export configuration

### Adding a Plugin Type

1. Create plugin interface in `src/Plugin/YourPluginInterface.php`
2. Create plugin base class in `src/Plugin/YourPluginBase.php`
3. Create plugin manager in `src/YourPluginManager.php`
4. Register manager as service
5. Create plugin instances in `src/Plugin/YourPlugin/`

### Implementing a Service

1. Create service class in `src/`
2. Implement constructor with dependencies
3. Define in `your_module.services.yml`
4. Inject into controllers/forms as needed

### Adding Routes

**File:** `your_module.routing.yml`

```yaml
your_module.example:
  path: '/example/{param}'
  defaults:
    _controller: '\Drupal\your_module\Controller\ExampleController::content'
    _title: 'Example Page'
  requirements:
    _permission: 'access content'
    param: '\d+'
```

### Working with Groups (LMS Context)

The LMS uses the Group module extensively:
- Courses are groups of type `lms_course`
- Classes are groups of type `lms_class`
- Content is added to groups via group relationships
- Permissions are managed through group roles

---

## 10. IMPORTANT FILES & LOCATIONS

### Configuration
- **Config Sync:** `config/sync/` - Exported configuration
- **Patches:** `composer.patches.json` - Applied patches
- **Patches Directory:** `patches/` - Custom patch files

### Custom Code
- **Custom Modules:** `web/modules/custom/`
- **Custom Themes:** `web/themes/custom/`
- **Custom Profiles:** `web/profiles/custom/`

### Contributed Code
- **Contrib Modules:** `web/modules/contrib/`
- **Contrib Themes:** `web/themes/contrib/`
- **Drupal Core:** `web/core/`

### Development
- **Composer:** `composer.json`, `composer.lock`
- **DDEV Config:** `.ddev/` (if exists)
- **Git:** `.gitignore`

---

## 11. KEY CONCEPTS & PATTERNS

### LMS Activity System
- Activities are fieldable content entities
- Each activity type (bundle) has different field configurations
- Activity plugins handle answer validation and scoring
- Activity answers are stored as separate entities linked to activities

### LMS Course Structure
```
Course (Group)
├── Classes (Subgroups)
│   └── Students (Members)
├── Lessons (Content)
│   └── Activities (Referenced)
└── Course Materials (Group Content)
```

### User Roles in LMS Context
- **Site Admin:** Full access
- **Course Author:** Can create/edit courses
- **Instructor:** Can manage course content and students
- **Student:** Can access enrolled courses and complete activities

### Message & Notification System
- Messages are entities created for events
- Message templates define the structure
- Message Notify handles delivery (email, etc.)
- Display modes: `mail_subject`, `mail_body`, `default`

---

## 12. TROUBLESHOOTING & TIPS

### Clear Caches
```bash
ddev drush cr
```

### Rebuild Permissions
```bash
ddev drush php-eval "node_access_rebuild();"
```

### Export Configuration
```bash
ddev drush cex -y
```

### Import Configuration
```bash
ddev drush cim -y
```

### Check Module Status
```bash
ddev drush pm:list
```

### View Logs
```bash
ddev drush watchdog:show
```

### Database Updates
```bash
ddev drush updatedb
```

---

## 13. RESOURCES & DOCUMENTATION

### Drupal.org Documentation
- [Drupal 11 API](https://api.drupal.org/api/drupal/11.x)
- [Drupal Coding Standards](https://www.drupal.org/docs/develop/standards)
- [Entity API](https://www.drupal.org/docs/drupal-apis/entity-api)
- [Plugin API](https://www.drupal.org/docs/drupal-apis/plugin-api)

### Module-Specific
- [Group Module](https://www.drupal.org/docs/contributed-modules/group)
- [Message/Notify](https://www.drupal.org/project/message)
- [Single Directory Components](https://www.drupal.org/docs/develop/theming-drupal/using-single-directory-components)

### Development Tools
- [DDEV Documentation](https://ddev.readthedocs.io/)
- [Drush Documentation](https://www.drush.org/)
- [PHPStan Drupal Extension](https://github.com/mglaman/phpstan-drupal)

---

## 14. PROJECT-SPECIFIC NOTES

### Component Variants Module (Active Development)
Currently working on extending Drupal's component system to support variants. This module provides:
- Custom plugin discovery for component variants
- Loader pattern for variant management
- Integration with Drupal's render system
- Twig template support for variant rendering

### Development Focus Areas
1. **Custom Module Architecture:** Building reusable, maintainable custom modules
2. **LMS Extensions:** Extending core LMS functionality
3. **Plugin Systems:** Implementing flexible plugin architectures
4. **Component Systems:** Working with Single Directory Components
5. **Code Quality:** Maintaining high standards through automated tools

### Current Open Tabs Context
Working with component variant system:
- `ComponentVariantPlugin.php` - Base plugin class
- `ComponentVariantLoader.php` - Loader service
- `ComponentVariantPluginManager.php` - Plugin manager
- `ComponentVariantDirectoryDiscovery.php` - Discovery mechanism
- Twig template and YAML configuration files

---

## 15. NEXT STEPS & TODO

When working on this project:

1. **Before Starting Work:**
   - Review relevant entity/plugin documentation
   - Check existing similar implementations in LMS
   - Review code quality requirements

2. **During Development:**
   - Follow Drupal 11 OOP hooks pattern
   - Write tests alongside code
   - Run PHPCS/PHPStan regularly
   - Document complex logic

3. **Before Committing:**
   - Run full test suite
   - Check code standards
   - Export configuration if changed
   - Update relevant documentation

4. **For Custom Modules:**
   - Consider contrib module patterns
   - Plan for extensibility
   - Document API usage
   - Provide examples

---

**Memory Bank Initialized:** ✓  
**Focus Areas Documented:** Custom Module Development, Drupal LMS Development  
**Last Review:** February 6, 2026