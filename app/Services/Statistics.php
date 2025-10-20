<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;

/**
 * Small statistics helper service.
 * Keep DB-guarding logic in one place so views/controllers can call safely.
 */
class Statistics
{
    /**
     * Return a safe count for a model class.
     * If the table doesn't exist or any error occurs, returns 0.
     *
     * @param string $modelClass Fully-qualified model class name
     * @return int
     */
    public static function countModel(string $modelClass): int
    {
        try {
            if (!class_exists($modelClass)) {
                return 0;
            }

            $model = new $modelClass;

            $table = $model->getTable();

            if (! Schema::hasTable($table)) {
                return 0;
            }

            return (int) $modelClass::count();
        } catch (\Throwable $e) {
            // Swallow and return 0 in environments missing the table (tests, early deploys)
            return 0;
        }
    }

    /**
     * Count recruits (convenience wrapper).
     */
    public static function recruitsCount(): int
    {
        return self::countModel(\App\Models\Recruit::class);
    }

    /**
     * Return a human-friendly label for recruits.
     */
    public static function recruitsLabel(): string
    {
        return __('Total Recruits');
    }
}
