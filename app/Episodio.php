<?php

namespace App;

use App\BaseModel;

class Episodio extends BaseModel
{
    protected $fillable = ['numero'];
    public $timestamps = false;

    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
