<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    public function getFeed($id)
    {
        $feed = $this->feedListService->getFeed($id);
        return response()->json($feed);
    }

    public function store(Request $request)
    {
        $feed = $this->feedListService->store($request);
        return response()->json($feed);
    }

    public function lastFetchFeed()
    {
        $feed = $this->feedListService->getLastFetchFeed();
        Log::info('Feed Response:', [
            'created_at' => $feed->created_at,
            'updated_at' => $feed->updated_at,
        ]);
        return response()->json($feed);
    }
}
