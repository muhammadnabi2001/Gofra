<?php

namespace App\Livewire;

use App\Models\MachineProduct;
use Livewire\Component;

class ProductionComponent extends Component
{
    public $permission1=false;
    public $permission2=false;
    public $permission3=false;
    public $machineproducts;
    public $manufactured;
    public $showModal = false;
    
    public function render()
    {
        // dd(auth()->user()->id);
        $this->machineproducts=MachineProduct::where('user_id',3)->where('status','1')->get();
        $this->manufactured=MachineProduct::where('user_id',3)->where('status','2')->get();
        // dd($machineproducts);

        return view('livewire.production-component');
    }
    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        // $this->reset(['brak', 'count']); // Modal yopilganda inputlarni tozalash
    }
    public function givepermission($id)
    {
        if($this->permission1==$id)
        {
            $this->permission1=false;
        }else{
            $this->permission1=$id;
        }
    }
    public function acceptRequest($id)
    {
        $machineproduct=MachineProduct::findOrFail($id);
        if($machineproduct)
        {
            $machineproduct->status=2;
            $machineproduct->save();
        }
    }
    public function allowance($id)
    {
        if($this->permission2==$id)
        {
            $this->permission2=false;
        }else{
            $this->permission2=$id;
        }
    }
}
