<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeToWebsiteRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }


    public function subscribeToWebsite(SubscribeToWebsiteRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $this->userRepository->subscribe(username: $data['name'], userEmail: $data['email'], websiteId: $data['website_id']);
            return ApiResponse::success(message:__("You have successfully subscribed to the website"),data: $user);
        } catch (\Exception $e) {
            return ApiResponse::error(__FUNCTION__. ' failed',errors: [$e->getMessage()]);
        }
    }

}
