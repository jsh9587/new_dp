<?php

namespace App\Services\Feed;

use App\Models\Feed;
class FeedService
{
    // 서비스 로직을 여기에 작성합니다.
    public function getFeeds()
    {
        return Feed::all();
    }

    public function getFeed($id)
    {
        return Feed::findOrFail($id);
    }

    public function store($request)
    {
        $request->validate([
            'type' => 'required|string',
            'user_id' => 'required|integer',
            'title' => 'required|string',
            'slug' => 'required|string',
            'content' => 'required|string',
            'media_url' => 'nullable|string'
        ]);

        $feed = Feed::create($request->all());

        return response()->json($feed, 201);
    }
}
