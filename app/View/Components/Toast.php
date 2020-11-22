<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    public $toastType;
    public $toastMessage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($toastType, $toastMessage)
    {
        $this->toastType = $toastType;
        $this->toastMessage = $toastMessage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.toast');
    }
}
