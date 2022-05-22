<?php

namespace App\Http\Livewire;

use App\Models\Contact;

use Livewire\Component;

class ContactCreate extends Component
{
    public $name, $phone;

    public function render()
    {
        return view('livewire.contact-create');
    }

    private function resetInputField()
    {
        $this->name = '';
        $this->phone = '';
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => 'required',
            'phone' => 'required|max:15'
        ]);

        $contact = Contact::create($validated);

        $this->resetInputField();
        $this->emit('contactStored', $contact);
    }
}
