<?php
// app/routes.php

Route::get('/', function () {
    return View::make('index');
});

Route::group(array('prefix' => 'api'), function () {

    Route::resource(
        'videos',
        'VideoController',
        array(
            'only' => array(
                'index',
                'store',
                'update',
                'destroy',
            )
        )
    );

    Route::resource(
        'tags',
        'TagController',
        array('only' => array('index'))
    );
});

App::missing(function ($exception) {
    return View::make('index');
});
