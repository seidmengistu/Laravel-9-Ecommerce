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
        $this->emitTo('cart-icon-component','refreshComponent');
   }


   //decease cart count
   public function decreaseQuantity($rowId){
        $product=Cart::get($rowId);
        $qty=$product->qty-1;
        Cart::update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');
   }

   //remove item rom cart
   public function removeItem($id){
        Cart::remove($id);
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message', 'Item removed');
        
   }

   // clear item from cart

   public function clearItem(){
        Cart::destroy();
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message', 'Items removed');
        
   }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
