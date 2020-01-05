<?php

Route::get('/', 'MainController@index')->name('main');


Route::group(['prefix' => 'film'], function () {
    Route::get('/', 'FilmController@index')->name('film.index');
    Route::post('/', 'FilmController@getFilm')->name('film.getFilm')->middleware('ajax');
    Route::post('/search', 'FilmController@searchFilm')->name('film.search')->middleware('ajax');
    Route::post('/{film?}', 'FilmController@getDetailFilm')->name('film.getDetailFilm')->middleware('ajax');
});

Route::group(['prefix' => 'shortlink'], function() {
    Route::get('/', 'ShortLinkController@index')->name('shortlink.index');
    Route::get('/{short_link}', 'ShortLinkController@to')->name('shortlink.to');
});
