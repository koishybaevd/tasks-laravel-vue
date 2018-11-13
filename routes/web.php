<?php

Route::prefix('api')->group(function () {
    Route::get('/tasks', 'TaskController@index');
    Route::post('/tasks', 'TaskController@store');
    Route::post('/tasks/{task}/toggle', 'TaskController@toggle');
    Route::delete('/tasks/{task}', 'TaskController@destroy');
});

Route::get('/{vue_capture?}', function () {
    return view('app');
})->where('vue_capture', '[\/\w\.-]*');