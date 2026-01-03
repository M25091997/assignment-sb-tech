<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class ShortUrlRedirectController extends Controller
{
    public function redirect(string $code)
    {
        $user = auth()->user();

        $shortUrl = ShortUrl::where('code', $code)->firstOrFail();

        // SuperAdmin → NOT allowed
        abort_if($user->isSuperAdmin(), 403);

        // Admin → cannot access own company URLs
        if ($user->isAdmin() && $shortUrl->company_id === $user->company_id) {
            abort(403);
        }

        // Member → cannot access own URLs
        if ($user->isMember() && $shortUrl->user_id === $user->id) {
            abort(403);
        }

        return redirect()->away($shortUrl->original_url);
    }

    public function publiclyRedirect(string $code)
    {
        $shortUrl = ShortUrl::where('code', $code)->firstOrFail();

        return redirect()->away($shortUrl->original_url);
    }
}
