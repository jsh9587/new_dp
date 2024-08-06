<?php

namespace App\Services\Feed;

use App\Models\Feed;
use App\Services\Feed\FeedService;

class FeedListService extends FeedService
{
    // 서비스 로직을 여기에 작성합니다.

    public function getFilteredFeeds($criteria)
    {
        // 특정 기준에 따라 피드를 필터링합니다.
        return Feed::where('title', 'like', "%{$criteria}%")->get();
    }

}
