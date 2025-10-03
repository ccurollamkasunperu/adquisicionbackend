<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AdquisicionController;
use App\Http\Controllers\FilePreviewController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('login', [AuthController::class, 'login']);
    Route::post('me', [AuthController::class, 'userProfile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::post('/files/base64-from-path', [FilePreviewController::class, 'base64FromPath'])->name('files.base64FromPath');    

    Route::prefix('area')->group(function () {
        Route::post('areadenominacionsel', [AreaController::class, 'areadenominacionsel']);
    });

    Route::prefix('adquisicion')->group(function () {
        Route::post('estadoordensel', [AdquisicionController::class, 'estadoordensel']);
        Route::post('estadosiafsel', [AdquisicionController::class, 'estadosiafsel']);
        Route::post('tipobiensel', [AdquisicionController::class, 'tipobiensel']);
        Route::post('tipobiencontrolsel', [AdquisicionController::class, 'tipobiencontrolsel']);
        Route::post('entregatipodocumentosel', [AdquisicionController::class, 'entregatipodocumentosel']);
        Route::post('entregaordinalsel', [AdquisicionController::class, 'entregaordinalsel']);
        Route::post('proveedorsel', [AdquisicionController::class, 'proveedorsel']);
        Route::post('ordensel', [AdquisicionController::class, 'ordensel']);
        Route::post('entregasel', [AdquisicionController::class, 'entregasel']);
        Route::post('entregagra', [AdquisicionController::class, 'entregagra']);
        Route::post('proveedorgra', [AdquisicionController::class, 'proveedorgra']);
        Route::post('ordenmig', [AdquisicionController::class, 'ordenmig']);
        Route::post('ordenupd', [AdquisicionController::class, 'ordenupd']);
    });

    Route::prefix('seguridad')->group(function () {    
        Route::post('permisoobjetosel', [SeguridadController::class, 'permisoobjetosel']);
        Route::post('perfilusuarioapp', [SeguridadController::class, 'perfilusuarioapp']);
        Route::post('perfilusuarioobjetosel', [SeguridadController::class, 'perfilusuarioobjetosel']);
    });
});
