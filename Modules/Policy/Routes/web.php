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

Route::get('/dashboard', 'PolicyController@dashboard')->name('dashboard');
Route::get('/dashboard-statistics', 'PolicyController@dashboardStatistics')->name('dashboard-chart');

Route::prefix('policy')->group(function() {
	#Policy
    Route::get('/', 'PolicyController@index');
    Route::get('/non-motor', 'PolicyController@nonMotor')->name('non-motor-policies');
    Route::get('/create', 'PolicyController@create');
    Route::post('/add-new-policy', 'PolicyController@store');
    Route::get('/motor', 'PolicyController@motor')->name('motor-policies');
    Route::get('/create-motor-policy', 'PolicyController@createMotorPolicy');
    Route::get('/view/policy/{slug}', 'PolicyController@viewPolicy');
    Route::post('/initialize-instance', 'PolicyController@initializeInstance');
    Route::post('/get-sub-business-classes', 'PolicyController@getSubBusinessClasses');

    #Debit Note
    Route::get('/debit-notes', 'DebitNoteController@index')->name('debit-notes');
    Route::get('/debit-note/new/{slug}', 'DebitNoteController@create');
    Route::post('/debit-note/new', 'DebitNoteController@storeNewDebitNote');
    Route::get('/debit-note/view/{slug}', 'DebitNoteController@view');
    #Credit Note
    Route::get('/credit-notes', 'CreditNoteController@index')->name('credit-notes');
    Route::get('/credit-note/new/{slug}', 'CreditNoteController@create');
    Route::post('/credit-note/new', 'CreditNoteController@storeNewCreditNote');
    Route::get('/credit-note/view/{slug}', 'CreditNoteController@view');
    #Constants
    Route::get('/policy-settings', 'PolicyController@policySettings');
    Route::post('/get/sub-classes', 'PolicyController@getSubClasses');
    Route::post('/agent/create', 'PolicyController@createAgent');
    Route::post('/agent/edit', 'PolicyController@editAgent');
    Route::post('/business-class/create', 'PolicyController@createBusinessClass');
    Route::post('/business-class/edit', 'PolicyController@editBusinessClass');
    Route::post('/sub-business-class/create', 'PolicyController@createSubBusinessClass');
    Route::post('/sub-business-class/edit', 'PolicyController@editSubBusinessClass');
    #Client
    Route::get('/clients', 'PolicyController@clients');
    Route::get('/add-client', 'PolicyController@showAddClientForm');
    Route::post('/add-client', 'PolicyController@storeClient');
    Route::get('/client/view/{slug}', 'PolicyController@getClient');

    #Claims
    Route::get('/claims', 'ClaimController@index')->name('claims');
    Route::get('/claim/new', 'ClaimController@create')->name('new-claim');
    Route::post('/claim/get-policies', 'ClaimController@getClientPolicies');
    Route::post('/claim/get-client-policy', 'ClaimController@getClientPolicy');
    Route::post('/claim/register-claim', 'ClaimController@storeClaim');
    Route::get('/claim/view/{slug}', 'ClaimController@viewClaim');
    Route::post('/claim/update-claim', 'ClaimController@updateClaimStatus');

    Route::get('/report/naicom', 'ReportController@showNaicomReport')->name('show-naicom-report');
});
