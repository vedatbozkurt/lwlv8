<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;

class Create extends Component
{
    public $name;
    public $phone;
    public $status;

    public function render()
    {
        return view('livewire.contact.create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|max:15',
            'status' => 'required'
        ]);
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
}
