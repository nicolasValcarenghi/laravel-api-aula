<?php

use App\Http\Controllers\PeopleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'OK'
    ]);
});

Route::get('/somar', function(Request $request) {
    // Não está chegando nada pela request
    if (count($request->all()) < 1) {
        return response()->json([
            'message' => 'Não há valores para somar.'
        ], 406);
    }

    $soma = array_sum($request->all());
    return response()->json([
        'message' => 'Somado com sucesso', // Opcional
        'sum' => $soma,
    ]);
});

route::prefix('/people')->group(function(){
    route::get('/list', 
    [PeopleController::class, 'list']
);

Route::post('/store',
[PeopleController::class, 'store']);
});
