<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users=User::orderBy('id','desc')->paginate(10);
        $roles=Role::all();
        return view('Users.index',['users'=>$users,'roles'=>$roles]);
    }
    public function create(UserCreateRequest $request)
    {
        //dd($request->all());
        $validated=$request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    
        $user->roles()->attach($validated['role_id']);
        return redirect()->back()->with('success',"User created successfully");
    }
    public function update(UserUpdateRequest $request)
    {
        dd($request->all());
    }
}
