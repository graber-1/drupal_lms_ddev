# DDEV based Local development stack

## Setting up

1. Clone this repo, enter the folder.
2. Install DDEV if not already done: https://ddev.readthedocs.io/en/stable/#installation
3. `ddev start`
4. If needed, change Drupal version in composer.json
5. `ddev composer install`
6. `ddev composer update drupal/lms`
7. `ddev composer si`


## Running automated tests

1. `ddev ssh`
2. `mkdir web/sites/default/files/simpletest/browser_output`
   (if not already done)
3. `phpunit path/to/tests`


## Code analysis tools

To check all, run `ddev analyse-code path/to/analyzed/folder`.
For single tool analysis of the LMS module execute:
1. phpcs: `ddev composer phpcs`
2. phpcbf: `ddev composer phpcbf`
3. phpstan: `ddev composer phpstan`


## Local development & QA

1. `cd web/modules/contrib/lms`
2. `git remote add your-fork-name your-fork-ssh`
3. `git pull`
4. Checkout issue branch, make changes, push to your fork,
   create a merge request.

To create a site with test content already created, run:
`ddev composer sid`


## PHPMyAdmin

Accessible from http://ddev-demo.ddev.site:8036/
