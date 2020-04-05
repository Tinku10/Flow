<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class LikeMutator
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function create($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
        $post = \App\Post::find($args['post_id']);
        $like = new \App\Like();
        $like->likes = $like->increment('likes');
        // $post->likes()->delete();
        $like->post_id = $args['post_id'];
        $like->liker_id = $context->user()->id;
        // $post->like()->delete();
        // $post->like()->post_id = $post->id;
        //trying a differnt approach
        // $post->like()->increment('likes');
        // $post->push();
        $like->save();
        // $post->likes()->save($like);

        return $post;
    }

    public function destroy($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
        // $post = \App\Post::find($args['post_id']);
        $liker_id = $context->user()->id;
        $like = \App\Like::where('liker_id', $liker_id);
        $like->delete();
        // $post->likes()->decrement('likes');
        // $post->push();

        return true;
    }
}
