<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrlRequest;
use App\UrlModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlShorterController extends ApiController
{
    public function index(Request $request) {
        $limit = (int) $request->get('limit', 100);
        $offset = (int) $request->get('offset', 0);
        DB::table('url')->limit = $limit;
        DB::table('url')->offset = $offset;
        $urls = UrlModel::get();
        return $this->sendResponse(200, 'success', $urls);
    }

    public function view($entityId, Request $request) {
        $urlModel = UrlModel::find($entityId);
        if(!$urlModel) {
            return $this->sendError(404, 'Not Found', []);
        }
        return $this->sendResponse(200, 'success', $urlModel->attributesToArray());
    }

    public function create(UrlRequest $request) {
        $request->validated();
        $incoming = $request->json();
        $urlModel = new UrlModel();
        $urls = $this->generateUrls($incoming->get('long_url'));
        $urlModel->short_url = $urls['shortUrl'];
        $urlModel->long_url = $urls['longUrl'];
        $urlModel->hash = $urls['hash'];
        $urlModel->save();
        return $this->sendResponse(201, 'Created', $urlModel->attributesToArray());
    }

    public function update($entityId, UrlRequest $request) {
        $request->validated();
        $incoming = $request->json();
        $urlModel = UrlModel::find($entityId);
        if(!$urlModel) {
            return $this->sendError(404, 'Not Found', []);
        }
        $urls = $this->generateUrls($incoming->get('long_url'));
        $urlModel->short_url = $urls['shortUrl'];
        $urlModel->long_url = $urls['longUrl'];
        $urlModel->hash = $urls['hash'];
        $urlModel->save();
        return $this->sendResponse(200, 'Updated', $urlModel->attributesToArray());
    }

    public function delete($entityId) {
        $urlModel = UrlModel::find($entityId);
        if(!$urlModel) {
            return $this->sendError(404, 'Not Found', []);
        }
        $urlModel->delete();
        return $this->sendResponse(200, 'Deleted', []);
    }

    private function generateUrls($longUrl) {
        $hash = substr(md5(config('app.key') . $longUrl), 0, config('local.hash_length'));
        return [
            'hash' => $hash,
            'shortUrl' => config('app.url') . '/r/' . $hash,
            'longUrl' => config('app.url') . '/' . $longUrl
        ];
    }
}
