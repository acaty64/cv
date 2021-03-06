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
// return $request;
        if($request->id == 'new'){
            $item = new Academico;
            $item->user_id = $request->user_id;
            $item->name_file = $request->name_file;
            $item->documento = $request->documento;
        }else{
            $item = Academico::findOrFail($request->id);
        }

        $item->titulo = $request->titulo;
        $item->nivel_id = $request->nivel_id;
        $item->yini = $request->yini;
        $item->yfin = $request->yfin;

        $item->save();
        if(!$item->id){
            return ['success'=>false];
        }
        return ['success'=>true];
    }

    public function destroy(Request $request)
    {
        $item = $request->all();
        $id = $item['data']['id'];
        $academico = Academico::findOrFail($id);
        try {
            /* Elimina el archivo documento */
            $file = $academico->documento;
            $archivo = public_path('storage/academico/'.$file);
            unlink($archivo);
            /* Elimina el registro del archivo */
            $academico->delete();            
        } catch (Exception $e) {
            return ['success'=>false];
        }
        return ['success'=>true];
    }

}
