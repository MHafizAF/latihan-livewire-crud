<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactIndex extends Component
{
    public $contacts;

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handleUpdated'
    ];

    public function render()
    {
        $this->contacts = Contact::latest()->get();
        return view('livewire.contact-index');
    }

    public function getContact($id)
    {
        $contact = Contact::findOrFail($id);
        $this->emit('getContact', $contact);
    }

    public function handleStored($contact)
    {
        $this->emit('userStored'); // close the model using jquery
        session()->flash('message', 'Contact ' . $contact['name'] . ' has been stored !');
    }

    public function handleUpdated($contact)
    {
        $this->emit('userUpdated');
        session()->flash('message', 'Contact ' . $contact['name'] . ' has been updated !');
    }
}
