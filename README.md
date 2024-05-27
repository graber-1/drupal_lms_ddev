# DDEV based Local development stack

## Setting up

1. Install DDEV if not already done: https://ddev.readthedocs.io/en/stable/#installation
2. `ddev start`
3. If needed, change Drupal version in composer.json
4. `ddev composer install`
5. `ddev composer si`


## Running automated tests

1. `ddev ssh`
2. `mkdir web/sites/default/files/simpletest/browser_output` (if not already done)
3. `phpunit path/to/tests`


## Code analysis tools

To check all, run `ddev analyse-code path/to/analyzed/folder`.
For single tool analysis of the LMS module execute:
1. phpcs: `ddev composer phpcs`
2. phpcbf: `ddev composer phpcbf`
3. phpstan: `ddev composer phpstan`


## Local development

1. `cd web/modules/contrib/lms`
2. `git remote add your-fork-name your-fork-ssh`
3. Checkout issue branch, make changes, push to your fork,
   create a merge request.


## PHPMyAdmin

Accessible from http://ddev-demo.ddev.site:8036/
