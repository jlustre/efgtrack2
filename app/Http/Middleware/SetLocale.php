<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App as AppFacade;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Priority: authenticated user's saved language -> session -> app default
        $available = ['en', 'es'];

        $normalize = function (?string $value) use ($available) : ?string {
            if (empty($value)) return null;
            $v = strtolower(trim($value));

            // common name mappings
            $map = [
                'spanish' => 'es',
                'espanol' => 'es',
                'español' => 'es',
                'english' => 'en'
            ];

            if (isset($map[$v])) return $map[$v];

            // two-letter locale (es, en)
            if (in_array($v, $available)) return $v;

            // language-region like es-MX or es_mx -> take first two letters
            $short = substr($v, 0, 2);
            if (in_array($short, $available)) return $short;

            return null;
        };

        // start with session or app default
        $locale = $normalize(session('locale', config('app.locale')) ) ?? config('app.locale');

        if (Auth::check()) {
            try {
                $userLang = Auth::user()?->language ?? null;
                $normalized = $normalize($userLang);
                if (!empty($normalized)) {
                    $locale = $normalized;
                    // persist to session so subsequent requests (and JS) see it
                    session(['locale' => $locale]);
                }
            } catch (\Throwable $e) {
                // ignore and fall back to session/config
            }
        }

        // finally, only set an allowed locale
        if ($locale && in_array($locale, $available)) {
            AppFacade::setLocale($locale);
        } else {
            AppFacade::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
