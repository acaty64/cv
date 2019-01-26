<?php

use App\Academico;
use App\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/edit', function () {
    return view('cv.edit');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/upload',function(Request $request){
    $uploadedFile = $request->doc;
	$path = Storage::put('documentos', $uploadedFile);
    if(Storage::exists($path)){
		$status = true;
    }else{
		$status = false;
    }
    return response(['status'=>$status, 'path'=>$path],200);
});