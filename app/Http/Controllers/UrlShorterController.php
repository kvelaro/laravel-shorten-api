<?php

namespace App\Http\Controllers;

use App\UrlModel;
use Illuminate\Http\Request;

class UrlShorterController extends Controller
{
    public function index($hash) {
        $urlModel = UrlModel::where('hash', '=', $hash)->first();
        if(!$urlModel) {
            return abort(404);
        }
        return redirect($urlModel->long_url);
    }
}
