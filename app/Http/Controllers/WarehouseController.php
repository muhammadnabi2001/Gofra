<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\WarehouseCreateRequest;
use App\Http\Requests\Warehouse\WarehouseUpdateRequest;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $users=User::all();
        $warehouses=Warehouse::orderBy('id','desc')->paginate(10);
        return view('Warehouse.index',['warehouses'=>$warehouses,'users'=>$users]);
    }
    public function create(WarehouseCreateRequest $request)
    {
        // dd(123);
        $warehouse=new Warehouse();
        $warehouse->name=$request->name;
        $warehouse->user_id=$request->user_id;
        $warehouse->save();
        return redirect()->back()->with('success','Warehouses created successfully');
    }
    public function delete(Warehouse $warehouse)
    {
        // dd($warehouse->name);
        $warehouse->delete();
        return redirect()->back()->with('success','Warehouse deleted successfully');
    }
    public function update(WarehouseUpdateRequest $request,Warehouse $warehouse)
    {
       // dd($warehouse->name);
       $warehouse->name=$request->name;
       $warehouse->save();
       return redirect()->back()->with('success','Warehouse updated successfully');
        
    }
    public function activity(Warehouse $warehouse)
    {
        // dd($warehouse->name);
        if($warehouse->status)
        {
            $warehouse->status=0;
        }
        else
        {
            $warehouse->status=1;
        }
        $warehouse->save();
        return redirect()->back()->with('success','Warehouse status updated successfully');
    }
}
