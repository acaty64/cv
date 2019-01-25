<?php

namespace App\Http\Controllers\Api\cv;

use App\Academico;
use App\Http\Controllers\Controller;
use App\Nivel;
use App\NivelTipo;
use Illuminate\Http\Request;

class AcademicoController extends Controller
{
    public function load($user_id)
    {
        $data = Academico::where('user_id', $user_id)->get();
        $nivelTipo = NivelTipo::where('tipo_id', '1')->get();
        $niveles = [];
        foreach ($nivelTipo as $key => $value) {
            array_push($niveles, ['nivel_id'=>$value->nivel_id, 'wnivel' => $value->wnivel]);
        }
        return [
                'success' => true,
                'datos' => $data,
                'niveles' => $niveles,
            ];
    }
    public function save(Request $request)
    {
        if($request->id == 'new'){
            $item = new Academico;
            $item->user_id = $request->user_id;
        }else{
            $item = Academico::findOrFail($request->id);
        }
        $item->titulo = $request->titulo;
        $item->nivel_id = $request->nivel_id;
        $item->documento = $request->documento;
        $item->yini = $request->yini;
        $item->yfin = $request->yfin;

        $item->save();

        return ['success'=>true];
    }

}
