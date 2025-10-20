<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class NormalizeAvatars extends Command
{
    protected $signature = 'users:normalize-avatars';
    protected $description = 'Normalize avatar_path for all users (strip directory prefixes)';

    public function handle()
    {
        $this->info('Normalizing avatar_path for users...');

        $count = 0;
        User::chunk(100, function ($users) use (&$count) {
            foreach ($users as $user) {
                if (! $user->avatar_path) {
                    continue;
                }

                $normalized = basename($user->avatar_path);
                if ($normalized !== $user->avatar_path) {
                    $user->avatar_path = $normalized;
                    $user->save();
                    $count++;
                    $this->line("Updated user {$user->id}: avatar_path => {$normalized}");
                }
            }
        });

        $this->info("Done. Updated {$count} users.");

        return 0;
    }
}
