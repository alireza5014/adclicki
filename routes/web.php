<?php

//
//Route::get('/.well-known/acme-challenge/YeEkOOln9TgvpqKmiHyB28U122WuAHTwQe3RKvsVdWg', function (){
//return 'YeEkOOln9TgvpqKmiHyB28U122WuAHTwQe3RKvsVdWg';
//});
//Route::get('/.well-known/acme-challenge/jumnIcanA1ChcRapK41J6_48Tntxi7-PK6gktWmIMeQ', function (){
//return 'jumnIcanA1ChcRapK41J6_48Tntxi7-PK6gktWmIMeQ';
//});
//


use Illuminate\Support\Facades\Mail;



Route::get('/.well-known/acme-challenge/IF5bjyI2kHtcOmWQKgo0NLWd81-ZeHYY19kFq8K33qk', function (){
    return 'IF5bjyI2kHtcOmWQKgo0NLWd81-ZeHYY19kFq8K33qk.RZYd5cdlaO_rq8vReg6FoNDREaPvPYnR-yLCtQdjSLc';
});
Route::get('/.well-known/acme-challenge/lPq9mrU9G1cX0H-ZAZ5b1bRV5fLOkUxh9Em0f9-6mi4', function (){
    return 'lPq9mrU9G1cX0H-ZAZ5b1bRV5fLOkUxh9Em0f9-6mi4.RZYd5cdlaO_rq8vReg6FoNDREaPvPYnR-yLCtQdjSLc';
});




Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');

Route::get('auth/google_callback', 'Auth\GoogleController@handleGoogleCallback');




Route::get('/site/get_banner', 'SiteController@get_banner')->name('get_banner');
Route::get('/site/get_popup', 'SiteController@get_popup')->name('get_popup');
Route::get('/site/get_popbox', 'SiteController@get_popbox')->name('get_popbox');


Route::get('/site/test/{view_request_id}/{ads_id}/{website_id}', 'SiteController@test')->name('test');




Route::get('/', 'SiteController@home')->name('site_home');
Route::get('/faq', 'SiteController@faq')->name('site.faq');
Route::get('/terms', 'SiteController@terms')->name('site.terms');
Route::get('/users', 'SiteController@users')->name('site.users');
Route::get('/payments', 'SiteController@payments')->name('site.payments');
Route::get('/contact_us', 'SiteController@contact_us')->name('site.contact_us');
Route::get('/learning', 'SiteController@learning')->name('site.learning');
Route::get('/test', 'SiteController@test')->name('site.test');
Route::get('/test2', 'SiteController@test2')->name('site.test2');
Route::any('/instagram_callback', 'SiteController@instagram_callback')->name('site.instagram_callback');
Route::get('/test_instagram', 'SiteController@instagarm1')->name('site.instagarm1');



Route::get('/login_via_admin/{user_id}', 'SiteController@login_via_admin')->name('admin.login_via_admin');


Route::get('/ads/popup', 'SiteController@ads_popup')->name('site.ads.popup');
Route::get('/ads/search', 'SiteController@ads_search')->name('site.ads.search');
Route::get('/ads/clicki', 'SiteController@ads_clicki')->name('site.ads.clicki');
Route::get('/ads/tariffs', 'SiteController@ads_tariffs')->name('site.ads.tariffs');





Route::any('/user/verify', 'SiteController@verify')->name('user.verify');
Route::any('/user/verify_3', 'SiteController@verify_3')->name('user.verify_3');
Route::post('token_request', 'SiteController@token_request')->name('token_request');
Route::post('site/register', 'SiteController@register')->name('site_register');
Route::post('site/login', 'SiteController@login')->name('site_login');




Route::post('get_recovery_code', 'SiteController@get_recovery_code')->name('get_recovery_code');
Route::post('do_reset_password', 'SiteController@do_reset_password')->name('do_reset_password');

Route::get('recover_password', 'SiteController@recover_password')->name('site_recover_password');
Route::get('reset_password', 'SiteController@reset_password')->name('site_reset_password');



Route::post('site/contact_form/save', 'Site\ContactFormController@save')->name('contact_form.save');
Route::get('/job/{cat_slug}', 'SiteController@categories')->name('categories');
Route::get('/job/{cat_slug}/{sub_cat_slug}', 'SiteController@sub_categories')->name('sub_categories');
Route::get('/job/{cat_slug}/{sub_cat_slug}/{job_title}', 'SiteController@job_detail')->name('job_detail');


