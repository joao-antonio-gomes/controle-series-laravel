<?php

namespace App;

use App\BaseModel;

class Serie extends BaseModel
{
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
