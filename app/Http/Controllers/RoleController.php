<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\RoleCreateRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        //dd(123);
        $roles=Role::orderby('id','desc')->paginate(10);
        return view('Roles.index',['roles'=>$roles]);
    }
    public function create(RoleCreateRequest $request)
    {
        $validated = $request->validated();
        $role = new Role();
        $role->name = $validated['name'];
        $role->save();
        return redirect()->back()->with('success','Role created successfully');
    }
    public function update(RoleUpdateRequest $request,Role $role)
    {
        $validated = $request->validated();
        $role->name=$validated['name'];
        $role->save();
        return redirect()->back()->with('success','Role updated successfully');
    }
    public function delete(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success','Role deleted successfully');
    }
}
