<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/health-check' => [[['_route' => 'health-check_get', '_controller' => 'App\\ShoppingList\\Backend\\Controller\\HealthCheckGetController'], null, ['GET' => 0], null, false, false, null]],
        '/usuario/particular' => [
            [['_route' => 'usuario_particular_get', '_controller' => 'App\\ShoppingList\\Backend\\Controller\\Usuario\\UsuarioParticularGetController'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'usuario_particular_post', '_controller' => 'App\\ShoppingList\\Backend\\Controller\\Usuario\\UsuarioParticularPostController'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/usuario/particular/([^/]++)(*:35)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => 'usuario_particular_put', '_controller' => 'App\\ShoppingList\\Backend\\Controller\\Usuario\\UsuarioParticularPutController'], ['id'], ['PUT' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
