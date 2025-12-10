<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::prefix('usuarios')->middleware('jwt.bearer')->group(function(){
    Route::get('/',[UsuarioController::class,'Listar']);
    Route::post('/',[UsuarioController::class,'Guardar']);
    Route::put('/{c_id}',[UsuarioController::class,'Actualizar']);

});

Route::prefix('auth')->group(function(){
    Route::post('/login', [LoginController::class,'login']);
    Route::post('/register',[LoginController::class,'register']);
});

Route::middleware('jwt.bearer')->group(function () {
    Route::get('/perfil', function () {
        return response()->json(["message" => "OK LOGUEADO"]);
    });
    
});