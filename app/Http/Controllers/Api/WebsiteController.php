<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Repositories\WebsiteRepository;

class WebsiteController extends Controller
{

    public function index()
    {
        try {
            return ApiResponse::success(message: __("Data fetched"), data: Website::all());
        } catch (\Exception $e) {
            return ApiResponse::error(__FUNCTION__. ' failed',errors: [$e->getMessage()]);
        }
    }
}
