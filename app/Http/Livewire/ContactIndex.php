<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactIndex extends Component
{
    public $contacts;

    protected $listeners = [
        'contactStored' => 'handleStored'
    ];

    public function render()
    {
        $this->contacts = Contact::latest()->get();
        return view('livewire.contact-index');
    }

    public function handleStored($contact)
    {
        $this->emit('userStored'); // close the model using jquery
        session()->flash('message', 'Contact ' . $contact['name'] . ' has been stored !');
    }
}
