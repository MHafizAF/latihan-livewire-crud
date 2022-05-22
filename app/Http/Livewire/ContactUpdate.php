<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactUpdate extends Component
{
    public $name, $phone, $contactId;

    protected $listeners = [
        'getContact' => 'showContact'
    ];

    public function render()
    {
        return view('livewire.contact-update');
    }

    private function resetInputField()
    {
        $this->name = '';
        $this->phone = '';
    }

    public function showContact($contact)
    {
        $this->name = $contact['name'];
        $this->phone = $contact['phone'];
        $this->contactId = $contact['id'];
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required',
            'phone' => 'required|max:15'
        ]);

        if ($this->contactId) {
            Contact::where('id', $this->contactId)->update($validated);
        }

        $this->resetInputField();
        $this->emit('contactUpdated', $validated);
    }
}
