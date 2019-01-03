<?php

namespace App\GraphQL\Query;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use GraphQL;
use App\GraphQL\Type\UserType;
use App\User;

class UserPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'UserPaginateQuery',
        'description' => 'Paginated list of users'
    ];

    public function type()
    {
        return GraphQL::paginate('user');
    }

    public function args()
    {
        return [
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
        $paginate = 15;
        if (isset($args['paginate'])) {
            $paginate = $args['paginate'];
        }
        
        $page = 1;
        if (isset($args['page'])) {
            $page = $args['page'];
        }

        $with = $fields->getRelations();
        
        return  User::with($with)->paginate($paginate, ['*'], 'page', $page);
    }
}