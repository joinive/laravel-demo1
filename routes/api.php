<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//
//Route::get('/doc',function (Request $request, Response $response) {
//    $openapi = \OpenApi\scan(app_path('Http/Controllers'));
////    $request->headers->set('Content-Type','application/x-yaml');
////    return $openapi->toYaml();
//
//    response($openapi->toYaml(),200)->withHeaders(['Content-Type'=>'application/x-yaml']);
//
////    return response($openapi->toYaml(), 200)->header('Content-Type', 'application/x-yaml');
//
//
//});

Route::get('/test1', function (Request $request, Response $response) {
    //return response()->make( 'aaa');
    return response('asdfsd',200);
});

Route::get('/test1', function (Request $request, Response $response) {
    //return response()->make( 'aaa');
    return response('aaaaaaaaaa',200);

});
Route::get('/test2', function (Request $request, Response $response) {
    return response('bbbbbbb',200);
});