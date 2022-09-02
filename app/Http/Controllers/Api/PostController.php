<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Repositories\PostRepository;

class PostController extends Controller
{

    public function __construct()
    {
        $this->postRepository = new PostRepository();
    }

    public function createPost(CreatePostRequest $request)
    {
        try {
            $data = $request->validated();
            $post = $this->postRepository->createPost(title: $data['title'], body: $data['body'], description: $data['description'], websiteId: $data['website_id']);
            return ApiResponse::created(message: __("You have successfully created a post"), data:$post);
        } catch (\Exception $e) {
            return ApiResponse::error(__FUNCTION__. ' failed',errors: [$e->getMessage()]);
        }
    }
}
