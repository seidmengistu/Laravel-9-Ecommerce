<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public $pageSize = 9;
    public $orderBy="default sorting";
    public $min_value = 1;
    public $max_value = 1000;

    //Adding product to the Cart Functionality Uing Pacakges

    public function store($product_id,$product_name,$product_price){
        
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product',1);
        session()->flash('success_message', 'Item added to the cart!');
        return redirect()->route('shop.cart');

    }

    //Add to Whishlist
    public function addToWhishlist($product_id,$product_name,$product_price){
        Cart::instance('whishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product',1);
        $this->emitTo('whishlist-icon-component','refreshComponent');
    }

    //changing page size
    public function setPage($page){
        $this->pageSize = $page;
    }

    //Order By

    public function orderBy($orderBy){
        $this->orderBy = $orderBy;
    }

    public function render()
    {
        if($this->orderBy == 'Price: Low to High'){
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        elseif($this->orderBy == "Price: High to Low"){
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price','DESC')->paginate($this->pageSize);

        }
        elseif($this->orderBy == "Newest Arrival") {
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('created_at','DESC')->paginate($this->pageSize);

        }
        else{
            $products=Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->paginate($this->pageSize);

        }

        $new_products=Product::latest()->take(4)->get();
        $categories=Category::orderBy('name','ASC')->get();
        return view('livewire.shop-component',['products'=>$products,'new_products'=>$new_products,'categories'=>$categories]);
    }
}
