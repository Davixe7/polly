<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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

Route::get('/', function(){
  $surveys = App\Survey::with('choices')->limit(10)->get();
  return view('landing', compact('surveys'));
})->name('landing');

Route::get('search', 'SurveyController@search')->name('search');

Route::get('home', 'HomeController@index')->name('home');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function(){
  Route::post('choices/storeList', 'Admin\ChoiceController@storeList');
  Route::get('choices/deleteAll', 'Admin\ChoiceController@deleteAll')->name('choices.deleteAll');
  Route::get('surveys/deleteAll', 'Admin\SurveyController@deleteAll')->name('surveys.deleteAll');
  Route::resource('surveys', 'Admin\SurveyController');
  Route::resource('choices', 'Admin\ChoiceController');
  Route::resource('banners', 'Admin\BannerController');
  Route::post('updateLogo', 'Admin\DashboardController@updateLogo')->name('updateLogo');
  Route::post('siteconfig', 'Admin\FrontendController@store');
  Route::put('update-credentials', 'Admin\UserController@update');
});

Route::get('/surveys', 'SurveyController@index')->name('surveys.index');
Route::get('/surveys/{slug}/results', 'SurveyController@results')->name('surveys.results');
Route::get('/surveys/{slug}/vote', 'SurveyController@vote')->name('surveys.vote');
Route::post('/votes', 'VoteController@store')->name('votes.store');
Auth::routes();