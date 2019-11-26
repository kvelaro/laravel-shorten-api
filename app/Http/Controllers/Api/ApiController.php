<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponse;

class ApiController extends Controller
{
    use ValidatesRequests;
    use ApiResponse;
}
