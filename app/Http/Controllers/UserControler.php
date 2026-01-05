<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // User::find(3)->delete();
        $users = User::where('role', '!=', 'superadmin')->latest()->cursor();

        return view('invite.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', User::class);

        return view('invite.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', User::class);

        $user = auth()->user();
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ];

        // Role validation only if Admin
        if ($user->isAdmin()) {
            $rules['role'] = 'required|in:member,admin';
        }

        if ($user->isSuperAdmin()) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        $validated = $request->validate($rules);

        // Force role if not Admin
        $role = $user->isAdmin()
            ? $validated['role']
            : 'admin';

        // Create invited user
        User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($request->password ?? '123456789'),
            'role'       => $role,
            'company_id' => $request->company_id ?? $user->company_id,
        ]);

        return redirect()->back()->with('success', 'Invitation sent successfully.');
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
