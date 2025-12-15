<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;




Route::prefix('auth')->group(function(){
    Route::post('/login', [LoginController::class,'login']);
    Route::post('/register',[LoginController::class,'register']);
});

Route::middleware('jwt.bearer')->group(function(){
    Route::prefix('usuarios')->group(function(){
        Route::get('/',[UsuarioController::class,'Listar']);
        Route::post('/',[UsuarioController::class,'Guardar']);
        Route::put('/{c_id}',[UsuarioController::class,'Actualizar']);

    });

    Route::prefix('task')->group(function(){
        Route::get('/Listar', [TaskController::class,'Listar']);
        Route::post('/Guardar',[TaskController::class,'Guardar']);
        Route::put('/Actualizar/{id}',[TaskController::class,'Actualizar']);
        Route::delete('/Eliminar/{id}',[TaskController::class,'Eliminar']);
        Route::put('/Recuperar/{id}',[TaskController::class,'Recuperar']);
    });

    Route::prefix('common')->group(function(){
        Route::get('/statusSelect', [CommonController::class,'StatusSelect']);
        Route::get('/prioritySelect',[CommonController::class,'PrioritySelect']);
    });
});