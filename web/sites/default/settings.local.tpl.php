<?php

/**
 * Enable full error logging and display.
 */
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$config['system.logging']['error_level'] = 'verbose';
