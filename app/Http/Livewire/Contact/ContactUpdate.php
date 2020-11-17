<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;

class ContactUpdate extends Component
{
    public $name;
    public $phone;
    public $contactId;

    protected $listeners = [
        'getContact' => 'showContact'
    ];

    public function render()
    {
        return view('livewire.contact.contact-update');
    }

    public function showContact($contact)
    {
        $this->name = $contact['name'];
        $this->phone = $contact['phone'];
        $this->contactId = $contact['id'];
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|max:15'
        ]);
        if ($this->contactId) {
            $contact = Contact::find($this->contactId);
            $contact->update([
                'name' => $this->name,
                'phone' => $this->phone
            ]);
            $this->resetInput();

            $this->emit('contactUpdated', $contact);

            // session()->flash('message', 'Contact ' . $contact['name'] . ' was updated');
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
    }
}
