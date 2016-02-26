<?php
/**
|--------------------------------------------------------------------------
| Route group for authenticated users only.
|--------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['auth.admin']], function() {
        Route::group(['prefix' => 'backup-management/'], function() {
            Route::get('start-backup', '\Klsandbox\BackupManagement\Http\Controllers\BackupManagementController@start');
            Route::get('list/all', '\Klsandbox\BackupManagement\Http\Controllers\BackupManagementController@index');
            Route::get('view/{id}', '\Klsandbox\BackupManagement\Http\Controllers\BackupManagementController@show');
            Route::get('mark-as/deleted/{path}', '\Klsandbox\BackupManagement\Http\Controllers\BackupManagementController@delete');
            Route::get('mark-as/synced/{path}', '\Klsandbox\BackupManagement\Http\Controllers\BackupManagementController@synced');
        });
    });
});
