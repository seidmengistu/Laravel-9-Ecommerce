<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{   public $slug;
    function mount($slug)
    {
       $this->slug=$slug;
    }

    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id, $product_name,1,$product_price)->associate('App\Models\Product', 1);
        // dd(Cart::content());
        session()->flash('success_message', 'Item added in Cart successfully');
        return redirect()->route('shop.cart');

    }
    public function render()
    {
        $product=Product::where('slug',$this->slug)->first();
        $related_products=Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $new_products=Product::latest()->take(4)->get();
        return view('livewire.details-component',['product'=>$product,'related_products'=>$related_products,'new_products'=>$new_products]);
    }
}
