<?php
use Illuminate\Database\Eloquent\Model;
class Fattura extends Model
{
    protected $table = 'fattura';
    public $timestamps = false;

    public function utente(){
        return $this->belongsTo(Utente::class);
    }

    public function apparecchioelettronico()
    {
        return $this->belongsTo(ApparecchioElettronico::class);
    }

}