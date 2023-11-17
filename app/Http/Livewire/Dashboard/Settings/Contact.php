<?php

namespace App\Http\Livewire\Dashboard\Settings;

use App\Models\Contact as ModelsContact;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Contact extends Component
{   
    use LivewireAlert;
    public ModelsContact $contact;

    public $contacts = [
        ['name' => '', 'contact_url' => '']
    ];
    
    public function render()
    {
        return view('livewire.dashboard.settings.contact');
    }

    public function mount()
    {
        $this->contacts = ModelsContact::all()->map(function ($contact) {
            return ['name' => $contact->name, 'contact_url' => $contact->contact_url];
        })->toArray();

    }

    public function save()
    {
        $this->validate([
            'contacts.*.name' => 'required|string|max:255',
            'contacts.*.contact_url' => 'required|url|max:255',
        ]);

        ModelsContact::truncate();

        foreach ($this->contacts as $item) {
            ModelsContact::create([
                'name' => $item['name'],
                'contact_url' => $item['contact_url']
            ]);
        }
        $this->alert('success', 'contact saved');
    }

    public function addContact()
    {
        $this->contacts[] = ['name' => '', 'contact_url' => ''];
    }

    public function deleteContact($index)
    {
        unset($this->contacts[$index]);
        $this->contacts = array_values($this->contacts); // Reset array keys
    }

    public function resetContacts()
    {
        $this->contacts = [
            ['name' => '', 'contact_url' => '']
        ];
    }

}
