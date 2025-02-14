<?php

namespace App\Livewire;

use App\Models\History;
use Livewire\Component;
use App\Models\Product;
use App\Models\Machine;
use App\Models\MachineProduct;
use App\Models\Manufacturing;
use App\Models\Role;
use App\Models\RoleUsers;
use App\Models\User;
use App\Models\WarehouseValue;

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
    public $maxCount;

    public function mount()
    {

        $this->allProducts = Product::all();
        $this->allMachines = Machine::all();
        // $this->allUsers = User::all();
        $role = Role::where('name', 'machine')->first();
        $this->allUsers = $role->users;

        $this->machines[] = ['machine_id' => '', 'user_id' => ''];
    }
   


    public function addMachine()
    {
        $this->machines[] = ['machine_id' => '', 'user_id' => ''];
    }

    public function removeMachine($index)
    {
        unset($this->machines[$index]);
        $this->machines = array_values($this->machines);
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
        $product = Product::findOrFail($this->selectedProduct);

        // Skladdagi materiallarni olish
        // $warehouse = WarehouseValue::where('warehouse_id', 1)->get();
        $product = Product::findOrFail($this->selectedProduct);

        // **Material yetarliligini tekshirish**
        foreach ($product->ingredients as $ingredient) {
            $material = WarehouseValue::where('warehouse_id', 1)
                ->where('product_id', $ingredient->material_id)
                ->first();

            $neededValue = $this->productCount * $ingredient->value;

            if (!$material || $material->value < $neededValue) {
                $this->resetForm();
                $this->addError('error', "{$ingredient->material->name} omborda yetarli emas. Kerak: {$neededValue}, mavjud: " . ($material->value ?? 0));
                return;
            }
        }

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
        foreach ($product->ingredients as $ingredient) {
            $material = WarehouseValue::where('warehouse_id', 1)
                ->where('product_id', $ingredient->material_id)
                ->first();
            if ($material) {

                History::create([
                    'type' => 3,
                    'material_id' => $ingredient->material_id,
                    'quantity' => $this->productCount * $ingredient->value,
                    'previous_value' => $material->value,
                    'current_value' => $material->value - ($this->productCount * $ingredient->value),
                    'from_id' => $material->warehouse_id,
                    'to_id' => $material->id,
                ]);
                $materialValue = $material->value - ($this->productCount * $ingredient->value);

                $material->update([
                    'value' => $materialValue,
                ]);
            }
        }

        session()->flash('success', 'Production successfully added.');
        $this->resetForm();
    }

    public function updatedSelectedProduct()
    {
        // dd($this->selectedProduct);

        $product = Product::findOrFail($this->selectedProduct);

        $availableCounts = [];

        foreach ($product->ingredients as $ingredient) {
            $material = WarehouseValue::where('warehouse_id', 1)
                ->where('product_id', $ingredient->material_id)
                ->first();
            if (!$material || $material->value == 0) {
                $availableCounts[] = 0;
            } else {
                $availableCounts[] = $material->value / $ingredient->value;
            }
        }

        $this->maxCount = round(!empty($availableCounts) ? min($availableCounts) : 0);
        // dd($this->maxCount);
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
        $this->products = Manufacturing::all();
        return view('livewire.manufacturing-component');
    }
}
