<?php

namespace App;

use App\Nivel;
use App\Tipo;
use Illuminate\Database\Eloquent\Model;

class NivelTipo extends Model
{
    protected $table='nivel_tipo';
    protected $fillable=['nivel_id', 'tipo_id'];

    // protected $append=['nivel', 'tipo'];

    // public function setNivelAttribute()
    // {
    // 	return Nivel::findOrFail($this->nivel_id)->first();
    // }
    // public function setTipoAttribute()
    // {
    //     return Tipo::findOrFail($this->tipo_id)->first();
    // }
    public function getWnivelAttribute()
    {
        $nivel = Nivel::findOrFail($this->nivel_id);
        return $nivel->wnivel;
    }
}
