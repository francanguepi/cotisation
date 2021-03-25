<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Membre;


class Cotisation extends Model
{
    public $timestamps = false;

    public function membres()
    {
        return $this->belongsToMany(Membre::class);
    }
}
