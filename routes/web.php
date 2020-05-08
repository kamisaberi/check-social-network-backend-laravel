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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/groups/get1/{creator}' , "GroupController@getDutiesAndGroups")->name('groups.get.groups1');
//Route::get('/groups/get2/{creator}' , "GroupController@getDuties2")->name('groups.get.groups2');
//Route::get('/groups/get3/{creator}' , "GroupController@getDuties3")->name('groups.get.groups3');
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/login/{phone}/{password}/{time}', "UserController@login")->name('users.login');
Route::get('/users/fcm_token/change/{user}/{fcm_token}/{time}', "UserController@changeFcmToken")->name('users.login');
Route::get('/users/get/{user}/{time}', "UserController@getUser")->name('users.get');
Route::post('/users/registered', "UserController@getRegisteredUsers1")->name('users.get.registered');


Route::post('/upload', "UserController@uploadImage")->name('users.upload');
Route::get('/remove/image/{user}/{time}', "UserController@removeImage")->name('users.remove');
Route::get('/verify/{phone}/{verification_code}/{time}', "UserController@verify")->name('users.verify');
Route::post('/register', "UserController@register")->name('users.register');
Route::post('/profile/edit', "UserController@editProfile")->name('users.edit.profile');


Route::get('/duties/get/{creator}/{time}', "DutyController@getDuties")->name('duties.get.duties');
Route::get('/duties/get/one/{duty}/{time}', "DutyController@getDuty")->name('duties.get.one.duty');
Route::get('/duties/finish/{user}/{duty}/{finish_type}/{time}', "DutyController@finishDuty")->name('duties.finish');
Route::post('/duties', "DutyController@store")->name('duties.store');
Route::post('/duties/edit', "DutyController@update")->name('duties.update');


Route::get('logs/{duty}/{time}', "LogController@getLogs")->name('logs.get.logs');
Route::post('logs', "LogController@store")->name('logs.store');


Route::get('/records/{record_type}/{duty}/{time}', "RecordController@getRecords")->name('records.get');
Route::post('/records/{record_type}', "RecordController@store")->name('records.store');




//Route::get('/users/registered/{user}/{phones}' , "UserController@getRegisteredUsers")->name('users.get.registered');

Route::get('/friends/get/{id}/{time}', "FriendController@getFiendListForUser")->name('friends.get');
Route::get('/friends/get/username/{username}/{time}', "FriendController@getFiendListForUserUsingUsername")->name('friends.get.username');
Route::post('/friends/change', "FriendController@changeFriendshipSituation")->name('friends.change');
Route::post('/friends/add', "FriendController@addFriendship")->name('friends.add');
Route::post('/friends/remove', "FriendController@removeFriendship")->name('friends.remove');




//Route::post('/groups/update', "GroupController@update")->name('groups.store');
Route::get('/groups/get/{creator}/{time}', "DutyController@getDutiesAndGroups")->name('groups.get.groups');
Route::get('/groups/just/get/{creator}/{time}', "GroupController@getGroups")->name('groups.get.groups.names');
Route::get('/groups/remove/{id}/{time}', "GroupController@remove")->name('groups.remove');
Route::post('/groups', "GroupController@store")->name('groups.store');


Route::post('/messages', "MessageController@store")->name('messages.store');
Route::get('/messages/get/{duty}/{date}/{time}', "MessageController@getMessages")->name('messages.get');


Route::get('/experts/get/all/{time}', "ExpertController@getAll")->name('experts.get.all');


Route::get('/test', "UserController@test")->name('users.test');
//  eWBBvTkRO7k:APA91bHFZew7aNOTS9fYCms3Kg7iAhdSjIW4Q0mQx9-Cs1g7-uALAaq7cSh0Ow2ksB0urBQvUeHJ4Ah1zsKMRS9Uq_8tFTCqnGZ9texNAt9JIINsLjE8wvgFyPFE8lyHU0vNe00XmQjv
