<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;


class ShowProducts extends Component
{
    use WithPagination;

    public $search;
    public $ordenar = 'products.id';
    public $direccionOrden = 'desc';



    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $ordenar = $this->ordenar;
        $direccionOrden = $this->direccionOrden;

        
        $products = Product::where('name', 'LIKE', "%{$this->search}%");
        
        $products = $products->orderBy("$ordenar", $direccionOrden)
        ->paginate(10);        
        $orders= Order::all();

        return view('livewire.admin.show-products', compact('products','orders'))->layout('layouts.admin');
    }


    public function ordenarPorVendidos()
    {
        $this->cambiarDireccionOrden();
        $this->ordenar = 'products.name';
    }
    public function ordenarPorPendientes()
    {
        $this->cambiarDireccionOrden();
        $this->ordenar = 'products.quantity';
    }


    private function cambiarDireccionOrden()
    {
        $this->direccionOrden = ($this->direccionOrden === 'asc') ? 'desc' : 'asc';
    }
}
