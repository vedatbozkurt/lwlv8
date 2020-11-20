<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Status;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Update extends Component
{
    use WithFileUploads;

    public $name;
    public $phone;
    public $photo;
    public $currentPhoto;
    public $status;
    public $statuses;
    public $contactId;

    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required|max:15',
        'status' => 'required',
        'photo' => 'nullable|sometimes|image|max:5000',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount($id)
    {
        $this->statuses  = Status::all();
        $contact = Contact::find($id);
        $this->contactId = $id;
        $this->name = $contact->name;
        $this->status = $contact->status_id;
        $this->phone = $contact->phone;
        $this->currentPhoto = $contact->photo;
    }

    public function render()
    {
        return view('livewire.contact.update');
    }

    public function update()
    {
        $this->validate();

        if ($this->photo) {
            Storage::delete('public/contact/'.$this->currentPhoto);
            $this->currentPhoto = md5($this->photo . microtime()).'.'.$this->photo->extension();
            $this->photo->storeAs('public/contact', $this->currentPhoto);
        }

        if ($this->contactId) {
            $contact = Contact::find($this->contactId);
            $contact->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'status_id' => $this->status,
                'photo' => $this->currentPhoto,
            ]);
            $this->resetInput();

            // $this->emit('contactUpdated', $contact);

            session()->flash('message', 'Contact ' . $contact['name'] . ' was updated');
            return redirect()->to('/contacts');
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
        $this->status = null;
        $this->photo = null;
    }
}





// public function mount($id)
//     {
//         $this->post = Post::find($id);
//     }
