<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{

    /**
     * @param string $title
     * @param string $body
     * @param string $description
     * @param string $website_id
     * @return mixed
     */
    public function createPost(string $title, string $body, string $description, int $websiteId) : Post
    {
        return Post::create([
            'title' => $title,
            'body' => $body,
            'description' => $description,
            'website_id' => $websiteId,
        ]);
    }
}
