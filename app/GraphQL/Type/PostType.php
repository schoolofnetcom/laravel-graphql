<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PostType',
        'description' => 'Representa um post'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'O id do artigo'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'O título do artigo'
            ],
            'active' => [
                'type' => Type::boolean(),
                'description' => 'O status ativado/desativado do artigo'
            ],
        ];
    }
}