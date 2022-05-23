# DDEV based Local development stack

## Setting up

1. Install DDEV if not already done: https://ddev.readthedocs.io/en/stable/#installation
2. `ddev start`
3. `ddev composer install`
4. `ddev drush si`


## Running automated tests

1. `ddev ssh`
2. `mkdir web/sites/default/files/simpletest/browser_output` (if not already done)
3. `phpunit path/to/tests`

Chromedriver weights additional half a Gb so to be able to run
FunctionalJavaScript tests, do the following:
1. `cp .ddev/docker-compose.chrome.environment.yaml.tpl docker-compose.chrome.environment.yaml`
2. `ddev restart`


## Code analysis tools

To check all, run `ddev analyse-code path/to/analyzed/folder`.
For single tool analysis (after `ddev ssh`):
1. phpcs: `phpcs path/to/analyzed/folder`
2. phpcbf: `phpcbf path/to/analyzed/folder`
3. phpstan: `phpstan analyse -- path/to/analyzed/folder`


## PHPMyAdmin

Accessible from http://ddev-demo.ddev.site:8036/
