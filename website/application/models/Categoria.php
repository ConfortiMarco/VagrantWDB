<?php
use Illuminate\Database\Eloquent\Model;
class Categoria extends Model
{
    protected $table = 'categoria';
    public $timestamps = false;

    public function apparecchielettronici(){
        return $this->hasMany(ApparecchioElettronico::class);
    }
}