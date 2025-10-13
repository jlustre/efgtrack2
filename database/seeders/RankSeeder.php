<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankSeeder extends Seeder
{
    public function run()
    {
        $ranks = [
            ['id' => 1, 'name' => 'Field Associate', 'code' => 'FA', 'level' => 1],
            ['id' => 2, 'name' => 'Senior Field Associate', 'code' => 'SFA', 'level' => 2],
            ['id' => 3, 'name' => 'Sales Manager', 'code' => 'SM', 'level' => 3],
            ['id' => 4, 'name' => 'Executive Director', 'code' => 'ED', 'level' => 4],
            ['id' => 5, 'name' => 'Senior Executive Director', 'code' => 'SED', 'level' => 5],
            ['id' => 6, 'name' => 'National Executive Director', 'code' => 'NED', 'level' => 6],
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->updateOrInsert(
                ['id' => $rank['id']],
                [
                    'name' => $rank['name'],
                    'code' => $rank['code'],
                    'level' => $rank['level'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
