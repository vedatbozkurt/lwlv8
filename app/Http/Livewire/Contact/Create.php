<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;

class Create extends Component
{
    public $name;
    public $phone;
    public $status;

    protected $rules = [
        'name' => 'required',
        'phone' => 'required|min:3|max:15',
        'status' => 'required',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $contact = $this->validate();
        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'status' => $this->status
        ]);
        $this->resetInput();
        session()->flash('message', 'Contact ' . $contact['name'] . ' was created');
        return redirect()->to('/contacts');
    }
    
    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
        $this->status = null;
    }

    public function render()
    {
        return view('livewire.contact.create');
    }
}
