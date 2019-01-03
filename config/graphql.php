<?php

use App\GraphQL\Query\UserQuery;
use App\GraphQL\Query\PostQuery;
use App\GraphQL\Query\UserPaginateQuery;
use App\GraphQL\Type\UserType;
use App\GraphQL\Type\PostType;
use App\GraphQL\Mutation\CreatePostMutation;

return [

    'prefix' => 'graphql',
    'routes' => '{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',

    'middleware' => [],

    'route_group_attributes' => [],
    'default_schema' => 'default',

    'schemas' => [
        'default' => [
            'query' => [
                'users' => UserQuery::class,
                'users_paginated' => UserPaginateQuery::class,
                'posts' => PostQuery::class
            ],
            'mutation' => [
                'createPost' => CreatePostMutation::class
            ],
            'method' => ['get', 'post']
        ]
    ],

    'types' => [
        'user' => UserType::class,
        'post' => PostType::class,
    ],

    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    'params_key'    => 'variables',

    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false
    ],

    'custom_paginators' => [
    ],

    'graphiql' => [
        'prefix' => '/graphiql/{graphql_schema?}',
        'controller' => \Rebing\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],
];
