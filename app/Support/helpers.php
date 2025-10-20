<?php

if (! function_exists('normalize_avatar_filename')) {
    /**
     * Normalize an avatar storage path to just the filename.
     * Accepts values like "avatars/abc.jpg" or "abc.jpg" and returns "abc.jpg".
     */
    function normalize_avatar_filename(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return basename($path);
    }
}
