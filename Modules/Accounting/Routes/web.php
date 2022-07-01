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
    Route::get('/', 'AccountingController@index')->name('chart-of-accounts');
    Route::post('/get-parent-account', 'AccountingController@getParentAccount');
    Route::get('/create-chart-of-account', 'AccountingController@showCreateChartOfAccount')->name('create-chart-of-account');
    Route::post('/save-account', 'AccountingController@saveAccount')->name('save-account');
    Route::get('/journal-voucher', 'AccountingController@journalVoucher')->name('manage-journal-voucher');
    Route::get('/new-journal-voucher', 'AccountingController@newJournalVoucher');
    Route::post('/new-journal-voucher', 'AccountingController@postJournalVoucher')->name('post-journal-entry');
    Route::get('/view-journal-entry/{ref_no}', 'AccountingController@viewJournalEntry')->name('view-journal-entry');
    Route::post('/process-journal-entry', 'AccountingController@processJournalEntry')->name('process-journal-entry');
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
