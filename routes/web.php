<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ModeratorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'showMainPage'])->name('mainPage');
Route::get('/vacancy', [IndexController::class, 'showVacancyPage'])->name('vacancyPage');
Route::get('/about', [IndexController::class, 'showAboutPage'])->name('aboutPage');
Route::get('/page/{vacancy_id}', [IndexController::class, 'showThisVacancy'])->name('showThisVacancy');
Route::get('/search', [IndexController::class, 'search'])->name('search');
Route::get('/searchResum', [HRController::class, 'searchResum'])->name('searchResum');
Route::get('/filters', [IndexController::class, 'filters'])->name('filters');
Route::get('/filterRes', [HRController::class, 'filterRes'])->name('filterRes');
Route::get('/myVacancy/{id}', [CompanyController::class, 'showPageMyVacancy'])->name('showPageMyVacancy');
Route::get('/addVacancy', [CompanyController::class, 'showPageAddVacancy'])->name('showPageAddVacancy');
Route::post('/addVacancy/{id}', [CompanyController::class, 'AddVacancy'])->name('AddVacancy');
Route::get('/updateVacancy/{vacancy_id}/{id}', [CompanyController::class, 'showPageUpdateVacancy'])->name('showPageUpdateVacancy');
Route::post('/updateVacancy/{vacancy_id}/{id}', [CompanyController::class, 'UpdateVacancy'])->name('UpdateVacancy');
Route::get('/delete/{vacancy_id}/{id}', [CompanyController::class, 'deleteVacancy'])->name('deleteVacancy');
Route::get('/messages/{id}', [CompanyController::class, 'showСompletedVacPage'])->name('showСompletedVacPage');
Route::get('/moderate', [ModeratorController::class, 'showPageModerate'])->name('showPageModerate');
Route::get('/mod/{vacancy_id}', [ModeratorController::class, 'confirm'])->name('confirm');
Route::get('/moderate/{vacancy_id}', [ModeratorController::class, 'showPageComments'])->name('showPageComments');
Route::post('/moderate/{vacancy_id}', [ModeratorController::class, 'refusalVacancy'])->name('refusalVacancy');
Route::get('/resume', [HRController::class, 'showAllResume'])->name('showAllResume');
Route::get('/resume/{resume_id}', [HRController::class, 'thisResume'])->name('thisResume');
Route::get('/addRes', [HRController::class, 'showADDResume'])->name('showADDResume');
Route::post('/addRes', [HRController::class, 'AddResume'])->name('AddResume');
Route::get('/updVac/{resume_id}', [HRController::class, 'showUpdResume'])->name('showUpdResume');
Route::post('/updVac/{resume_id}', [HRController::class, 'UpdResume'])->name('UpdResume');
Route::get('/delResume/{vacancy_id}', [HRController::class, 'delRes'])->name('delRes');
Route::get('/kanbanboard', [HRController::class, 'showKanban'])->name('showKanban');
Route::post('/newCol', [HRController::class, 'NewCol'])->name('NewCol');
Route::post('/newCol/{id}', [HRController::class, 'EditCol'])->name('EditCol');
Route::post('/delCol/{id}', [HRController::class, 'deleteCol'])->name('deleteCol');
Route::post('/FormRecords/{resume_id}/{vacancy_id}', [HRController::class, 'FormRecords'])->name('FormRecords');
Route::post('/AddNewRecord/{colom_id}/{id_vac}', [HRController::class, 'AddNewRecord'])->name('AddNewRecord');
Route::get('/confirmPage/{vacancy_id}', [CompanyController::class, 'showConfirmPage'])->name('showConfirmPage');
Route::get('/AgreeRes/{resume_id}/{vacancy_id}', [CompanyController::class, 'AgreeRes'])->name('AgreeRes');
Route::get('/refusalRes/{resume_id}/{vacancy_id}', [CompanyController::class, 'refusalRes'])->name('refusalRes');
Route::post('/revisionResum/{resume_id}/{vacancy_id}', [CompanyController::class, 'revisionResum'])->name('revisionResum');
Route::get('/documents', [CompanyController::class, 'showDocumentsPage'])->name('showDocumentsPage');
Route::get('/docAct/{id}', [CompanyController::class, 'pdfExportAct'])->name('pdfExportAct');
Route::get('/docBill/{id}', [CompanyController::class, 'pdfExportBill'])->name('pdfExportBill');
Route::get('/movRec/{resume_id}/{colom_id}/{id_vac}', [HRController::class, 'movingRecord'])->name('movingRecord');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
