<?php
use Illuminate\Database\Eloquent\Model;
class ApparecchioElettronico extends Model
{
    protected $table = 'apparecchioelettronico';
    public $timestamps = false;

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function componenti(){
        return $this->belongsToMany(Componente::class, 'apparecchioelettronico_componente', 'apparecchioelettronico_id', 'componente_id')->withPivot('quantita');
    }

    public function dipendenti(){
        return $this->belongsToMany(Utente::class, 'apparecchioelettronico_dipendente', 'apparecchioelettronico_id', 'utente_id')->withPivot('ore_lavoro');
    }

    public function fattura()
    {
        return $this->hasOne(Fattura::class);
    }

}