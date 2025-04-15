<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSchoolSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users_schools')->insert([
            [
                'user_id' => 1,
                'school_id' => 1,
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'school_id' => 1,
                'role' => 'teacher',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // ➕ Ajoute d'autres entrées ici si besoin
        ]);
    }
}
