<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
    Route::get('/', function () {
        if(Auth::guest())
            return view('welcome');
        else
            redirect('home');
    });

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/', function () {
        if(Auth::guest())
            return view('welcome');
        else
            return redirect('home');
    });

    Route::auth();
    Route::get('/home', 'HomeController@index');

    Route::get('/calendar',['middleware'=>'auth',function(){
        //echo 'get method calendar';

        return view('calendar/calendar');
    }]);

/**/
    Route::get('/events', 'EventController@index');
    Route::post('/event', 'EventController@store');
    Route::delete('/event/{event}', 'EventController@destroy');

    //Route::get('/event/{event}/edit','EventController@edit')
/*
Route::get('/events', 'EventController@index');
    Route::resource('event', 'EventController',
        ['names'=> ['index' => 'events.index']]);
*/    
    });
