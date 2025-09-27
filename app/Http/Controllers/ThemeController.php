<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /**
     * Get the current user's theme settings.
     */
    public function get(): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'theme_settings' => $user->getThemeSettings()
        ]);
    }

    /**
     * Update the current user's theme settings.
     */
    public function update(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'primary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'accent' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $user->updateThemeSettings($validated);

        return response()->json([
            'message' => 'Theme settings updated successfully',
            'theme_settings' => $validated
        ]);
    }
}
