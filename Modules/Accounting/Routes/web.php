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

Route::prefix('accounting')->group(function() {
    Route::get('/', 'AccountingController@index');
    Route::post('/get-parent-account', 'AccountingController@getParentAccount');
    Route::post('/save-account', 'AccountingController@saveAccount');
    Route::get('/journal-voucher', 'AccountingController@journalVoucher');
    Route::get('/new-journal-voucher', 'AccountingController@newJournalVoucher');
    Route::get('/account-settings', 'AccountingController@accountSettings');
    Route::post('/account-settings', 'AccountingController@setDefaultAccounts');
    #Receipt routes
    Route::get('/receipts', 'AccountingController@receipts');
    Route::get('/generate-receipt', 'AccountingController@showGenerateReceipt');
    Route::post('/generate-receipt', 'AccountingController@storeReceipt');
    Route::post('/get-debit-note-details', 'AccountingController@getDebitNoteDetails');
    #Report routes
    Route::get('/trial-balance', 'AccountingController@trialBalanceView');
    Route::post('/trial-balance', 'AccountingController@trialBalance');
    Route::get('/balance-sheet', 'AccountingController@balanceSheetView');
    Route::post('/balance-sheet', 'AccountingController@balanceSheet');
    Route::get('/profit-or-loss', 'AccountingController@profitOrLossView');
    Route::post('/profit-or-loss', 'AccountingController@profitOrLoss');
});
