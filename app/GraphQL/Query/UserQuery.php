<?php

namespace App\GraphQL\Query;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use GraphQL;
use App\GraphQL\Type\UserType;
use App\User;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'UserQuery',
        'description' => 'List of users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'O id do usuário no banco'
            ],
            'paginate' => [
                'type' => Type::int(),
                'description' => 'Quantidade de registros'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'Quantidade de registros'
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        if (isset($args['id'])) {
            return User::where('id', $args['id'])->get();
        }
        if (isset($args['paginate'])) {
            $page = 1;
            if (isset($args['page'])) {
                $page = $args['page'];
            }
            return User::paginate($args['paginate'], ['*'], 'page', $page);
        }
        return User::all();
    }
}