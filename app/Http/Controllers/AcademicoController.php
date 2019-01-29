<?php

namespace App\Http\Controllers;

use App\Academico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AcademicoController extends Controller
{
//     public function view($documento)
//     {
// // dd(asset('storage/app/documentos/'.$documento));
//         $file = storage_path('app/public/documentos/'.$documento);
//         if (File::isFile($file))
//         {
//             $archivo = 'storage/documentos/'.$documento;
//             return view('cv.view')
//                 ->with('documento', $archivo)
//                 ->with('modulo', 'Académico');
//         }else{
//             dd('No existe'.$file);
//         }
//     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function show(Academico $academico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function edit(Academico $academico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academico $academico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academico $academico)
    {
        //
    }
}
