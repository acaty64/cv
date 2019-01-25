<?php

namespace App;

use App\Competencia;
use App\Nivel;
use App\NivelTipo;
use Illuminate\Database\Eloquent\Model;

class Academico extends Competencia
{
    // protected $appends = ['descripcion', 'nivel'];
    protected $fillable  =    [   
    		'user_id',
            'titulo',
            'yini',
            'yfin',
            'documento',
            'verificado',
            'nivel_id'
        ];

    protected $appends = ['wnivel'];

    public function getWnivelAttribute()
    {
    	$tipo_id = 1;
    	$niveles = NivelTipo::where('tipo_id', $tipo_id)->get();
    	$xNivel = Nivel::findOrFail($this->nivel_id);
		return $xNivel->wnivel;
    }
    
}
