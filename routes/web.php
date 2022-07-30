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

Route::get('/assets/{type}/static/{filename}', 'Web\fileThemeController@assetsStatic')->where('imagePath', '(.*)')->name('assets.static');
Route::get('/static/{type}/{filename}/{extension}', 'Web\fileThemeController@assetsStatic')->where('imagePath', '(.*)')->name('assets.image');


/* UNPROTECTED ROUTES */
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => ['CAT', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
	], 
	function() {
		#User Auth Routes
		Auth::routes();

		#Web Home
		Route::get('/', 'Web\IndexController@index')->name('web.index');	
	}
);

/* PROTECTED ROUTES */
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'auth', 'BlackList', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'CAT' ]
	], 
	function() {

		#loged Web Home 
		Route::get('/home', 'Web\IndexController@index')->name('web.page');
		
		#Admin Home
		Route::get('/admin', 'Admin\HomeController@index')->name('admin.index');

		#Users
		Route::resource('/users', 'Admin\UserController');
		Route::get('/user/{userType}/list/', 'Admin\UserController@userList')->name('user.type.list');
		Route::get('/user/{userType}/create/', 'Admin\UserController@userCreate')->name('user.type.create');
		Route::get('/user/{userId}/profile/', 'Admin\UserController@userProfile')->name('user.profile');
		Route::post('/user/{userId}/profile/', 'Admin\UserController@updateProfile')->name('user.profile.update');
		Route::get('/user/{userId}/account/', 'Admin\UserController@userAccount')->name('user.account');
		Route::get('/user/{userId}/security/', 'Admin\UserController@userSecurity')->name('user.security');
		Route::post('/user/{userId}/security/', 'Admin\UserController@updateUserSecurity')->name('update.user.security');
		Route::get('/user/{userId}/notifications/', 'Admin\UserController@userNotifications')->name('user.notifications');
		
		#BlackList
		Route::resource('blacklist', 'Admin\BlacklistController');
		
		#Roles
		Route::resource('/roles','Admin\RoleController')->middleware(['permission:role-list']);
		Route::get('/roles/{idRole}/{idPermission}/addPermission','Admin\RoleController@addPermission')->name('role.add.permission');
		Route::get('/roles/{idRole}/{idPermission}/removePermission','Admin\RoleController@removePermission')->name('role.remove.permission');

		#Permissions
		Route::resource('/permissions','Admin\PermissionController')->middleware(['permission:role-list']);

		#Settings Web
		Route::resource('/web-settings', 'Admin\WebSettingController');
		
		#Web settings
		Route::get('/settings/web', 'Admin\WebSettingController@indexWebSettings')->name('settings-web.index');
		
		#Web Logos
		Route::resource('/web-logos', 'Admin\WebLogoController');

		#Settings Domains
		Route::resource('/domains', 'Admin\DomainController');

		#Audit
		Route::resource('audits', 'Admin\AuditController', [ 'only' => ['index','show'] ]);

		#Emails
		Route::resource('emails', 'Admin\EmailController', [ 'only' => ['index','show'] ]);
		Route::get('email', 'Admin\EmailController@sendEmail');
		Route::get('email-preview', 'Admin\EmailController@preview');

		#Themes
		Route::resource('themes', 'Admin\ThemeController', [ 'only' => ['index','update', 'edit'] ]);
	}
);

//PROTECTED, NO LOCALIZATION
Route::group(
	[
		'middleware' => [ 'auth', 'BlackList' ]
	], 
	function() {

		/********* WEB JSON RESPONSE ONLY FOR ADMIN USRES****/
		Route::get('/index/json', 'Web\IndexController@indexJson')->name('web.index.json');
		/********* END WEB JSON RESPONSE ****/

		#Autocomplete
		Route::post('/autocomplete/fetchCountries', 'Admin\AutocompleteController@fetchCountries')->name('autocomplete.fetchCountries');
		Route::post('/autocomplete/fetchStates', 'Admin\AutocompleteController@fetchStates')->name('autocomplete.fetchStates');
		Route::post('/autocomplete/fetchCities', 'Admin\AutocompleteController@fetchCities')->name('autocomplete.fetchCities');
		
		#user
		Route::post('/user/{userId}/get/info/json', 'Admin\UserController@getInfoJson')->name('get.info.json');

		#web settings email-sending
		Route::post('/web/settings/email/sending/{status}', 'Admin\WebSettingController@setEmailSendingStatus')->name('set.email.sending.status');
	}
);


//NO PROTECTED, NO LOCALIZATION
Route::group(
	[
		'middleware' => [ 'BlackList' ]
	], 
	function() {

	}
);
