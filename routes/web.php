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

Route::get('/','Auth\LoginController@showLoginForm');

Auth::routes();

Route::group(['middleware'=>'auth'],function(){


Route::post('/addcontact',['uses'=>'Contact@index','as'=>'contact.add']);
Route::get('/contacts/view','Contact@view_contacts');
Route::post('/contactdatatable','Contact@contacts_datatable');
Route::get('/contact/edit/{id}','Contact@edit_contact');
Route::post('contactupdate',['uses'=>'Contact@update_contact_record','as'=>'contact.update']);

Route::get('student/add','Student@index');
Route::post('student',['uses'=>'Student@add_student','as'=>'student.add']);
Route::get('student/view','Student@view_students');
Route::post('studentdatatable','Student@students_datatable');
Route::get('student/edit/{id}','Student@edit_student_info');
Route::post('stdupdate',['uses'=>'Student@update_data','as'=>'student.update']);

Route::get('/msg','Auth\RegisterController@registration_message');

Route::get('users','HomeController@view_users');
Route::post('usersdatatable','HomeController@users_datatable');
Route::get('user/delete/{id}','HomeController@delete_user');

});

Route::get('/home', 'HomeController@index')->name('home');