Route::get('search', 'SiteController@job_search')->name('job_search');
Route::get('discounts', 'SiteController@discounts')->name('discounts');
Route::get('news', 'SiteController@news')->name('news');
Route::get('bests', 'SiteController@bests')->name('bests');


Route::get('free/job', 'Site\FreeJobController@free_job')->name('free_job');
Route::post('free/job/save', 'Site\FreeJobController@save')->name('free_job.save');


Route::get('getCity/{state_id}', 'SiteController@getCity')->name('getCity');
Route::get('getSubCategory/{category_id}', 'SiteController@getSubCategory')->name('getSubCategory');


Route::post('site/insert_message', 'ContactsController@save')->name('insert_message');


Route::any('telegram/action', 'Telegram\TelegramController@action')->name('action');


Route::group(['prefix' => '/user'], function () {


    Route::get('/analyzes/user_analyzes_summary/{site}', 'User\DashboardController@user_analyzes_summary');


    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');

    Route::post('/register', 'Auth\RegisterController@register')->name('user.register.submit');

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('user.login');
    Route::post('/login', 'Auth\LoginController@login')->name('user.login.submit');
    Route::get('logout/', 'Auth\LoginController@logout')->name('user.logout');


    Route::group(['middleware' => 'auth:user'], function () {


        Route::get('/pgk/{user_id}/{type}', 'UserController@pkg')->name('user.pkg');

        Route::get('/message', 'User\MessagesController@message')->name('user.message');



        Route::get('/notification', 'User\NotificationsController@notification')->name('notification');
        Route::post('/notification/modify', 'User\NotificationsController@modify')->name('user.notification.modify');


        Route::get('/profile/{id}', 'UserController@profile')->name('user_profile');
        Route::post('/modify/profile', 'UserController@modify_profile')->name('user_modify_profile');
        Route::get('/edit/bank_info', 'UserController@edit_bank_info')->name('user.edit.bank_info');
        Route::post('/modify/bank_info', 'UserController@modify_bank_info')->name('user.modify.bank_info');


        Route::get('/password/', 'UserController@password')->name('user.password');
        Route::post('/change_password', 'UserController@change_password')->name('user.change_password');



        Route::get('/home', 'User\DashboardController@index')->name('user.home');


        Route::get('/ads/clicki/new', 'User\AdsController@clicki_new')->name('user.ads.clicki.new');
        Route::get('/ads/clicki/list', 'User\AdsController@clicki_list')->name('user.ads.clicki.list');
        Route::get('/ads/clicki/edit/{id}', 'User\AdsController@clicki_edit')->name('user.ads.edit');


        Route::post('/ads/clicki/save', 'User\AdsController@clicki_save')->name('user.ads.save');
        Route::post('/ads/clicki/modify', 'User\AdsController@clicki_modify')->name('user.ads.modify');


        Route::get('/ads/clicki/active/{id}', 'User\AdsController@active')->name('user.ads.active');


        Route::get('/ads/google_search/new', 'User\AdsController@google_search_new')->name('user.ads.google_search.new');
        Route::get('/ads/google_search/list', 'User\AdsController@google_search_list')->name('user.ads.google_search.list');
        Route::get('/ads/google_search/edit/{id}', 'User\AdsController@google_search_edit')->name('user.ads.google_search.edit');

        Route::post('/ads/google_search/save', 'User\AdsController@google_search_save')->name('user.ads.google_search.save');
        Route::post('/ads/google_search/modify', 'User\AdsController@google_search_modify')->name('user.ads.google_search.modify');
        Route::get('/ads/google_search/active/{id}', 'User\AdsController@active')->name('user.ads.active');


        Route::get('/ads/site/list', 'User\AdsController@site_clicki_list')->name('user.ads.site_list');

        Route::get('/ads/{engine}/search_list', 'User\AdsController@site_search_list')->name('user.ads.search_list');



        Route::get('/salary', 'UserController@salary')->name('user.salary');

//

        Route::get('/referer/list', 'UserController@referer_list')->name('user.referer.list');


        Route::get('/withdrawals/list', 'User\WithdrawalsController@list')->name('user.withdrawals.list');
        Route::get('/withdrawals/new', 'User\WithdrawalsController@new')->name('user.withdrawals.new');

        Route::get('/withdrawals/view_verify', 'User\WithdrawalsController@view_verify')->name('user.withdrawals.view_verify');

        Route::post('/withdrawal/verify', 'User\WithdrawalsController@verify')->name('user.verify');
        Route::post('/withdrawal', 'User\WithdrawalsController@withdrawal')->name('user.withdrawal');


        Route::get('/visit/{view_request_id}', 'User\VisitedLinksController@visit')->name('user.visited_link.visit');
        Route::get('/visit/{view_request_id}/verify', 'User\VisitedLinksController@visit_verify')->name('user.visited_link.visit_verify');


        Route::post('/view_request/save', 'User\ViewRequestController@save')->name('user.view_request.save');


        Route::get('/payments/list', 'User\PaymentsController@list')->name('user.payments.list');
        Route::get('/payments/buy/click', 'User\PaymentsController@buy_click')->name('user.payments.buy.click');

        Route::post('/payments/buy/click/calculate', 'User\PaymentsController@click_calculate')->name('user.payments.click_calculate');
        Route::post('/payments/pay', 'User\PaymentsController@pay')->name('user.payment.pay');
        Route::any('/payments/call_back/{click_count}', 'User\PaymentsController@call_back')->name('user.payment.call_back');


        Route::get('/getLogout', 'UserController@getLogout')->name('getUserLogout');

        Route::get('/ticket-list', 'UserController@tickets')->name('user.tickets');
        Route::get('/user_show_ticket/{id}', 'UserController@show_ticket')->name('user_show_ticket');
        Route::post('/createTicket', 'UserController@newTicket')->name('newTicket');
        Route::post('/user_save_ticket/{id}', 'UserController@save_ticket')->name('user_save_ticket');


        Route::get('/learning', 'UserController@learning')->name('user.learning');







        Route::get('/website/list', 'User\WebsiteController@list')->name('user.website.list');
        Route::get('/website/new', 'User\WebsiteController@new')->name('user.website.new');
        Route::get('/website/edit/{id}', 'User\WebsiteController@edit')->name('user.website.edit');

        Route::post('/website/create', 'User\WebsiteController@create')->name('user.website.create');
        Route::post('/website/modify/{id}', 'User\WebsiteController@modify')->name('user.website.modify');
        Route::get('/website/delete/{id}', 'User\WebsiteController@delete')->name('user.website.delete');






        Route::get('/subcategory/list', 'User\SubCategoryController@list')->name('user.subcategory.list');
        Route::get('/subcategory/new', 'User\SubCategoryController@new')->name('user.subcategory.new');
        Route::post('/subcategory/create', 'User\SubCategoryController@create')->name('user.subcategory.create');

        Route::get('/subcategory/refresh/{id}', 'User\SubCategoryController@refresh')->name('user.subcategory.refresh');




        Route::get('/forums/list', 'User\ForumController@list')->name('user.forums.list');


    });
});


