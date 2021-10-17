<?php

namespace App;

use App\BaseModel;
use Illuminate\Database\Eloquent\Collection;

class Temporada extends BaseModel
{
    protected $fillable = ['numero'];
    public $timestamps = false;

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function getEpisodiosAssistidos(): Collection
    {
        return $this->episodios->filter(function (Episodio $episodio) { return $episodio->assistido; });
    }
}
