<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;

class ContactCreate extends Component
{
    public $name;
    public $phone;

    public function render()
    {
        return view('livewire.contact.contact-create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|max:15'
        ]);
        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone
        ]);
        $this->resetInput();
        
        // session()->flash('message', 'Contact ' . $contact['name'] . ' was created');
        $this->emit('contactStored', $contact);
    }

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
    }
}
