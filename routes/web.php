<?php

Route::get('/', 'MainController@index')->name('main');


Route::group(['prefix' => 'film'], function () {
    Route::get('/', 'FilmController@index')->name('film.index');
    Route::get('/getFilm', 'FilmController@getFilm')->name('film.get');
});
