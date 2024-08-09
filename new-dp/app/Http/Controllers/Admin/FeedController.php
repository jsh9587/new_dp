<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\Feed\FeedListService;
use App\Http\Requests\Admin\Feed\FeedStoreRequest;
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

    public function store(FeedStoreRequest $request)
    {
        $user = $request->user(); // Get the currently authenticated user

        $validatedData = $request->validated(); // Get validated data from the request

        // Add the user_id to the validated data
        $validatedData['user_id'] = $user->id;
        $validatedData['media_url'] = $request->media_url ?? ''; // Handle media_url with a fallback

        try {
            $feed = $this->feedListService->store($validatedData);
            return response()->json($feed, 201);
        } catch (\Exception $e) {
            // Log the error and return a 409 status code with an error message
            \Log::error('Feed creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Conflict'], 409);
        }
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
