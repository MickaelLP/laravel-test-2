<?php

namespace App\Livewire\Forms;

use App\Models\Card;
use App\Models\Element;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CreateElement extends Form
{
    public CreateElement $form;
    public $libelle = '';
    public $card_id = '';

    public function rules()
    {
        return [
            'libelle' => 'required|string',
            'card_id' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        Element::create(
            $this->form->all()
        );

        $cards = Card::orderBy('libelle', 'asc')->get();
        return view('livewire.show-card', [
            'cards' => $cards,
        ]);
    }
}
