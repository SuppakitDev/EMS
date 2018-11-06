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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Fillter all user this login for navigate to webpage
Route::get('/filtermember', 'FiltermemberController@index');
// Admin route Zone
Route::get('/admintheme','AdminController@admintheme');
Route::get('/company','AdminController@company');
Route::get('/database','AdminController@database');
Route::get('/calendar','AdminController@calendar');
Route::get('/PointmapAPI','AdminController@PointmapAPI');

Route::resource('EmsAdminProfile','AdminProfileController');
Route::resource('Company','CompanyController');

// Manager Zone
Route::get('/EmsInformation','EmsInformationController@index');
Route::get('/Insidedept','InsidedeptController@index');
Route::get('/getEmsOverviewDaily','HomeContentController@getEmsOverviewDaily');
Route::get('/getEmsOverviewMonthly','HomeContentController@getEmsOverviewMonthly');
Route::get('/getEmsOverviewYearly','HomeContentController@getEmsOverviewYearly');

Route::get('/getEmsInsideDeptDaily','InsidedeptController@getEmsInsideDeptDaily');
Route::get('/getEmsInsideDeptMonthly','InsidedeptController@getEmsInsideDeptMonthly');
Route::get('/getEmsInsideDeptYearly','InsidedeptController@getEmsInsideDeptYearly');

Route::get('/Gotothiscompany','CompanyController@Gotothiscompany');
Route::post('/Addbuilding','CompanyController@Addbuilding');

Route::get('/getdisplaylist','CompanyController@getdisplaylist');
Route::post('/Adddepartment','CompanyController@Adddepartment');

Route::get('/RemoveBuilding','CompanyController@RemoveBuilding');
Route::get('/RemoveDepartment','CompanyController@RemoveDepartment');

Route::get('/EditBuilding','CompanyController@EditBuilding');
Route::get('/EditDepartment','CompanyController@EditDepartment');

Route::get('/Addusertocompany','CompanyController@Addusertocompany');
Route::get('/RemoveMember','CompanyController@RemoveMember');


Route::post('/UpdateMember','CompanyController@UpdateMember');



