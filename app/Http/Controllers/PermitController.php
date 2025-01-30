<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\PermissionCreateRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Models\PermissionGroup;
use App\Models\Permit;
use Illuminate\Http\Request;

class PermitController extends Controller
{
    public function index()
    {
        $permissions=Permit::orderBy('id','desc')->paginate(10);
        $groups=PermissionGroup::all();
        return view('Permission.index',['permissions'=>$permissions,'groups'=>$groups]);
    }
    public function create(PermissionCreateRequest $request)
    {
        $validated = $request->validated();
        $permission = new Permit();
        $permission->name = $validated['name'];
        $permission->group_id = $validated['group_id'];
        $permission->save();
        return redirect()->back()->with('success','Permittion created successfully');
    }
    public function update(PermissionUpdateRequest $request,Permit $permission)
    {
        $validated=$request->validated();
        $permission->group_id=$validated['group_id'];
        $permission->name=$validated['name'];
        $permission->save();
        return redirect()->back()->with('success','Permission updated successfully');
    }
    public function delete(Permit $permission)
    {
        $permission->delete();
        return redirect()->back()->with('success',"Permission deleted successfully");
    }
}
