<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\DepartmentCreateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments=Department::orderBy('id','desc')->paginate(10);
        return view('Deparment.index',['departments'=>$departments]);
    }
    public function create(DepartmentCreateRequest $request)
    {
        // dd($request->all());
        $validated=$request->validated();
        $department=new Department();
        $department->name=$validated['name'];
        $department->save();
        return redirect()->back()->with('success','Department created successfully');

    }
}
