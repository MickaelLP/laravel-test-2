<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;


class CreateCard extends Form
{
    public $libelle = '';

    public $description = '';

    public function rules()
    {
        return [
            'libelle' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}
