<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $app->get('/', function () use ($app) {
//     return $app->app->version();
// });



$app->group(['prefix' => 'api/v1'], function() use ($app) {
    $app->get('/wisata/list', 'WisataController@getList');
    $app->get('/wisata/top/{num}', 'WisataController@getTop');
    $app->get('/wisata/{wisataId}', 'WisataController@getOne');
    $app->get('/wisata/category/{namaKategori}', 'WisataController@getListByKategori');

    $app->get('/berita/list', 'Controller@getListBerita');
    $app->get('/berita/{beritaId}', 'Controller@getBerita');
    
    $app->get('/event/list/nearby', 'Controller@getListNearbyEvent');
    $app->get('/event/list', 'Controller@getListEvent');
    $app->get('/event/{eventId}', 'Controller@getEvent');
    $app->get('/event/at/{date}', 'Controller@getEventByDate');


    $app->get('/komentar/{wisataId}', 'KomentarController@listByWisata');
    $app->post('/komentar/{wisataId}/create', 'KomentarController@create');

    $app->get('/search/{keyword}', 'Controller@search');
    $app->get('/search/tag/{keyword}', 'Controller@searchTag');
    $app->get('/info/list', 'Controller@listInfo');
    $app->get('/info/{year}', 'Controller@getInfo');
    $app->get('/about/list', 'Controller@getAboutList');
    $app->get('/about', 'Controller@getAbout');
});

