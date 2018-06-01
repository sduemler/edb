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
use Intervention\Image\Facades\Image;

Route::get('file/photo/{filename}', ['middleware' => ['signedurl'], function ($filename) {
    return Image::make(storage_path('app/photo/' . $filename))->response();
}]);
Route::get('/docs', function() { return view('docs.index'); })->name('docs.index'); // documentation home page
Route::get('/docs/user', function() { return view('docs.user'); })->name('docs.user'); // user document page

Route::get('password/reset2', function() {
    return view('auth.passwords.reset2');
})->middleware('guest')->name('password.request2');

Route::get('file/audio/{filename}', ['middleware' => ['signedurl'], function ($filename) {
    $filename = storage_path('app/audio/' . $filename);
    $filesize = (int) File::size($filename);
    $extension = File::extension($filename);

    $file = File::get($filename);

    $response = Response::make($file, 200);
    $response->header('Content-Type', 'audio/' . $extension);
    $response->header('Content-Length', $filesize);
    $response->header('Accept-Ranges', 'bytes');
    $response->header('Content-Range', 'bytes 0-'.$filesize.'/'.$filesize);

    return $response;
}]);
Route::get('/', 'HomeController@index')->name('home.index'); // Show the application home page.

Route::get('/search', 'SearchController@result')->name('search.result'); // Display a list of search result
Route::get('/search/advancedSearch', 'SearchController@index')->name('search.index'); // Show advanced search page
Route::get('/species', 'SpeciesController@index')->name('species.index'); // Display a listing of the species.
Route::post('/warning', 'WarningController@index')->name('warning.index'); // Display a warning message and let user make choice

Auth::routes();
Route::get('/cas/login', 'CasController@index')->name('cas.index'); // Handle Miami Cas login
Route::post('/cas/logout', 'CasController@logout')->name('cas.logout'); // Handle Miami Cas logout

Route::group(['middleware' => ['auth', 'researcher', 'preventDeletedUser']], function () {
	Route::get('/species/approval', 'ApprovalController@index')->name('species.approval'); // Display a listing of the species records which are needed to approve.
	Route::post('/species/approve/{id}', 'ApprovalController@approve')->name('species.approval.approve'); // Approve a specified species record
	Route::post('/species/deny/{id}', 'ApprovalController@deny')->name('species.approval.deny'); // Deny a specified species record

});

Route::group(['middleware' => ['auth', 'contributor', 'preventDeletedUser']], function () {
	Route::post('/species', 'SpeciesController@store')->name('species.store'); // Store a newly created species in species table.
	Route::get('/species/create', 'SpeciesController@create')->name('species.create'); // Show the page for creating a new species.
	Route::delete('/species/{id}', 'SpeciesController@destroy')->name('species.destroy'); // Remove the specified species from species table.
	Route::put('/species/{id}', 'SpeciesController@update')->name('species.update'); // Update the specified species in species table.
	Route::get('/species/{id}/history/{key}', 'SpeciesController@history')->name('species.history'); // Display a listing of history for specified species and attribute.
	Route::get('/species/{id}/edit', 'SpeciesController@edit')->name('species.edit'); // Show the form for editing the specified species.
	Route::get('/request', 'RequestController@index')->name('request.index'); // Show request result page for contributors

});

Route::get('/species/{id}', 'SpeciesController@show')->name('species.show'); // Display the specified species by id.

Route::group(['middleware' => ['auth', 'preventDeletedUser']], function () {
	Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit'); // Show the form for editing user profile.
	Route::put('/user/{id}', 'UserController@update')->name('user.update'); // Update the user profile.

});

Route::group(['middleware' => ['auth', 'administrator', 'preventDeletedUser']], function () {
	Route::get('/user', 'UserController@index')->name('user.index'); // Display a listing of the users.
    Route::get('/user/create', 'UserController@create')->name('user.create'); // Display a page for administrators to create user
    Route::post('/user', 'UserController@store')->name('user.store'); // Store a newly created user in users table.
    Route::put('/user/{id}/editRole', 'UserController@updateRole')->name('user.update.role'); // Update role for specified user
	Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy'); // Remove the specified user from users table.
    Route::get('/user/restore/{id}', 'UserController@restore')->name('user.restore'); // Restore deleted user

    Route::get('/import', 'ImportController@index')->name('import.index'); // Show import page.
	Route::post('/import/upload', 'ImportController@upload')->name('import.upload'); // Show confirm page after uploading.
	Route::post('/import/process', 'ImportController@process')->name('import.process'); // Process uploaded file.
    Route::get('/import/createTemplate/{format}', 'ImportController@createTemplate')->name('import.createTemplate'); // Create template file for data import

    Route::get('/backup', 'BackupController@index')->name('backup.index'); // Display page for backup.
	Route::post('/backup', 'BackupController@store')->name('backup.store'); // Create new backup file.
	Route::delete('/backup', 'BackupController@destroy')->name('backup.destroy'); // Clean up old backup files depend on rules.
    Route::get('/docs/admin', function() { return view('docs.admin'); })->name('docs.admin'); // documentation for admin
});


