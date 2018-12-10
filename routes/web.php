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

Route::resource('Profile','ProfileController');
Route::resource('Changepass','ChangepasswordController');

Route::get('/EmsInsert','EMSAPIController@EmsInsert');
Route::get('/AutoEmsInsertDis01','EMSAPIController@AutoEmsInsertDis01');
Route::get('/AutoEmsInsertDis02','EMSAPIController@AutoEmsInsertDis02');
Route::get('/testquery','FiltermemberController@testquery');




Route::get('/TestAutoinsertdb', function () {
    return view('TestAutoinsertdb');
});


// Home Content Response
Route::get('/EMSGettotalenergy','HomeContentController@EMSGettotalenergy');
Route::get('/EMSGetrealtimepower','HomeContentController@EMSGetrealtimepower');
Route::get('/EMSGetlastPowerrealtimeDaily','HomeContentController@EMSGetlastPowerrealtimeDaily');
Route::get('/EMSGetDepartmentConpare','HomeContentController@EMSGetDepartmentConpare');
Route::get('/EMSGetThisdayenergyOverview','HomeContentController@EMSGetThisdayenergyOverview');
Route::get('/EMSGetlastupdatetime','HomeContentController@EMSGetlastupdatetime');
Route::get('/EMSGetComparewithyesterday','HomeContentController@EMSGetComparewithyesterday');
Route::get('/EmsOverviewCustomDate','HomeContentController@EmsOverviewCustomDate');
Route::get('/EmsgetOverviewPowerCustomDate','HomeContentController@EmsgetOverviewPowerCustomDate');
Route::get('/EmsgetOverviewEnergyCustomDate','HomeContentController@EmsgetOverviewEnergyCustomDate');

// Monthly Zone
Route::get('/MonthlyEnergychart','EMSMonthlyController@MonthlyEnergychart');
Route::get('/EMSGetComparewithlastymonth','EMSMonthlyController@EMSGetComparewithlastymonth');
Route::get('/EMSGetDepartmentConparethisMonth','EMSMonthlyController@EMSGetDepartmentConparethisMonth');
Route::get('/EMSGetThisMonthenergyOverview','EMSMonthlyController@EMSGetThisMonthenergyOverview');
// Route::get('/EmsgetOverviewEnergyCustomDate','HomeContentController@EmsgetOverviewEnergyCustomDate');


// Yearly Zone
Route::get('/YearlyEnergychart','EMSYearlyController@YearlyEnergychart');
Route::get('/EMSGetComparewithlastyear','EMSYearlyController@EMSGetComparewithlastyear');
Route::get('/EMSGetDepartmentConparethisYear','EMSYearlyController@EMSGetDepartmentConparethisYear');
Route::get('/EMSGetThisYearenergyOverview','EMSYearlyController@EMSGetThisYearenergyOverview');

// Inside Dept Zone
Route::get('/EMSGetInsideRealtimepowerDaily','InsidedeptController@EMSGetInsideRealtimepowerDaily');
Route::get('/EMSGettotalInsideenergy','InsidedeptController@EMSGettotalInsideenergy');
Route::get('/EMSGetrealtimeInsidepower','InsidedeptController@EMSGetrealtimeInsidepower');
Route::get('/EMSGetlastupdatetimeInside','InsidedeptController@EMSGetlastupdatetimeInside');

Route::get('/MonthlyEnergychartInside','EMSMonthlyController@MonthlyEnergychartInside');
Route::get('/EMSGetThisMonthenergyInside','EMSMonthlyController@EMSGetThisMonthenergyInside');


Route::get('/YearlyEnergychartInside','EMSYearlyController@YearlyEnergychartInside');
Route::get('/EMSGetThisYearenergyInside','EMSYearlyController@EMSGetThisYearenergyInside');

Route::get('/EmsInsideString1','InsidedeptController@EmsInsideString1');
Route::get('/EmsInsideString2','InsidedeptController@EmsInsideString2');
Route::get('/EmsInsideString3','InsidedeptController@EmsInsideString3');
Route::get('/EmsInsideString4','InsidedeptController@EmsInsideString4');
Route::get('/EmsInsideString5','InsidedeptController@EmsInsideString5');

Route::get('/EmsInsideCustomDate','InsidedeptController@EmsInsideCustomDate');
Route::get('/EmsgetInsidePowerCustomDate','InsidedeptController@EmsgetInsidePowerCustomDate');
Route::get('/EmsgetInsideEnergyCustomDate','InsidedeptController@EmsgetInsideEnergyCustomDate');

Route::get('/VoltageRealtime','InsidedeptController@VoltageRealtime');
Route::get('/CurrentRealtime','InsidedeptController@CurrentRealtime');

Route::get('/EmsgetVoltageRealtime','InsidedeptController@EmsgetVoltageRealtime');
Route::get('/EmsgetCurrentRealtime','InsidedeptController@EmsgetCurrentRealtime');






