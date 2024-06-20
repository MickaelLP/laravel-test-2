<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ["libelle", "description"];

    public function element(){
        return $this->hasMany(Element::class)->orderBy('libelle','desc');;
    }
}
