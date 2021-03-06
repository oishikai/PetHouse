<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', 'HomeController@home')->name('home');
Auth::routes();
Route::get('/', 'HomeController@home')->name('home');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/search/{pet}/{key}', 'HomeController@search')->name('search');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/myPage', 'HomeController@myPage')->name('myPage');
    Route::get('/inquiry', 'HomeController@inquiry')->name('inquiry');

    Route::get('/questionnaire', 'HomeController@questionnaire')->name('questionnaire');
    Route::post('/confirmQuestionnaire', 'HomeController@confirmQuestionnaire')->name('confirmQuestionnaire');
    Route::post('/answerQuestionnaire', 'HomeController@answerQuestionnaire')->name('answerQuestionnaire');

    Route::get('/message', 'MessageController@message')->name('message');
    Route::get('/messageForm/{id}/{to}', 'MessageController@messageForm')->name('messageForm');
    Route::post('/sendMessage', 'MessageController@sendMessage')->name('sendMessage');
    Route::get('/messageDetail/{id}', 'MessageController@messageDetail')->name('messageDetail');

    Route::get('/article', 'ArticleController@article')->name('article');
    Route::post('/articleRegisterA', 'ArticleController@articleRegisterA')->name('articleRegisterA');
    Route::post('/articleRegisterB', 'ArticleController@articleRegisterB')->name('articleRegisterB');
    Route::post('/confirmArticle', 'ArticleController@confirmArticle')->name('confirmArticle');
    Route::post('/articleStore', 'ArticleController@articleStore')->name('articleStore');
    Route::get('/articleDetail/{id}', 'HomeController@articleDetail')->name('articleDetail');
    Route::get('/articleList', 'articleController@articleList')->name('articleList');
    Route::get('/articleDelete/{id}', 'articleController@articleDelete')->name('articleDelete');
    Route::get('/articleFavorite', 'articleController@articleFavorite')->name('articleFavorite');

    Route::get('/favorite/{id}', 'HomeController@favorite')->name('favorite');
});