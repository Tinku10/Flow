<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ProfileMutator
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
    public function create($rootValue, array $args, GraphQLContext $context)
    {
        $article = new \App\Profile();
        $article->description = $args['description'];
        $article->website = $args['website'];
        $context->user()->profile()->save($article);

        return $article;
    }

    public function update($rootValue, array $args, GraphQLContext $context)
    {
        $context->user()->profile()->delete();
        // $profile = \App\Profile::find($context->user()->id);
        // $profile->delete();
        $article = new \App\Profile();
        $article->description = $args['description'];
        $article->website = $args['website'];
        $context->user()->profile()->save($article);

        return $article;
    }
}
