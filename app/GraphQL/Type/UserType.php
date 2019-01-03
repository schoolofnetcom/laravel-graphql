<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use App\User;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserType',
        'description' => 'A type for Users',
        'model' => User::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'O id do usuário no banco'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'O nome do usuário no banco'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'O email do usuário no banco'
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('post')),
                'description' => 'Lista de artigos por usuário',
                'query' => function (array $args, $query) {
                    return $query->where('posts.active', true);
                }
            ]
        ];
    }
}