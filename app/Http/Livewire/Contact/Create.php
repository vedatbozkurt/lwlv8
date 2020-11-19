<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $phone;
    public $status;
    public $photo;

    protected $rules = [
        'name' => 'required',
        'phone' => 'required|min:3|max:15',
        'status' => 'required',
        'photo' => 'image|max:1024', // 1MB Max
    ];

    protected $messages = [
        'name.required' => 'The Name value cannot be empty.',
        // 'name.required' => 'The :attribute cannot be empty.',
        // 'email.required' => 'The Email Address cannot be empty.',
        // 'email.email' => 'The Email Address format is not valid.',
    ];

    protected $validationAttributes = [
        'phone' => 'Phone Number'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        $photoname = md5($this->photo . microtime()).'.'.$this->photo->extension();
        $this->photo->storeAs('public/contact', $photoname);

        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'status' => $this->status,
            'photo' => $photoname,
        ]);
        $this->resetInput();
        session()->flash('message', 'Contact ' . $contact['name'] . ' was created');
        return redirect()->to('/contacts');
    }
    
    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
        $this->photo = null;
        $this->status = null;
    }

    public function render()
    {
        return view('livewire.contact.create');
    }
}
