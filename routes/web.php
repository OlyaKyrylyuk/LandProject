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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('insert_claim','ClaimsController@get');
Route::post('/home', 'HomeController@insertdata');//додавати профайл
Route::get('/user_profile','UserController@profile');//форма додання даних про юзера
Route::post('/profile_change', 'UserController@changedata');//додавати профайл
//---------------Claims(User)-----------------------//
Route::post('/claims/edit/{id}', 'ClaimsController@editclaim');//змінитизаяву
Route::post('/insert_claim', 'ClaimsController@insert');//додавати заяву
Route::post('admin/workers/insert', 'AdminController@insert_member');//додавати заяву
Route::post('/send_email', 'GmailController@send');//додавати заяву
//Route::get('/insert_claim',function(){return view(home2);});

//---------------Перегляд даних адміном-----------------------//
Route::get('/admin/home','AdminController@home')->middleware(['role','auth']);//сторінка адміна
Route::get('/admin/notifications','AdminController@notifications')->middleware(['role','auth']);
Route::get('/admin/users','AdminController@users')->middleware(['role','auth']);//перегляд адміном юзерів
Route::get('/admin/workers','AdminController@workers')->middleware(['role','auth']);//перешляд адміном представників
Route::get('/admin/editprofile','AdminController@editprofile')->middleware(['role','auth']);
Route::post('/admin/editprofile/1','AdminController@do_editprofile')->middleware(['role','auth']);
Route::post('/admin/edit_deal_step/{id}','AdminController@editone');
//---------------Deals(Admin)-----------------------//
Route::get('admin/deals','DealsController@admin_deals')->middleware(['role','auth']);//справи -> адмін
Route::get('admin/deals/search','DealsController@search')->middleware(['role','auth']);//справи -> адмін
Route::post('admin/deals','DealsController@insertdeals')->middleware(['role','auth']);//справи -> адмін
Route::get('/admin/adddeals','DealsController@adddeals')->middleware(['role','auth']);
Route::post('/admin/deals/edit/{id}','DealsController@edit_deals')->middleware(['role','auth']);
Route::get('/admin/deals/edit/{id}','DealsController@show_edit_deals')->middleware(['role','auth']);
Route::get('/admin/deals/date','DealsController@dealbydate')->middleware(['role','auth']);
Route::get('/admin/deals/judge','DealsController@dealbyjudge')->middleware(['role','auth']);
Route::get('admin/deals/instantion','DealsController@dealbyinstansion')->middleware(['role','auth']);
//---------------Claims(Admin)-----------------------//
//Route::get('/admin/claims','ClaimsController@adminclaims')->middleware(['role','auth']);
Route::get('/admin/claims','ClaimsController@allclaims')->middleware(['role','auth']);
//Route::post('/admin/claims/insert','ClaimsController@filter')->name('daterange.fetch_data');
Route::put('admin/claim/{id}','ClaimsController@adminclaim')->middleware(['role','auth']);

Route::get('/admin/deals/search','DealsController@search')->middleware(['role','auth']);
//---------------Steps(Admin)-----------------------//
Route::get('/admin/steps','StepsController@addsteps')->middleware(['role','auth']);
Route::get('/admin/PDF','PDFController@pdf')->middleware(['role','auth']);
Route::post('/admin/steps','StepsController@insertsteps')->middleware(['role','auth']);//справи -> адмін
Route::post('/admin/steps/delete/{id}','StepsController@deletesteps')->middleware(['role','auth']);//справи -> адмін
Route::get('/admin/charts','ChartsController@charts')->middleware(['role','auth']);
Route::get('/admin/charts2','ChartsController@charts2')->middleware(['role','auth']);
Route::get('/admin/charts3','ChartsController@charts3')->middleware(['role','auth']);
/*Route::get('/member',function(){
    $users = Auth::user()->id;
    return $users;
});*/

//Route::get('/dd', 'DealsController@first');
Route::get('/dd', 'DealsController@try');
Route::post('/live_search/action', 'DealsController@trysearch')->name('route2');
Route::post('/admin/claims/insert', 'DealsController@second')->name('route')->middleware(['role','auth']);
Route::get('/admin/deals/find/{id}','DealsController@findone')->middleware(['role','auth']);
Route::get('/member/deals/find/{id}','MemberController@findone');
Route::get('/member/charts','MemberController@charts');
Route::get('/member/home','MemberController@home');
Route::get('member/deals','MemberController@try');
Route::get('member/notifications','MemberController@notifications');
Route::post('/live_search', 'MemberController@trysearch')->name('routes');
Route::post('/route3', 'MemberController@searchdeals')->name('route3');
Route::get('/ss','HomeController@session');