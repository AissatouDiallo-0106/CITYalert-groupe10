<?php
declare(strict_types=1);

/**
 * Autoloader PSR-4 maison : préfixe "App\" -> dossier app/.
 */
spl_autoload_register(static function (string $class): void {
    $prefix  = 'App\\';
    $baseDir = __DIR__ . '/';
    if (!str_starts_with($class, $prefix)) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) {
        require $file;
    }
});