<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cotisation;

class Membre extends Model
{
    public $timestamps = false;

    public function cotisations()
    {
        return $this->belongsToMany(Cotisation::class);
    }
}
