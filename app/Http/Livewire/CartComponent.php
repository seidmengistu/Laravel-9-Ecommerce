<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{

    //increase cart count
   public function increaseQuantity($rowId){
        $product=Cart::get($rowId);
        $qty=$product->qty+1;
        Cart::update($rowId,$qty);
   }

   //decease cart count

   public function decreaseQuantity($rowId){
        $product=Cart::get($rowId);
        $qty=$product->qty-1;
        Cart::update($rowId,$qty);
   }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
