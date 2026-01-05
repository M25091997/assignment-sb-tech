<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $urls = ShortUrl::where('company_id', '!=', $user->company_id)->latest()->get();
        } elseif ($user->isMember()) {
            $urls = ShortUrl::where('user_id', '!=', $user->id)->latest()->get();
        } else {
            $urls = collect();
        }

        return view('shorturl.index', compact('urls'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', ShortUrl::class);
        Gate::authorize('create', ShortUrl::class);
        return view('shorturl.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', ShortUrl::class);
        $user = auth()->user();

        $request->validate([
            'original_url' => 'required|url'
        ]);

        $short = ShortUrl::create([
            'original_url' => $request->original_url,
            'code'         => Str::random(6),
            'user_id'      => $user->id,
            'company_id'   => $user->company_id,
        ]);

        return back()->with('success', 'Short URL created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
