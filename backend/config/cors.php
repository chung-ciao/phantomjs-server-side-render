<?php
    return [
         /*
         |--------------------------------------------------------------------------
         | Laravel CORS
         |--------------------------------------------------------------------------
         |

         | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
         | to accept any value.
         |
         */
        'supportsCredentials' => false,
        'allowedOrigins' => array_filter(explode(',', env('CORS'))),
        'allowedHeaders' => ['*'], // ex : ['Content-Type', 'Accept']
        'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
        'exposedHeaders' => [],
        'maxAge' => 0,
        'hosts' => [],
    ]
?>