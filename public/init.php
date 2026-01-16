<?php

define('ENV', 'dev');

try {
    // PhalconTool "multi-app" bootstrap expects APP to point to an existing app folder.
    // Under the PHP built-in server + router, some setups end up setting APP to values
    // like "api/etablissements". If that folder doesn't exist, we fallback to "frontend".
    $app = defined('APP') ? (string) APP : 'frontend';

    $appDir = __DIR__ . '/../apps/' . $app;
    if (!is_dir($appDir)) {
        $app = 'frontend';
        $appDir = __DIR__ . '/../apps/' . $app;
    }

    /**
     * Read the configuration
     */
    $config = include $appDir . '/config/config.php';

    if ($config && isset($config->session_lifetime)) {
        ini_set('session.gc_maxlifetime', (string) $config->session_lifetime);
        ini_set('session.cookie_lifetime', (string) $config->session_lifetime);
        ini_set('session.gc_probability', '1');
        ini_set('session.gc_divisor', '1');
        ini_set('session.save_path', '/tmp');
    }

    /**
     * Read auto-loader
     */
    include $appDir . '/config/loader.php';

    /**
     * Read services
     */
    include $appDir . '/config/services.php';

    if (!isset($di)) {
        throw new \RuntimeException('DI container ($di) was not initialized by services.php');
    }

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();
} catch (\Throwable $e) {
    // Keep output plain for now (useful with curl); real logging can be added later.
    http_response_code(500);
    echo $e->getMessage();
}
