<?php

namespace App\Http\Livewire;

use App\Models\Contact;

use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handleUpdated'
    ];

    public function render()
    {
        $contacts = Contact::latest()->paginate(5);

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
