<?php

use Illuminate\Support\Facades\Route;

Route::prefix('brand')->middleware('web')->namespace('App\Http\Controllers\Brand')->group(function () {
    Route::get('login', 'AuthController@index')->name('brand.login');
    Route::post('post_login', 'AuthController@login')->name('brand.post_login');

    Route::get('register', 'AuthController@register')->name('brand.register');
    Route::get('get_country_cities','AuthController@get_country_cities')->name('get_country_cities');
    Route::post('post_register', 'AuthController@post_register')->name('brand.post_register');

    Route::get('get_code', 'ForgetPasswordController@get_code')->name('brand.get_code');
    Route::post('post_get_code', 'ForgetPasswordController@get_code')->name('brand.post_get_code');
    Route::get('getConfirmCode', 'ForgetPasswordController@GetConfirmCode')->name('brand.get_confirm_code');
    Route::post('confirmCode', 'ForgetPasswordController@ConfirmCode')->name('brand.confirm_code');
    Route::view('success', 'Brand.success')->name('brand.success');
    Route::get('update-password', 'ForgetPasswordController@getUpdatePassword')->name('brand.get_update_password');
    Route::post('updatePassword', 'ForgetPasswordController@UpdatePassword')->name('brand.update_password');

    Route::view('forgot-password', 'Brand.forgot-password')->name('brand.forgot-password');


    //******* after login *******
    Route::group(['middleware' => ['brand', 'preferences']], function () {

        Route::get('updatePreferences', 'LanguageController@updatePreferences')->name('brand.updatePreferences');
        Route::get('logout', 'AuthController@logout')->name('brand.logout');

        Route::get('/', function (){
            return redirect()->route('brand.home');
        })->name('/');

        Route::get('home', 'HomeController@index')->name('brand.home');
        Route::post('send_survey', 'HomeController@send_survey')->name('brand.send-survey');
        Route::post('/change-coupon-status', 'HomeController@changeStatus')->name('changeCouponStatus');

        Route::get('duet', 'DuetController@index')->name('brand.duet');
        Route::get('/duet/data', 'DuetController@index')->name('duet.data');
        Route::post('addDuetCoupon', 'DuetController@addDuetCoupon')->name('addDuetCoupon');

        Route::get('announce', 'AnnounceController@index')->name('brand.announce');
        Route::post('add_ad', 'AnnounceController@add_ad')->name('brand.add-ad');

        Route::get('dashboard', 'DashboardController@index')->name('brand.dashboard');

        Route::get('comments', 'CommentController@index')->name('brand.comments');
        Route::get('view_comment/{id}', 'CommentController@view')->name('brand.comments.view');
        Route::get('reply_comment/{id}', 'CommentController@reply')->name('brand.comments.reply');
        Route::post('add_comment_reply', 'CommentController@add_comment_reply')->name('brand.add_comment_reply');

        Route::get('settings', 'SettingController@index')->name('brand.settings');
        Route::post('post_setting', 'SettingController@post_setting')->name('brand.post_setting');


    });
    Route::fallback(function () {
        return redirect('brand/home');
    });
});
