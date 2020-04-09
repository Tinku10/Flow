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

        $liker_id = $context->user()->id;
        $post_id = $args['post_id'];

        $likeTest = \App\Like::where(['liker_id' => $liker_id, 'post_id' => $post_id]);

        $likeNewUser = \App\Like::where(['post_id' => $post_id]);

        if($likeTest->exists()){
            $likeTest->delete();
        }elseif($likeNewUser->exists()){
            $like = new \App\Like();
            $like->liker_id = $liker_id;
            $like->post_id = $post_id;
            $like->likes = $likeNewUser->orderBy('created_at', 'DESC')->first()->likes + 1;
            $like->save();
        }
        else{
            $like = new \App\Like();
            $like->likes = 1;
            // $post->likes()->delete();
            $like->post_id = $post_id;
            $like->liker_id = $liker_id;
            // $post->like()->delete();
            // $post->like()->post_id = $post->id;
            //trying a differnt approach
            // $post->like()->increment('likes');
            // $post->push();
            $like->save();
            // $post->likes()->save($like);
        }


        return $post->likes()->orderBy('created_at', "DESC")->first()->likes;
    }

    public function destroy($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
        // $post = \App\Post::find($args['post_id']);
        //don't use get() with where if deleting, it does'nt work
        $liker_id = $context->user()->id;
        $post_id = $args['post_id'];
        $like = \App\Like::where(['liker_id' => $liker_id, 'post_id' => $post_id]);
        $like->delete();
        // $post->likes()->decrement('likes');
        // $post->push();

        return true;
    }
}
