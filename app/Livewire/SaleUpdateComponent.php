<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;

class SaleUpdateComponent extends Component
{
    public $sale;
    public $selected_customer;
    public $customers;
    public $products;
    public $sales = [];

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $this->customers = Customer::all();
        $this->products = Product::all();

        $this->selected_customer = $sale->customer_id;

        foreach ($sale->items as $item) {
            $this->sales[] = [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->quantity * $item->price
            ];
        }
    }

    public function updatePrice($index)
    {
        if (isset($this->sales[$index]['product_id']) && $this->sales[$index]['product_id']) {
            $product = Product::find($this->sales[$index]['product_id']);
            if ($product) {
                $this->sales[$index]['price'] = $product->price;
                $this->calculateTotal($index);
            }
        }
    }
    
    public function validateQuantity($index)
    {
        $quantity = (int) ($this->sales[$index]['quantity'] ?? 0);
        if ($quantity < 1) {
            $this->sales[$index]['quantity'] = 1;
        }
        $this->calculateTotal($index);
    }
    public function addSaleRow()
    {
        $this->sales[] = [
            'product_id' => '',
            'quantity' => 1,
            'price' => 0,
            'total' => 0,
        ];
    }
    public function calculateTotal($index)
    {
        $quantity = (int) ($this->sales[$index]['quantity'] ?? 1);
        $price = (float) ($this->sales[$index]['price'] ?? 0);
        $this->sales[$index]['total'] = $quantity * $price;
    }
    public function removeSaleRow($index)
    {
        unset($this->sales[$index]);
        $this->sales = array_values($this->sales); 
    }

    public function saveSale()
    {
        $this->sale->customer_id = $this->selected_customer;
        $this->sale->save();

       
        $this->sale->items()->delete();

        
        foreach ($this->sales as $saleItem) {
            $this->sale->items()->create([
                'product_id' => $saleItem['product_id'],
                'quantity' => $saleItem['quantity'],
                'price' => $saleItem['price'],
                'total' => $saleItem['total'],
            ]);
        }

        session()->flash('success', 'Sale updated successfully!');
    }

    public function render()
    {
        return view('livewire.sale-update-component');
    }
}
