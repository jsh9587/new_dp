<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserState;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users = DB::connection('dailypharm')->table('Reporter')->where('nDelCode',0)->get();
        foreach ($users as $user) {
            $user = User::create([
                'name' => mb_convert_encoding($user->Name,'UTF8','EUC-KR'),
                'email' => $user->Email,
                'password' => $user->Passwd,
            ]);

            $userState = UserState::create([
               'user_id' => $user->id,
                'active' => true,
            ]);
        }

    }
}
