<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;
    public $sortField;
    public $sortAsc = true;
    public $status = null;
    public $confirming;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'sortAsc',
        'sortField'
    ];

    public function render()
    {
        // session()->flash('deneme', 'Contact was deleted');
        // $this->dispatchBrowserEvent('alert');
        // $this->dispatchBrowserEvent('alert',['type' => 'success','message' => 'Saved']);
        // sleep(1);
        // Contact::latest()->paginate($this->paginate) :
        return view('livewire.contact.index', [
            'statuses' => Status::all(),
            'contacts' => Contact::with('status')->paginate($this->paginate),
            'contacts' => Contact::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortField, function ($query) {
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            })
            ->when($this->status, function ($query) {
                $query->where('status_id', $this->status);
            })
            ->with('status')
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

    //reset page number before searching
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingStatus()
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

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Contact ' . $contact['name'] . ' was deleted'
        ]);
        $contact->delete();
    }
}
