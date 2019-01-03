<?php

namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Post;
use GraphQL;

class CreatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreatePostMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('post');
    }

    public function args()
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean()),
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $post = Post::create([
            'title' => $args['title'],
            'active' => $args['active'],
            'user_id' => $args['user_id'],
        ]);

        return $post;
    }
}