<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Feed\FeedListService;

class FeedController extends Controller
{
    //
    protected $feedListService;

    public function __construct(FeedListService $feedListService)
    {
        $this->feedListService = $feedListService;
    }

    public function getFeeds()
    {
        $feeds = $this->feedListService->getFeeds();
        return response()->json($feeds);
    }
}
