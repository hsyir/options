<?php

Route::namespace('\Hsy\Options\Controllers')
    ->prefix('admin/options')
    ->as('admin.options.')
    ->middleware("web",'admin')
    ->group(function () {
        Route::get('/siteOptions', "SiteOptionsController@index")->name('siteOptions');
        Route::post('/siteOptions', "SiteOptionsController@store")->name('siteOptions.store');
    });