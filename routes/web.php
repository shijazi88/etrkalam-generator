<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Participants
    Route::delete('participants/destroy', 'ParticipantsController@massDestroy')->name('participants.massDestroy');
    Route::resource('participants', 'ParticipantsController');

    // Voice Records
    Route::delete('voice-records/destroy', 'VoiceRecordsController@massDestroy')->name('voice-records.massDestroy');
    Route::post('voice-records/media', 'VoiceRecordsController@storeMedia')->name('voice-records.storeMedia');
    Route::post('voice-records/ckmedia', 'VoiceRecordsController@storeCKEditorImages')->name('voice-records.storeCKEditorImages');
    Route::resource('voice-records', 'VoiceRecordsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Competitions
    Route::delete('competitions/destroy', 'CompetitionsController@massDestroy')->name('competitions.massDestroy');
    Route::resource('competitions', 'CompetitionsController');

    // Referee
    Route::delete('referees/destroy', 'RefereeController@massDestroy')->name('referees.massDestroy');
    Route::resource('referees', 'RefereeController');

    // Country
    Route::delete('countries/destroy', 'CountryController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountryController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
