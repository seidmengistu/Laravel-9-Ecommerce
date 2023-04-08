<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    use WithPagination;

    //Adding product to the Cart Functionality Uing Pacakges

    public function store($product_id,$product_name,$product_price){
        
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product',1);
        session()->flash('success_message', 'Item added to the cart!');
        return redirect()->route('shop.cart');

    }
    public function render()
    {
        $products=Product::paginate(12);
        $new_products=Product::latest()->take(4)->get();
        return view('livewire.shop-component',['products'=>$products,'new_products'=>$new_products]);
    }
}
