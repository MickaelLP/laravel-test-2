<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateCard;
use App\Livewire\Forms\CreateElement;
use App\Models\Card;
use App\Models\Element;
use Livewire\Component;

class ShowCard extends Component
{
    public CreateCard $form;

    public CreateElement $elementForm;

    public Card $cardForUpdate;

    public bool $isShowFormUpdate = false;

    public int $updateId;

    public string $updateLibelle;

    public string $updateDescription;

    public function save()
    {
        $this->validate();

        Card::create(
            $this->form->all()
        );

        $cards = Card::orderBy('libelle', 'asc')->get();
        return view('livewire.show-card', [
            'cards' => $cards,
        ]);
    }

    public function saveElement()
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

    public function delete($id)
    {
        $card = Card::findOrFail($id);

        $this->authorize('delete', $card);

        $card->delete();
    }

    public function render()
    {
        $cards = Card::orderBy('libelle', 'asc')->get();
        $elements = Element::orderBy('libelle', 'desc')->get();
        return view('livewire.show-card', [
            'cards' => $cards,
            'elements' => $elements,
            'cardForUpdate' => $this->cardForUpdate ?? null,
            'isShowFormUpdate' => $this->isShowFormUpdate,
        ]);
    }

    public function showFormUpdate($id)
    {
        $card = Card::findOrFail($id);
        $this->isShowFormUpdate = true;
        $this->cardForUpdate = $card;
        $this->updateId = $id;
        $this->updateLibelle = $card->libelle;
        $this->updateDescription = $card->description;
    }

    public function submitUpdate($id)
    {
        $libelle = $this->updateLibelle;
        $description = $this->updateDescription;
        $card = Card::findOrFail($id);
        $this->authorize('update', $card);
        $card->update([
            'libelle' => $libelle,
            'description' => $description,
        ]);
        $this->isShowFormUpdate = false;
    }
}
