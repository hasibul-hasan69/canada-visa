<?php

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

Route::get('/', function () {
    return view('frontend.login');
})->name('home');

Route::get('job/status/{dataId}','LoginController@getVisaStaus')->name('visa.status');

Route::get('logout','LoginController@logout')->name('logout');

Route::get('login','LoginController@loginPage')->name('loginPage')->middleware('StaffAuth');

Route::post('login','LoginController@loginAttempt')->name('loginAttempt');

Route::group(['prefix'=>'admin','middleware'=>'StaffAuth','as'=>'admin.'],function(){

     
    Route::get('logout','StaffController@logout')->name('logout');

    Route::get('job/seeker/list','StaffController@getJobSeekerList')->name('job_seeker');

    Route::post('job/seeker/add','StaffController@addJobSeekerInfo')->name('job_seeker.add');

    Route::post('job/seeker/update','StaffController@updateJobSeekerInfo')->name('job_seeker.update');

    Route::get('job/seeker/delete','StaffController@deleteJobSeekerInfo')->name('job_seeker.delete');

    Route::get('job/seeker/print','StaffController@printJobSeekerInfo')->name('job_seeker.print');

    Route::post('job/seeker/all/print','StaffController@allJobSeekerPrint')->name('job_seeker.allPrint');


    Route::get('staff/list','StaffController@getStaffList')->name('staff');

    Route::post('staff/add','StaffController@addStaffInfo')->name('staff.add');

    Route::post('staff/update','StaffController@updateStaffInfo')->name('staff.update');

    Route::get('staff/delete','StaffController@deleteStaffInfo')->name('staff.delete');


    Route::get('company/list','StaffController@getCompanyList')->name('company');

    Route::post('company/add','StaffController@addCompanyInfo')->name('company.add');

    Route::post('company/update','StaffController@updateCompanyInfo')->name('company.update');

    Route::get('company/delete','StaffController@deleteCompanyInfo')->name('company.delete');


    Route::get('change/password','StaffController@showPassworForm')->name('change.password');
    Route::post('change/password','StaffController@changePassword')->name('change.password');

});
