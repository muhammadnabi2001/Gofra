<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\GroupCreateRequest;
use App\Http\Requests\Group\GroupUpdateRequest;
use App\Http\Requests\PermissionCreateRequest;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    public function index()
    {
        $groups=PermissionGroup::orderBy('id','desc')->paginate(10);
        return view('Groups.index',['groups'=>$groups]);
    }
    public function create(GroupCreateRequest $request)
    {
        $validated = $request->validated();
        $role = new PermissionGroup();
        $role->name = $validated['name'];
        $role->save();
        return redirect()->back()->with('success','Group created successfully'); 
    }
    public function update(GroupUpdateRequest $request,PermissionGroup $group)
    {
        $validated = $request->validated();
        $group->name=$validated['name'];
        $group->save();
        return redirect()->back()->with('success','Group updated successfully');
    }
    public function delete(PermissionGroup $group)
    {
        $group->delete();
        return redirect()->back()->with('success','Group deleted successfully');
    }
}
