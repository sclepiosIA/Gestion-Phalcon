<?php
    // Compat historique: /{APP}/scrud/...
    $object->add('/'.APP.'/scrud/',[
        'controller' => 'scrud',
        'action'     => 'index'
    ]);
    // Route simplifiée: /scrud/...
    $object->add('/scrud/',[
        'controller' => 'scrud',
        'action'     => 'index'
    ]);
    $object->add('/'.APP.'/scrud/{model}/:action',[
        'controller' => 'scrud',
        'action'     => 2
    ]);
    $object->add('/scrud/{model}/:action',[
        'controller' => 'scrud',
        'action'     => 2
    ]);
    $object->add('/'.APP.'/scrud/{model}/', [
        'controller' => 'scrud',
        'action'     => 'search'
    ]);
    $object->add('/scrud/{model}/', [
        'controller' => 'scrud',
        'action'     => 'search'
    ]);
    $object->add('/'.APP.'/custom_scrud/{model}/:action',[
        'controller' => 'custom_scrud',
        'action'     => 2
    ]);
    $object->add('/'.APP.'/custom_scrud/{model}/', [
        'controller' => 'custom_scrud',
        'action'     => 'search'
    ]);