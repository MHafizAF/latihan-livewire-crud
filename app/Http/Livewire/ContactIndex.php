<?php

namespace App\Http\Livewire;

use App\Models\Contact;

use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 5;
    public $search;

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handleUpdated'
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $contacts = $this->search === null ?
            Contact::latest()->paginate($this->paginate) :
            Contact::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);

        return view('livewire.contact-index', [
            'contacts' => $contacts
        ]);
    }

    public function getContact($id)
    {
        $contact = Contact::findOrFail($id);
        $this->emit('getContact', $contact);
    }

    public function destroy($id)
    {
        if ($id) {
            Contact::destroy($id);
            session()->flash('message', 'Contact has been deleted !');
        }
    }

    public function handleStored($contact)
    {
        // close the model using jquery
        $this->emit('userStored');
        session()->flash('message', 'Contact ' . $contact['name'] . ' has been stored !');
    }

    public function handleUpdated($contact)
    {
        $this->emit('userUpdated');
        session()->flash('message', 'Contact ' . $contact['name'] . ' has been updated !');
    }
}
