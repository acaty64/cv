<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/cv/academico/load/{user_id}', [
	'as'	=> 'academico.load',
	'uses'	=> 'Api\cv\AcademicoController@load'
]);

Route::post('/cv/academico/save', [
	'as'	=> 'academico.save',
	'uses'	=> 'Api\cv\AcademicoController@save'
]);

Route::post('/cv/academico/destroy', [
	'as'	=> 'academico.destroy',
	'uses'	=> 'Api\cv\AcademicoController@destroy'
]);

Route::post('/upload',function(Request $request){
    $uploadedFile = $request->doc;
	$path = Storage::put('public/'.$request->tipo, $uploadedFile);
    if(Storage::exists($path)){
		$status = true;
    }else{
		$status = false;
    }
    return response(['status'=>$status, 'path'=>$path],200);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

