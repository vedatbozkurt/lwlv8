<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Alert extends Component
{
    public $toastType;
    public $toastMessage;
    
    public function render()
    {
        return view('livewire.alert');
    }
}
