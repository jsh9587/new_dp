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

}
