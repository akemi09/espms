<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Super Admin|Admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name', 'asc')->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => Str::title($data['name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        foreach ($data['roles'] as $role) {
            $user->assignRole($role);
        }

        return back()->with('success', 'User created.');
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
    public function edit(User $user)
    {
        if ($user->id == 1)
        {
            abort(403);
        }

        $roles = Role::orderBy('name', 'asc')->get();
        $user_roles = [];
        foreach ($user->roles as $role) {
            array_push($user_roles, $role['name']);
        }
        
        return view('users.edit', compact('roles', 'user', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $data = $request->validated();
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->syncRoles($data['roles']);
        $user->save();

        return back()->with('success', 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id == 1)
        {
            abort(403);
        }
        
        $user->delete();

        return back()->with('success', 'User deleted.');
    }
}
