<?php

namespace App\Http\Livewire;

use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Telegram extends Component
{
    use LivewireAlert;
    
    public $bot;
    public $chat;
    public $chat_id;
    public $token;
    public $bot_name;
    public $chat_name;
    
    public function mount()
    {
        $this->bot = TelegraphBot::first();
        $this->chat = TelegraphChat::first();

        $this->chat_name = $this->chat->name;
        $this->chat_id = $this->chat->chat_id;
        $this->bot_name = $this->bot->name;
        $this->token = $this->bot->token;
    }
    
    public function render()
    {
        return view('livewire.telegram');
    }

    public function save()
    {
        $this->validate([
            'chat_id' => 'required|string',
            'token' => 'required|string',
            'bot_name' => 'required|string',
            'chat_name' => 'required|string',
        ]);

        if ($this->bot) {
            $this->bot->update([
                'token' => $this->token,
                'name' => $this->bot_name ?? 'AvstreamBot'
            ]);
        }

        if ($this->chat) {
            $this->chat->update([
                'chat_id' => $this->chat_id,
                'name' => $this->chat_name ?? 'AvstreamChat'
            ]);
        }
        
        $this->alert('success', 'Telegram bot updated');
    }
}
