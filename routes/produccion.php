<?php

    Route::prefix('/produccion')->group(function(){
        Route::get('/','Produccion\DashboardController@getDashboard');








});
