<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserState;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Feed\RssService;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = DB::connection('dailypharm')->table('Reporter')->where('nDelCode', 0)->get();
        foreach ($users as $user) {

            $hashed_password = Hash::make('epdlfflvka11!');

            $newUser = User::create([
                'name' => mb_convert_encoding($user->Name, 'UTF8', 'EUC-KR'),
                'email' => $user->Email,
                'password' => $hashed_password,
            ]);

            UserState::create([
                'user_id' => $newUser->id,
                'active' => true,
            ]);
        }

        $RssService = new RssService();
        $RssService->saveFeeds("https://news.google.com/rss?hl=ko&gl=KR&ceid=KR:ko");
    }
}
