<?php

function missing_application_constant_handler($constant) {
    if ($constant === 'Application') {
        require_once __DIR__ . '/../Application.php';
    } else if (strpos($constant, 'Application') === 0) {
        $tokens = explode('\\', $constant);
        array_shift($tokens);
        require_once __DIR__ . '/../' . join('/', $tokens) . '.php';
    }
}

spl_autoload_register('missing_application_constant_handler');