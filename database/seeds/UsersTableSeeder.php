<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Commons\Utility;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Utility::getDatetimeNow();
        DB::table('users')->insert([[
            'fullname' => 'Nguyen Van An',
            'phone' => '0977888999',
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            'fullname' => 'Tran Van Binh',
            'phone' => '0977555666',
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            'fullname' => 'Tran Van An',
            'phone' => '0977444555',
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            'fullname' => 'Tran Van Minh',
            'phone' => '0977333444',
            'created_at' => $now,
            'updated_at' => $now,
        ], [
            'fullname' => 'Tran Van Hoang',
            'phone' => '0977222333',
            'created_at' => $now,
            'updated_at' => $now,
        ]]);
    }
}
