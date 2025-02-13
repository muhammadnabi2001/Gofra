<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Machine;
use App\Models\MachineProduct;
use App\Models\Manufacturing;
use App\Models\User;

class ManufacturingComponent extends Component
{
    public $showModal = false;
    public $selectedProduct;
    public $productCount;
    public $machines = [];
    public $products;

    public $allProducts;
    public $allMachines;
    public $allUsers;

    public function mount()
    {
        $this->allProducts = Product::all();
        $this->allMachines = Machine::all();
        $this->allUsers = User::all();

        // Default bitta mashina va foydalanuvchi qo'shish
        $this->machines[] = ['machine_id' => '', 'user_id' => ''];
    }

    public function addMachine()
    {
        $this->machines[] = ['machine_id' => '', 'user_id' => ''];
    }

    public function removeMachine($index)
    {
        unset($this->machines[$index]);
        $this->machines = array_values($this->machines); // Indexlarni qayta tiklash
    }

    public function saveProduction()
    {
        // dd($this->selectedProduct);
        $this->showModal = false;
        $this->validate([
            'selectedProduct' => 'required',
            'productCount' => 'required|integer|min:1',
            'machines.*.machine_id' => 'required',
            'machines.*.user_id' => 'required',
        ]);

        $manufacturing = Manufacturing::create([
            'product_id' => $this->selectedProduct,
            'total_count' => $this->productCount,
            'produced_count' => $this->productCount,
            'waste_count' => 0,
        ]);

        foreach ($this->machines as $machine) {
            MachineProduct::create([
                'manufacturing_id' => $manufacturing->id,
                'machine_id' => $machine['machine_id'],
                'user_id' => $machine['user_id'],
                'total_count' => $this->productCount,
                'waste_count' => 0,
            ]);
        }

        
        session()->flash('success', 'Production successfully added.');
        $this->resetForm();
    }


    public function resetForm()
    {
        $this->selectedProduct = null;
        $this->productCount = null;
        $this->machines = [['machine_id' => '', 'user_id' => '']];
        $this->showModal = false;
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        $this->products= Manufacturing::all();
        return view('livewire.manufacturing-component');
    }
}
