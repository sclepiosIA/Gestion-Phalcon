<?php
// Compat historique: /{APP}/api/...
$object->addPost('/'.APP.'/api/{model}/:action',[
    'controller' => 'api',
    'action'     => 2
]);

// Route simplifiée (migration Supabase -> /api/...)
$object->addPost('/api/{model}/:action',[
    'controller' => 'api',
    'action'     => 2
]);