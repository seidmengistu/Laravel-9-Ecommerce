<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $products=Product::paginate(12);
        $new_products=Product::latest()->take(4)->get();

        return view('livewire.shop-component',['products'=>$products,'new_products'=>$new_products]);
    }
}
