<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WhishlistIconComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh']; //listeners for refresh the child component

    public function render()
    {
        return view('livewire.whishlist-icon-component');
    }
}
