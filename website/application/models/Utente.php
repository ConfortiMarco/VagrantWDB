<?php

use Illuminate\Database\Eloquent\Model;
class Utente extends Model {
    protected $table = 'utente';
    public $timestamps = false;

    public function fatture(){
        return $this->hasMany(Fattura::class);
    }

    public function apparecchielettronici(){
        return $this->belongsToMany(ApparecchioElettronico::class, 'apparecchioelettronico_dipendente', 'utente_id', 'apparecchioelettronico_id')->withPivot('ore_lavoro');
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = hash('sha256', $value);
    }

}