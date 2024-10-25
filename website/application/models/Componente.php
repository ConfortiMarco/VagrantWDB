<?php
use Illuminate\Database\Eloquent\Model;
class Componente extends Model
{
    protected $table = 'componente';
    public $timestamps = false;

    public function apparecchielettronici(){
        return $this->belongsToMany(ApparecchioElettronico::class, 'apparecchioelettronico_componente', 'componente_id', 'apparecchioelettronico_id')->withPivot('quantita');;
    }
}