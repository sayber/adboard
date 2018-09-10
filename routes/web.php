<?php

Route::get('/user/create','UserController@userRegForm');
Route::get('/login','UserController@userLogForm');

Route::post('/user','UserController@store');
Route::post('/login','AuthController@userLogin');
Route::get('/logout','AuthController@logout')->name('logout');
Route::get('/profile/{user}','UserController@userProfile')->name('user.edit');
Route::put('/update/user/{id}','UserController@userUpdated')->name('user.update');

Route::get('/','AdvController@index');

Route::post('/rank/{id}','UserController@rating')->name('rank');
Route::post('/comment/add','CommentsController@store')->name('comments.add');

Route::get('/board/create','AdvController@create');
Route::post('/board','AdvController@store');
Route::put('/board/{id}','AdvController@update')->name('board.update');
Route::delete('/board/{id}','AdvController@delete')->name('board.destroy');

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
});