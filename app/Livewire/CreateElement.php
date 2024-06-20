<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\Element;
use Livewire\Component;

class CreateElement extends Component
{
    public $cardId;

    public function mount($cardId)
    {
        $this->cardId = $cardId;
    }

    public function render()
    {
        return view('livewire.create-element', ['cardId' => $this->cardId]);
    }

    public function save()
    {
        $this->validate();

        Element::create(
            $this->elementForm->all()
        );

        $cards = Card::orderBy('libelle', 'asc')->get();
        return view('livewire.show-card', [
            'cards' => $cards,
        ]);
    }
}
