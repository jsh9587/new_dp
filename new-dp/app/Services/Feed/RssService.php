<?php
namespace App\Services\Feed;

use App\Models\Feed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class RssService
{
    protected $url;

    public function __construct()
    {
        $this->url = 'https://news.google.com/rss?hl=ko&gl=KR&ceid=KR:ko';
    }

    public function getRssFeed($url)
    {
        $feeds = [];

        try {
            $response = Http::withoutVerifying()->get($url);

            Log::channel('fetch_rss')->info('HTTP response status: ' . $response->status());
            Log::channel('fetch_rss')->info('HTTP response body: ' . $response->body());

            if ($response->successful()) {
                $rss = simplexml_load_string($response->body());
                if ($rss && isset($rss->channel->item)) {
                    foreach ($rss->channel->item as $item) {
                        $feeds[] = [
                            'user_id' => 53,
                            'type' => 'news',
                            'title' => (string) $item->title,
                            'slug' => (string) $item->guid,
                            'content' => $this->parseContent((string) $item->description),
                            'media_url' => (string) $item->link,
                            'created_at' => Carbon::parse($item->pubDate)->toDateTimeString(),
                            'updated_at' => Carbon::parse($item->pubDate)->toDateTimeString(),
                        ];
                    }
                }
            } else {
                Log::channel('fetch_rss')->error("Failed to fetch RSS feed: " . $response->status());
            }
        } catch (\Exception $e) {
            Log::channel('fetch_rss')->error("Error fetching or parsing RSS feed: " . $e->getMessage());
        }

        return $feeds;
    }

    public function saveFeeds()
    {
        $feeds = $this->getRssFeed($this->url);
        foreach ($feeds as $feed) {
            Feed::updateOrCreate(['media_url' => $feed['media_url']], $feed);
        }
    }

    private function parseContent($content)
    {
        // Content parsing logic here (e.g., strip tags or handle special HTML content)
        return $content;
    }
}

