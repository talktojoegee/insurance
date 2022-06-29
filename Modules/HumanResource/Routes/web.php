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

Route::prefix('human-resource')->group(function() {
    Route::get('/', 'EmployeeController@index');
    Route::get('/add-new-employee', 'EmployeeController@addNewEmployee');
    Route::post('/add-new-employee', 'EmployeeController@onboardNewEmployee');
    Route::get('/settings', 'GeneralSettingsController@settings');
    Route::post('/add-new-department', 'GeneralSettingsController@addNewDepartment');
    Route::post('/add-new-job-role', 'GeneralSettingsController@addNewJobRole');
    Route::post('/add-new-employment-type', 'GeneralSettingsController@addNewEmploymentType');
    Route::post('/add-new-academic-qualification', 'GeneralSettingsController@addNewAcademicQualification');
    Route::post('/application/role', 'GeneralSettingsController@applicationRole');
    Route::post('/application/edit-role', 'GeneralSettingsController@editApplicationRole');
    Route::post('/application/permission', 'GeneralSettingsController@applicationPermission');
    Route::post('/application/edit-permission', 'GeneralSettingsController@editApplicationPermission');
    Route::get('/employee/profile/{url}', 'EmployeeController@profile')->name('employee-profile');
    Route::get('/employee/settings/{url}', 'EmployeeController@settings')->name('employee-settings');
    Route::get('/manage-roles-and-permissions', 'ManageRolesAndPermissionsController@index');
    Route::get('/assign-permission/{id}', 'ManageRolesAndPermissionsController@showAssignPermissionToRole');
    Route::post('/assign-permissions', 'ManageRolesAndPermissionsController@assignPermissionToRole');
});
