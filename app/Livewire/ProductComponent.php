<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductIngredient;

class ProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $materials = [];
    public $allMaterials = [];

    public function mount()
    {
        $this->allMaterials = Material::all();
        $this->materials = [['material' => '', 'quantity' => 1]];
    }

    public function addMaterial()
    {
        $this->materials[] = ['material' => '', 'quantity' => 1];
        $this->dispatch('openModal');
    }

    public function removeMaterial($index)
    {
        unset($this->materials[$index]);
        $this->materials = array_values($this->materials);
        $this->dispatch('openModal');
    }

    public function saveProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'materials.*.material' => 'required|exists:materials,id',
            'materials.*.quantity' => 'required|numeric|min:1',
        ]);

        $imagePath = null;

        if ($this->image) {
            $extension = $this->image->getClientOriginalExtension();
            $filename = now()->format("Y-m-d") . '_' . time() . '.' . $extension;
            $imagePath = $this->image->storeAs('img_uploaded', $filename, 'public');
        }

        $product = Product::create([
            'name' => $this->name,
            'img' => $imagePath,
        ]);

        foreach ($this->materials as $material) {
            $materialModel = Material::find($material['material']);
            $invoiceMaterial = $materialModel->invoiceMaterials->first();

            if ($invoiceMaterial) {
                $unit = $invoiceMaterial->unit;
            } else {
                $unit = 'No Unit';
            }

            ProductIngredient::create([
                'product_id' => $product->id,
                'material_id' => $material['material'],
                'value' => $material['quantity'],
                'unit' => $unit,
            ]);
        }

        $this->reset(['name', 'image', 'materials']);
        $this->materials = [['material' => '', 'quantity' => 1]];

        session()->flash('message', 'Product successfully created!');
        $this->dispatch('closeModal');
    }



    public function render()
    {
        return view('livewire.product-component');
    }
}
