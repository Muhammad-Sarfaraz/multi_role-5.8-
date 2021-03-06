<?php
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function (){
    Route::get('dashboard','AdminController@index')->name('admin.dashboard');

});

Route::group(['prefix'=>'author','middleware'=>['auth','author']], function (){
    Route::get('dashboard','AuthorController@index')->name('author.dashboard');

});


Route::get('/verify_user/dashboard', function () {

    if (Auth::check() && Auth::user()->role->id == 1)
    {
       return redirect('/admin/dashboard');
    } else {
        return redirect('/author/dashboard');
    }
    
});