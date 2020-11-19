<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $statusUpdate = false;

    public $paginate = 5;
    public $search;
    public $sortField;
    public $sortAsc = true;
    public $status = null;
    public $confirming;

    protected $queryString = ['search', 'status',  'sortAsc', 'sortField'];

    public function render()
    {
        // sleep(1);
        // Contact::latest()->paginate($this->paginate) :
        return view('livewire.contact.index', [
            'contacts' => Contact::paginate($this->paginate),
            'contacts' => Contact::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortField, function ($query) {
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->paginate($this->paginate),
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    //reset page before searching
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id=null)
    {
        $this->confirming = $id;
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->photo != '') {
            Storage::delete('public/contact/'.$contact->photo);
        }

        $contact->delete();
        session()->flash('message', 'Contact was deleted');
    }
}
