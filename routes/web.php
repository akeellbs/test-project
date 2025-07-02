<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ResultUploader;
use App\Http\Controllers\ExcelUploadController;
use App\Http\Controllers\ThrowOnline;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\TopperController;


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

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0); //3 minutes

Route::get('/login', [LoginController::class, 'set_Login_View'])->middleware('CaseAuthentication');
Route::get('/dashboard', [DashController::class, 'show_dashboard'])->middleware('CaseAuthentication');
Route::get('/result-display/{id}', [ResultUploader::class, 'display_result_view'])->middleware('CaseAuthentication');
Route::get('/result-uploader/{id}', [ResultUploader::class, 'upload_result_excel_view'])->middleware('CaseAuthentication');
Route::post('/result-display', [ResultUploader::class, 'display_result_view_from_menu'])->middleware('CaseAuthentication');
Route::get('/put-online', [ThrowOnline::class, 'put_online_view'])->middleware('CaseAuthentication');
Route::get('/view-csv', [ThrowOnline::class, 'view_test_data'])->middleware('CaseAuthentication');
Route::post('/upload-online', [ThrowOnline::class, 'put_online'])->middleware('CaseAuthentication');
Route::post('/delete-testid-data', [ThrowOnline::class, 'delete_testid_data'])->middleware('CaseAuthentication');
Route::any('/log-out', [LoginController::class, 'log_out']);
Route::get('/sms', [SMSController::class, 'sms_view'])->middleware('CaseAuthentication');
Route::get('/pdf', [TopperController::class, 'createPDF'])->middleware('CaseAuthentication');

Route::get('/top10', [TopperController::class, 'generate_pdf_view'])->middleware('CaseAuthentication');
Route::post('/top10', [TopperController::class, 'generate_pdf'])->middleware('CaseAuthentication');
Route::get('/get_sms_test_details', [SMSController::class, 'return_sms_title_details'])->middleware('CaseAuthentication');
Route::post('/get_sms_records', [SMSController::class, 'return_records_for_sms'])->middleware('CaseAuthentication');
Route::any('/send-sms', [SMSController::class, 'send_sms_action'])->middleware('CaseAuthentication');
Route::post('/login', [LoginController::class, 'set_login_action']);
Route::post('/result-uploader/{id}', [ResultUploader::class, 'upload_result_excel'])->middleware('CaseAuthentication');
Route::get('/excel_upload', [ExcelUploadController::class, 'upload_result_from_excel_view'])->middleware('CaseAuthentication');
Route::post('/excel_upload', [ExcelUploadController::class, 'upload_display'])->middleware('CaseAuthentication');
Route::get('/', [LoginController::class, 'local_Render'])->middleware('CaseAuthentication');
Route::get('/data-download/{id}', [ThrowOnline::class, 'data_download'])->middleware('CaseAuthentication');

