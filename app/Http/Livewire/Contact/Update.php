<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;

class Update extends Component
{
    public $name;
    public $phone;
    public $contactId;

    public function mount($id)
    {
        $contact = Contact::find($id);
        $this->contactId = $id;
        $this->name = $contact->name;
        $this->phone = $contact->phone;
    }

    public function render()
    {
        return view('livewire.contact.update');
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

            // $this->emit('contactUpdated', $contact);

            session()->flash('message', 'Contact ' . $contact['name'] . ' was updated');
            return redirect()->to('/contact');
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
    }
}





// public function mount($id)
//     {
//         $this->post = Post::find($id);
//     }
