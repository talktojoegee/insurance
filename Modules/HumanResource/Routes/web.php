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
    Route::post('/employee/account-status', 'EmployeeController@updateEmployeeAccountStatus')->name('update-employee-account-status');
    Route::post('/change-profile-picture', 'EmployeeController@changeProfilePicture')->name('change-profile-picture');
    Route::post('/change-password', 'EmployeeController@changePassword')->name('change-password');
    Route::post('/employee/edit-profile', 'EmployeeController@editEmployeeProfile')->name('edit-employee-profile');

    Route::get('/manage-roles', 'ManageRolesAndPermissionsController@showManageRoles')->name('manage-roles');
    Route::post('/update-role-permissions', 'ManageRolesAndPermissionsController@updateRolePermissions')->name('update-role-permissions');
    Route::post('/edit-permission', 'ManageRolesAndPermissionsController@editPermission')->name('edit-permission');
    //Route::get('/manage-roles-and-permissions', 'ManageRolesAndPermissionsController@index');
    #Route::get('/manage-roles-and-permissions', 'ManageRolesAndPermissionsController@index');

    Route::get('/assign-permission/{id}', 'ManageRolesAndPermissionsController@showAssignPermissionToRole');
    Route::post('/assign-permissions', 'ManageRolesAndPermissionsController@assignPermissionToRole');
});
