<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPHtmlParser\Dom;
use App\Http\Controllers\ThanaweyaResultsController;

//use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {
    return view('results');
});
Route::post('/get-natega', [ThanaweyaResultsController::class,'getNatega']);


Route::get('/get-result', function (Request $request) {
    $res = Http::asForm()->post('https://g12.emis.gov.eg/',[
        'SeatingNo'=>"336852"
    ])->body();
    $dom = new Dom;
    $dom->loadStr($res );
    $token= $dom->find('input')[0]->getAttribute('value');
    $res = Http::asForm()->post('https://g12.emis.gov.eg/',[
        'SeatingNo'=>$request->seeting_no,
        '__RequestVerificationToken'=>$token,
    ])->body();

    return $res;

    dd($res);
    $dom_loaded = new Dom;
    $dom_loaded->loadStr($res);
    dd($dom_loaded->find('input')[0]);
    $result = $dom_loaded->find('input')[0];
    dd($result);

})->name('get-result');