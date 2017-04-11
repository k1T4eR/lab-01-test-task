<?php

function missing_application_constant_handler($constant) {
    if ($constant === 'Application') {
        require_once __DIR__ . '/../Application.php';

    // Example constant: Application\Routing\Route
    } else if (strpos($constant, 'Application') === 0) {

        // Split by \: ['Application', 'Routing', 'Route']
        $tokens = explode('\\', $constant);

        // Get targeted class: 'Route'
        $target = array_pop($tokens); //

        // Downcase the rest: ['application', 'routing']. We are following downcase directory naming.
        // http://stackoverflow.com/questions/13431782/what-setting-causes-case-sensitive-require-once-paths
        $tokens = array_map(function($token) { return strtolower($token); }, $tokens);

        // Put targeted class back to tokens: ['application', 'routing', 'Route']
        array_push($tokens, $target);

        // join('/', $tokens) . '.php' => application/routing/Route.php
        require_once __DIR__ . '/../../' . join('/', $tokens) . '.php';
    }
}

spl_autoload_register('missing_application_constant_handler');