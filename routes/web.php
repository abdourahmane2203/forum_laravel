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

Route::get('/','TopicController@index')->name('topics.index');

//********* resource permet de mapper toutes routes d'un controller: /tipics/...
// sauf la methode index ==> except() *******//
Route::resource('topics', 'TopicController')->except(['index']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/comments/{topic}', 'CommentController@store')->name('comments.store');
Route::post('/commentReplay/{comment}', 'CommentController@storeCommentReply')->name('comments.storeReply');
