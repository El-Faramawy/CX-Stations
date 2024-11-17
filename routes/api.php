<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Events\MyEvent;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->namespace('App\Http\Controllers\Api')->group(function () {

    /* ---------------------- Authentication -------------------*/
    Route::get('cities', 'CityController@index');
    Route::get('countries', 'CityController@countries');
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('delete_users', 'DeleteUsersController@delete_users');

    Route::post('get_code','ForgetPasswordController@get_code');
    Route::post('ConfirmCode','ForgetPasswordController@ConfirmCode');
    Route::post('UpdatePassword','ForgetPasswordController@UpdatePassword');


    Route::middleware('jwt.verify')->group(function () {
        /* ---------------------- setting -------------------*/
        Route::get('setting', 'SettingController@setting');
        Route::post('contact_us', 'ContactController@contact_us');

        Route::get('profile', 'AuthController@profile');
        Route::post('update_profile', 'AuthController@update_profile');
        Route::post('logout', 'AuthController@logout');

        /* ---------------------- home -------------------*/
        Route::get('vip_ads', 'HomeController@vip_ads');
        Route::get('top_rated', 'HomeController@top_rated');
        Route::get('near_ads', 'HomeController@nearAds');
        Route::get('getAdsByCategory', 'HomeController@getAdsByCategory');
        Route::get('getCategories', 'HomeController@getCategories');

        /* ---------------------- notifications -------------------*/
        Route::get('getNotificationsCount', 'NotificationController@getNotificationsCount');
        Route::get('notifications', 'NotificationController@notifications');

        /* ---------------------- brand -------------------*/
        Route::group(['prefix' => 'brand'], function () {
            Route::get('getBrandsByCategory', 'BrandController@getBrandsByCategory');
            Route::get('one_brand', 'BrandController@one_brand');
            Route::post('follow_brand', 'BrandController@follow_brand');
            Route::get('followed', 'BrandController@followed');
        });

        /* ---------------------- ad -------------------*/
        Route::group(['prefix' => 'ad'], function () {
            Route::post('like', 'AdController@like');
            Route::post('comment', 'AdController@comment');
            Route::post('share', 'AdController@share');
            Route::post('view', 'AdController@view');
            Route::get('one_ad', 'AdController@one_ad');
        });

        /* ---------------------- survey -------------------*/
        Route::group(['prefix' => 'survey'], function () {
            Route::get('surveys', 'SurveyController@surveys');
            Route::get('questions', 'SurveyController@questions');
            Route::post('create', 'SurveyController@create');
            Route::post('rate', 'SurveyController@rate');
        });

        /* ---------------------- coupon -------------------*/
        Route::post('coupon', 'CouponController@create');
        Route::get('active_coupons', 'CouponController@active_coupons');

    });

});