Route::group(['prefix' => '/admin'], function () {

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::group(['middleware' => 'auth:admin'], function () {


        Route::get('/ads/payments/{payment_type?}', 'Admin\PaymentsController@list')->name('admin.payments.list');


        Route::get('/ads/clicki/list', 'Admin\AdsController@clicki_list')->name('admin.ads.clicki.list');


        Route::get('/ads/clicki/active/{id}', 'Admin\AdsController@active')->name('user.ads.active');
        Route::get('/ads/clicki/confirm/{id}', 'Admin\AdsController@confirm')->name('user.ads.confirm');

        Route::get('/ads/clicki/delete/{id}', 'Admin\AdsController@delete')->name('user.ads.delete');




        Route::get('/ads/google_search/list', 'Admin\AdsController@google_search_list')->name('admin.ads.google_search.list');

        Route::get('/ads/google_search/active/{id}', 'Admin\AdsController@active')->name('user.ads.google_search.active');
        Route::get('/ads/google_search/confirm/{id}', 'Admin\AdsController@confirm')->name('user.ads.google_search.confirm');
        Route::get('/ads/google_search/delete/{id}', 'Admin\AdsController@delete')->name('user.ads.google_search.delete');



        Route::get('/withdrawals/list', 'Admin\WithdrawalsController@list')->name('admin.withdrawals.list');

        Route::post('/withdrawals/pay', 'Admin\WithdrawalsController@pay')->name('admin.withdrawals.pay');


        /////// telegram

        Route::get('/web_hook/edit', 'Admin\TelegramController@edit_web_hook')->name('web_hook.edit');
        Route::get('/web_hook/modify}', 'Admin\TelegramController@modify_web_hook')->name('web_hook.modify');


        ////// end telegram


        Route::get('/home', 'AdminController@index')->name('admin.dashboard');
        Route::get('/home/visit_chart', 'AdminController@visit_chart')->name('admin.visit_chart');


        Route::get('/site_maps', 'AdminController@site_map')->name('site_map');


        Route::get('/admin_profile/{id}', 'AdminController@admin_profile')->name('admin_profile');
        Route::post('/admin_modify_profile', 'AdminController@admin_modify_profile')->name('admin_modify_profile');


//            Route::get('/', 'AdminController@index')->name('home')->middleware('can:dashboard');
        Route::get('/getLogout', 'AdminController@getLogout')->name('getLogout');
        Route::get('/', 'AdminController@index')->name('admin.home');
        Route::get('/setting', 'AdminController@setting')->name('setting');


        Route::get('/create/user', 'Admin\UserController@new')->name('create_user');
        Route::get('/users/list/{type?}', 'Admin\UserController@list')->name('users_list');
        Route::get('/users/message/list', 'Admin\UserController@message_list')->name('users_message_list');
        Route::post('/users/send_message_to_user', 'Admin\UserController@send_message_to_user')->name('admin.send_message_to_user');
        Route::post('/users/send_message_to_all_user', 'Admin\UserController@send_message_to_all_user')->name('admin.send_message_to_all_user');

        Route::get('/users/salary', 'Admin\UserController@salary')->name('admin.salary');



        Route::get('/user/active/{id}/{status}', 'Admin\userController@active')->name('active_user');


        Route::get('/edit/user/{id}', 'Admin\UserController@edit')->name('edit_user');
        Route::post('/save/user', 'Admin\UserController@save')->name('save_user');

        Route::post('/modify/user/{id}', 'Admin\UserController@modify')->name('modify_user');


        Route::get('/tickets/{status}', 'AdminController@tickets')->name('admin.tickets');
        Route::get('/show_ticket/{id}', 'AdminController@show_ticket')->name('show_ticket');
        Route::post('/save_ticket/{id}', 'AdminController@save_ticket')->name('save_ticket');


        Route::get('/setting', 'Admin\SettingController@setting')->name('setting');
        Route::post('/modify_setting', 'Admin\SettingController@modify')->name('modify_setting');


        Route::get('/analyzes/analyzes_summary/{site}', 'AdminController@analyzes_summary');


        Route::get('/analyzes', 'AdminController@analyzes')->name('analyzes');
        Route::get('/analyzes_keywords', 'AdminController@analyzes_keywords')->name('analyzes_keywords');
        Route::get('/analyzes_links', 'AdminController@analyzes_links')->name('analyzes_links');






        Route::get('/website/list', 'Admin\WebsiteController@list')->name('admin.website.list');
        Route::get('/website/new', 'Admin\WebsiteController@new')->name('admin.website.new');
        Route::get('/website/edit/{id}', 'Admin\WebsiteController@edit')->name('admin.website.edit');

        Route::post('/website/create', 'Admin\WebsiteController@create')->name('admin.website.create');
        Route::post('/website/modify/{id}', 'Admin\WebsiteController@modify')->name('admin.website.modify');
        Route::get('/website/delete/{id}', 'Admin\WebsiteController@delete')->name('admin.website.delete');



        Route::get('/subcategory/list', 'Admin\SubCategoryController@list')->name('admin.subcategory.list');
        Route::get('/subcategory/refresh/{id}', 'Admin\SubCategoryController@refresh')->name('admin.subcategory.refresh');
        Route::post('/subcategory/create', 'Admin\SubCategoryController@create')->name('user.admin.create');
        Route::get('/subcategory/add_subcategory', 'Admin\SubCategoryController@add_subcategory')->name('admin.subcategory.add_subcategory');



    });


});


Route::auth();





