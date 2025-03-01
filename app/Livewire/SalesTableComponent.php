<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;

class SalesTableComponent extends Component
{
    public $sales=[];
    public function render()
    {
        $this->sales=Sale::all();
        return view('livewire.sales-table-component');
    }
}
