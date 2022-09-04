<?php

    Route::prefix('/bodega')->group(function(){
        Route::get('/','Bodega\DashboardController@getDashboard');








});



