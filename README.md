# DDEV based Local development stack

## AI Documentation

This project includes an **AI folder** (`AI/`) containing documentation for AI assistants:
- **AI/MEMORY_BANK.md** - Comprehensive project documentation including architecture, patterns, and guidelines
- **AI/README.md** - Guide for using and maintaining AI documentation

AI assistants should read `AI/MEMORY_BANK.md` at the start of each task for project context.

## Setting up

1. Clone this repo, enter the folder.
2. Install DDEV if not already done: https://ddev.readthedocs.io/en/stable/#installation
3. `ddev start`
4. If needed, change Drupal version in composer.json
5. `ddev composer install`
6. `ddev composer update drupal/lms`
7. `ddev composer si`


## Local development & QA

1. `cd web/modules/contrib/lms`
2. `git remote add your-fork-name your-fork-ssh`
3. `git pull`
4. Checkout issue branch, make changes, push to your fork,
   create a merge request.

To create a site with test content already created, run:
`ddev composer sid`

To create a site with the initial state of functional JS tests, run:
`ddev composer test-environment`


## Running automated tests and code analysis tools for modules

1. `ddev ssh`
2. `mkdir web/sites/default/files/simpletest/browser_output`
   (if not already done)
3. `composer test [module_name]` (the module folder must be in 
   web/modules/contrib)
4. `composer phpstan [module_name]` (the module folder must be in 
   web/modules/contrib)
5. `composer phpcs [module_name]` (the module folder must be in 
   web/modules/contrib)
