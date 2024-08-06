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
//        $users = DB::connection('dailypharm')->table('Reporter')->where('nDelCode', 0)->get();
//        foreach ($users as $user) {
//
//            $hashed_password = Hash::make('epdlfflvka11!');
//
//            $newUser = User::create([
//                'name' => mb_convert_encoding($user->Name, 'UTF8', 'EUC-KR'),
//                'email' => $user->Email,
//                'password' => $hashed_password,
//            ]);
//
//            UserState::create([
//                'user_id' => $newUser->id,
//                'active' => true,
//            ]);
//        }
        $hashed_password = Hash::make('epdlfflvka11!');
        $newUser = User::create([
            'name' => '정승훈',
            'email' => 'jsh9587@dailypharm.com',
            'password' => $hashed_password,
        ]);

        UserState::create([
            'user_id' => $newUser->id,
            'active' => true,
        ]);
        User::factory(30)->create();
        UserState::factory(30)->create();
        try {
            $RssService = new RssService();
            Log::info('About to call saveFeeds method');
            $RssService->saveFeeds();
            Log::info('saveFeeds method called successfully');
        } catch (\Exception $e) {
            Log::error('Failed to save feeds: ' . $e->getMessage());
        }
    }
}
