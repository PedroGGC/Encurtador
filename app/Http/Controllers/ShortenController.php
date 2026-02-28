<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:2048'
        ]);

        $link = Link::create([
            'original_url' => $request->url,
            'code' => Link::generateCode(),
            'user_id' => Auth::check() ? Auth::id() : null,
            'clicks' => 0,
        ]);

        return back()->with('success', 'Link encurtado com sucesso!')->with('short_link', url($link->code));
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:2048'
        ]);

        $link = Link::create([
            'original_url' => $request->url,
            'code' => Link::generateCode(),
            'user_id' => Auth::check() ? Auth::id() : null,
            'clicks' => 0,
        ]);

        return response()->json([
            'short_url' => url($link->code),
            'original_url' => $link->original_url,
            'code' => $link->code
        ]);
    }

    public function redirect($code)
    {
        $link = Link::where('code', $code)->firstOrFail();

        $link->increment('clicks');
        $link->update(['last_click' => now()]);

        return redirect()->away($link->original_url);
    }
}
