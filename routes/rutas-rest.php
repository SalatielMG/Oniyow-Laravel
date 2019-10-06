<?php

Route::group(['prefix' => 'api-rest'], function (){
    Route::resource('productoOniyow','ControlProductoREST');
});

