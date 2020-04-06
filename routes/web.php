<?php

use App\User;

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

Route::get('/all-users', function () {
    return User::whereHas("roles", function($q){ $q->where("name", "fulfiller"); })->get();
});

Route::get('/api/v1/get-remaining-time', 'CoeController@getRemainingTime');

Route::get('/', function () {
    return view('welcome');
});

// COE API 
// Route::get('/user', 'CoeController@index2');
// Route::get('/self-service', 'CoeController@index2');
// Route::get('/orig-sig', 'CoeController@index2');

Route::get('/coe', 'CoeController@index');
Route::get('/coe/{coe_code}', 'CoeController@index');

Route::post('/auth1', 'LoginController@login');
Route::post('/verifyOTP', 'OtpController@verify');

Auth::routes();

Route::group(['middleware'=>'auth'], function(){


Route::get('/','LoginController@logout');
Route::get('/logout','LoginController@logout');
Route::get('/home','LoginController@logout');
Route::get('/index','LoginController@logout');

Route::get('/self-service/{id}','CoeController@index');
Route::get('/original-signature/{id}','CoeController@index');
Route::get('/original-signature/details/{id}','CoeController@coe_details');
 
// fulfiller
Route::get('/assigned-to-me/{id}','CoeController@index');
Route::get('/assigned-to-me/details/{id}','CoeController@coe_details');

Route::get('/all-request/{id}','CoeController@index');
Route::get('/walk-in/{id}','CoeController@index');
Route::get('/otp/{id}', 'OtpController@index');
Route::get('/coe-details/{id}','CoeController@coe_details');
Route::get('/coe-details-admin/{id}','CoeController@coe_details_admin');

// COE API
Route::get('/coe', 'CoeController@index');
Route::get('/coe/{coe_code}', 'CoeController@index');

Route::get('/api/v1/coe', 'CoeController@show');
Route::get('/api/v2/coe', 'CoeController@show_dtables');
Route::get('/api/v3/coe', 'CoeController@show_dtables3');

Route::post('/api/v1/coe/store', 'CoeController@store');
Route::post('/api/v1/coe/update', 'CoeController@store');

Route::get('/api/v1/get-remaining-time', 'CoeController@getRemainingTime');
Route::get('/api/v1/get-encrypted', 'CoeController@getEncrypted');
Route::get('/api/v2/get-encrypted', 'CoeController@encrypt');


// Route::get('/employee/report/pdf', 'ExportToPdfController@export');
// Route::get('/print/envelope/{transactionItemCode}', 'ExportToPdfController@export');
Route::get('/print/coe/{coeCode}', 'ExportToPdfController@export');
Route::get('/original-signature/print/{coeCode}', 'PrintPdfOrigSigController@export');
// Route::get('/print/coe/123', 'ExportToPdfController@export');
// Route::get('/export-employees','ExportToExcelController@exportEmployees')->name('exports.employees');
// Route::get('/export-transactions','ExportToExcelController@exportTransactions')->name('exports.transactions');
// Route::get('/export-transaction-items/{transactionCode}','ExportToExcelController@exportTransactionItems')->name('exports.transactionitems');
// Route::get('/transaction/export-excel','TransactionsController@exportTransaction')->name('exports.transactions');

// Statatus Items API
Route::get('/api/v1/status-items', 'StatusItemsController@show');
Route::get('/api/v1/types', 'TypesController@show');
Route::get('/api/v1/purposes', 'PurposesController@show');

Route::group(['middleware' => ['role:fulfiller|admin']], function () {
    // COE Types API
    Route::get('/types', 'TypesController@index');
    Route::get('/purposes', 'PurposesController@index');

    // Employees API
    Route::get('/api/v1/employees', 'EmployeesController@show');
    Route::get('/api/v2/employees', 'EmployeesController@show2');

    // Audits API
    Route::get('/audits', 'AuditsController@index');
    Route::get('/api/v1/audits', 'AuditsController@show');
    Route::get('/api/v2/audits', 'AuditsController@show_dtables');

    // Statatus Items API
    Route::post('/api/v1/status-item/store', 'StatusItemsController@store');
});

Route::group(['middleware' => ['role:admin']], function () {

    // Types API
    Route::get('/type/{type_code}', 'TypesController@index');
    Route::get('/type/{type_code}/edit', 'TypesController@index');
    Route::get('/type/{type_code}/delete', 'TypesController@index');

    Route::post('/api/v1/type/store', 'TypesController@store');
    Route::post('/api/v1/type/update', 'TypesController@update');
    Route::post('/api/v1/type/remove', 'TypesController@remove');

    // Purposes API
    Route::get('/purpose/{purpose_code}', 'PurposesController@index');
    Route::get('/purpose/{purpose_code}/edit', 'PurposesController@index');
    Route::get('/purpose/{purpose_code}/delete', 'PurposesController@index');

    Route::post('/api/v1/purpose/store', 'PurposesController@store');
    Route::post('/api/v1/purpose/update', 'PurposesController@update');
    Route::post('/api/v1/purpose/remove', 'PurposesController@remove');
 
    // COE Admins API
    Route::get('/admins', 'AdminsController@index');
    Route::get('/admin/{purpose_code}', 'AdminsController@index');
    Route::get('/admin/{purpose_code}/edit', 'AdminsController@index');
    Route::get('/admin/{purpose_code}/delete', 'AdminsController@index');

    Route::get('/api/v1/admins', 'AdminsController@show');
    Route::post('/api/v1/admin/store', 'AdminsController@store');
    Route::post('/api/v1/admin/update', 'AdminsController@update');
    Route::post('/api/v1/admin/remove', 'AdminsController@remove');

    // COE Roles API
    Route::get('/roles', 'RolesController@index');
    Route::get('/role/{role_code}', 'RolesController@index');

    Route::get('/api/v1/roles', 'RolesController@show');
    Route::post('/api/v1/role/assign-permission', 'RolesController@store');
    Route::post('/api/v1/role/revoke-permission', 'RolesController@remove');

    // COE Permissions API
    Route::get('/permissions', 'PermissionsController@index');
    Route::get('/permission/{permission_code}', 'PermissionsController@index');
    Route::get('/permission/{permission_code}/edit', 'PermissionsController@index');
    Route::get('/permission/{permission_code}/delete', 'PermissionsController@index');

    Route::get('/api/v1/permissions', 'PermissionsController@show');
    Route::post('/api/v1/permission/store', 'PermissionsController@store');
    Route::post('/api/v1/permission/remove', 'PermissionsController@remove');

    
});

// Route::post('/api/v1/status-item/store', 'StatusItemsController@store');
 
});

// Route::post('/api/v1/status-item/store', 'StatusItemsController@store');

Route::get('/isActive', 'TypesController@checkActive');

Route::get('/sampleRandom', 'OtpController@sampleRandom');