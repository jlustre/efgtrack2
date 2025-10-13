<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimezoneSeeder extends Seeder
{
    public function run()
    {
        $timezones = [
            ['name' => 'Pacific/Honolulu', 'abbreviation' => 'HST', 'utc_offset' => '-10:00'],
            ['name' => 'America/Anchorage', 'abbreviation' => 'AKST', 'utc_offset' => '-09:00'],
            ['name' => 'America/Los_Angeles', 'abbreviation' => 'PST', 'utc_offset' => '-08:00'],
            ['name' => 'America/Denver', 'abbreviation' => 'MST', 'utc_offset' => '-07:00'],
            ['name' => 'America/Chicago', 'abbreviation' => 'CST', 'utc_offset' => '-06:00'],
            ['name' => 'America/New_York', 'abbreviation' => 'EST', 'utc_offset' => '-05:00'],
            ['name' => 'America/Toronto', 'abbreviation' => 'EST', 'utc_offset' => '-05:00'],
            ['name' => 'America/Vancouver', 'abbreviation' => 'PST', 'utc_offset' => '-08:00'],
            ['name' => 'America/Halifax', 'abbreviation' => 'AST', 'utc_offset' => '-04:00'],
            ['name' => 'America/St_Johns', 'abbreviation' => 'NST', 'utc_offset' => '-03:30'],
            ['name' => 'Europe/London', 'abbreviation' => 'GMT', 'utc_offset' => '+00:00'],
            ['name' => 'Europe/Paris', 'abbreviation' => 'CET', 'utc_offset' => '+01:00'],
            ['name' => 'Europe/Berlin', 'abbreviation' => 'CET', 'utc_offset' => '+01:00'],
            ['name' => 'Asia/Tokyo', 'abbreviation' => 'JST', 'utc_offset' => '+09:00'],
            ['name' => 'Asia/Shanghai', 'abbreviation' => 'CST', 'utc_offset' => '+08:00'],
            ['name' => 'Asia/Kolkata', 'abbreviation' => 'IST', 'utc_offset' => '+05:30'],
            ['name' => 'Australia/Sydney', 'abbreviation' => 'AEST', 'utc_offset' => '+10:00'],
            ['name' => 'Pacific/Auckland', 'abbreviation' => 'NZST', 'utc_offset' => '+12:00'],
        ];

        foreach ($timezones as $tz) {
            DB::table('timezones')->updateOrInsert(
                ['name' => $tz['name']],
                [
                    'abbreviation' => $tz['abbreviation'],
                    'utc_offset' => $tz['utc_offset'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
