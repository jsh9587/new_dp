<?php

namespace App\Services\Feed;
use App\Models\Feed;
class RssService
{
    // 서비스 로직을 여기에 작성합니다.

    public function getRssFeed($url)
    {
        $feeds = [];

        $rss = simplexml_load_file($url);
        if($rss){
            foreach ($rss->channel->item as $item) {
                $feeds[] = [
                    'user_id'=>53,
                    'title' => (string) $item->title,
                    'slug'=> (string) $item->guid,
                    'content' => (string) $item->description,
                    'media_url' => (string) $item->link,
                    'created_at' => (string) $item->pubDate,
                    'updated_at' => (string) $item->pubDate,
                ];
            }
        }
        return $feeds;
    }

    public function saveFeeds($url)
    {
        $feeds = $this->getRssFeed($url);
        foreach ($feeds as $feed) {
            Feed::updateOrCreate(['media_url'=>$feed['media_url']], $feed);
        }
    }

}
