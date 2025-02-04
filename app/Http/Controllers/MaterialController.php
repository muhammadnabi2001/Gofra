<?php

namespace App\Http\Controllers;

use App\Http\Requests\Material\MaterialCreateRequest;
use App\Http\Requests\Material\MaterialUpdateRequest;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MaterialController extends Controller
{
    public function index()
    {
        $materials=Material::orderBy('id','desc')->paginate(10);
        return view("Material.index",['materials'=>$materials]);
    }
    public function create(MaterialCreateRequest $request)
    {
        $slug = Str::slug($request->name);

        if (Material::where('slug', $slug)->exists()) {
            return back()->withErrors(['name' => 'This material already exists.'])->withInput();
        }
    
        Material::create([
            'name' => $request->name,
            'slug' => $slug
        ]);
    
        return redirect()->back()->with('success', 'Material created successfully.');
    }
    public function update(MaterialUpdateRequest $request,Material $material)
    {
        if ($request->name !== $material->name) {
            $slug = Str::slug($request->name);
    
            if (Material::where('slug', $slug)->where('id', '!=', $material->id)->exists()) {
                return back()->withErrors(['name' => 'This material name is already taken.'])->withInput();
            }
            
            $material->slug = $slug;
        }
    
        $material->update([
            'name' => $request->name,
            'slug' => $material->slug, 
        ]);
    
        return redirect()->back()->with('success', 'Material updated successfully.');
    }
    public function delete(Material $material)
    {
        // dd($material->name);
        $material->delete();
        return redirect()->back()->with('success','Material deleted successfully');
    }
}
