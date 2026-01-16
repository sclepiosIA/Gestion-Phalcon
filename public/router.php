<?php
// Router pour le serveur PHP built-in : simule le rewrite Apache (.htaccess)
// - sert les fichiers statiques si existants
// - sinon route vers /frontend/index.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// Laisser PHP servir les assets existants (css/js/img/fonts...)
if ($path !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

require __DIR__ . '/frontend/index.php';
