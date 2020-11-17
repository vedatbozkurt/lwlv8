<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $statusUpdate = false;

    public $paginate = 5;
    public $search;

    protected $queryString = ['search'];

    public function render()
    {
        // sleep(1);
        $data = [
            'contacts' => $this->search === null ?
                Contact::latest()->paginate($this->paginate) :
                Contact::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ];
        return view('livewire.contact.index', $data);
    }

    //reset page before searching
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        session()->flash('message', 'Contact was deleted');
    }
}
