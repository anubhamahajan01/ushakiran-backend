<?php

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


/**
 * Auth 
 */
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('verify-email', 'AuthController@verifyEmail');

Route::group(['middleware' => 'jwt.auth'], function (){

    Route::group(['prefix' => 'donations'], function() {
        /**
         * Donation Category
         */
        Route::group(['prefix' => 'categories'], function() {
            Route::get('', 'DonationCategoryController@index');
            Route::get('{uuid}', 'DonationCategoryController@get');
        });
        /**
        * Donation
        */
        Route::post('', 'DonationController@create');
    });

    Route::group(['prefix' => 'educate'], function(){
        /**
         * Educational Subjects
         */
        Route::group(['prefix' => '/subjects'], function() {
            Route::get('', 'EducationalSubjectController@index');
        });
        /**
        * Educational Request
        */
        Route::post('/request', 'EducationalRequestController@create');

    });

    /**
     * Get live blogs
     */
    Route::get('blogs', 'BlogController@index');

    /**
     * Get A live blogs
     */
    Route::get('blogs/{blog_uuid}', 'BlogController@get');

    /**
     * Get products
     */
    Route::get('products', 'ProductController@index');
    
    /**
     * Mark your interest in a product
     */
    Route::post('users/products/{prod_id}/interested', 'ProductController@markInterested');
    
});
