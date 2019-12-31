<?php

Route::get('/', 'MainController@index')->name('main');


Route::group(['prefix' => 'film'], function () {
    Route::get('/', 'ScraperController@index')->name('film.index');
});
