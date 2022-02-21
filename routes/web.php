<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// route::GET('/test', 'IndexController@test')->name('IndexController.test');  //url para pruebas

Route::GET('/', 'IndexController@index')->name('IndexController.index');
Route::GET('/about', 'IndexController@about')->name('IndexController.about');
Route::GET('/suscribe', 'IndexController@suscribe')->name('IndexController.suscribe');
Route::POST('/suscribe', 'IndexController@suscribeCreate')->name('IndexController.suscribeCreate');
Route::GET('/tankyou', 'IndexController@tankyou')->name('IndexController.tankyou');

Route::POST('/suscribeNews', 'IndexController@suscribeNews')->name('IndexController.suscribeNews');

Route::GET('/login', function(){  return view('auth.login');  });
Route::GET('/register', function(){  return view('auth.register');  });

Route::auth();

Route::GET('/dashboard', 'HomeController@index')->middleware('auth');
// Route::GET('/dashboard', 'HomeController@index');
Route::GET('/sendRegConfirmMail', 'HomeController@sendRegConfirmMail')->name('home.sendRegConfirmMail');
Route::GET('/accountVallidation/{id}/{code}', 'HomeController@accountVallidation')->name('home.accountVallidation');
Route::GET('/logout', 'HomeController@logout');

// Administración de Usuarios
Route::GET('/Usuarios', 'UserController@index')->name('users.index')->middleware('auth');
Route::GET('/Usuarios/buscar/secondItem/{secondItem}', 'UserController@findByRole')->middleware('auth');
Route::GET('/Usuarios/buscar/nombre', 'UserController@search')->middleware('auth');
Route::POST('/Usuarios/actualizar', 'UserController@actualizar')->middleware('auth');

Route::POST('/Usuarios/crear', 'UserController@store')->middleware('auth');
Route::delete('/Usuarios/borrar', 'UserController@destroy')->middleware('auth');
Route::GET('/Usuarios/buscar/id', 'UserController@GETUserById')->middleware('auth');

// Administración de Roles
Route::GET('/Roles', 'RoleController@index')->name('roles.index')->middleware('auth');
Route::GET('/Roles/buscar/secondItem/{secondItem}', 'RoleController@findByPermission')->middleware('auth');
Route::GET('/Roles/buscar/nombre', 'RoleController@search')->middleware('auth');
Route::POST('/Roles/actualizar', 'RoleController@actualizar')->middleware('auth');

Route::POST('/Roles/crear', 'RoleController@store')->middleware('auth');
Route::delete('/Roles/borrar', 'RoleController@destroy')->middleware('auth');
Route::GET('/Roles/buscar/id', 'RoleController@GETRoleById')->middleware('auth');

// Administración de Permisos
Route::GET('/Permisos', 'PermissionController@index')->name('permissions.index')->middleware('auth');
Route::GET('/Permisos/buscar/secondItem/{secondItem}', 'PermissionController@findByRole')->middleware('auth');
Route::GET('/Permisos/buscar/nombre', 'PermissionController@search')->middleware('auth');
Route::POST('/Permisos/actualizar', 'PermissionController@actualizar')->middleware('auth');

Route::POST('/Permisos/crear', 'PermissionController@store')->middleware('auth');
Route::delete('/Permisos/borrar', 'PermissionController@destroy')->middleware('auth');
Route::GET('/Permisos/buscar/id', 'PermissionController@GETPermissionById')->middleware('auth');

// Administración de Empresas
Route::GET('/Empresa', 'CompanyController@index')->name('company.index')->middleware('auth');
Route::GET('/Empresa/buscar/secondItem/{secondItem}', 'CompanyController@findByRole')->middleware('auth');
Route::GET('/Empresa/buscar/nombre', 'CompanyController@search')->middleware('auth');
Route::POST('/Empresa/actualizar', 'CompanyController@actualizar')->middleware('auth');

Route::POST('/Empresa/crear', 'CompanyController@store')->middleware('auth');
Route::delete('/Empresa/borrar', 'CompanyController@destroy')->middleware('auth');
Route::GET('/Empresa/buscar/id', 'CompanyController@GETCompanyById')->middleware('auth');

// Finanzas
Route::GET('/Cobranza', 'BillingController@billing')->name('billing.index')->middleware('auth');
Route::GET('/Cobranza/buscar/nombre', 'BillingController@searchBilling')->middleware('auth');
Route::GET('/Facturacion', 'BillingController@invoices')->name('billing.index')->middleware('auth');
Route::GET('/Facturacion/buscar/nombre', 'BillingController@searchInvoices')->middleware('auth');


//--AdminController
Route::GET('/Blog', function(){      return redirect('/Blog/categories');     });
Route::GET('/Admin_Blog', function(){      return redirect('/Admin_Blog/categories');     })->middleware('auth');
Route::GET('/Blog/categories', 'AdminController@blogCategoriesIndex')->name('AdminController.blogCategoriesIndex');
Route::GET('/Admin_Blog/categories', 'AdminController@blogCategoriesIndex')->name('AdminController.blogCategoriesIndex')->middleware('auth');
Route::POST('/Admin_Blog/categories/postImg', 'AdminController@blogCategoriesPostImg')->name('AdminController.blogCategoriesPostImg')->middleware('auth');
Route::POST('/Admin_Blog/categories/create', 'AdminController@blogCategoriesCreate')->name('AdminController.blogCategoriesCreate')->middleware('auth');
Route::POST('/Admin_Blog/categories/update', 'AdminController@blogCategoriesUpdate')->name('AdminController.blogCategoriesUpdate')->middleware('auth');
Route::POST('/Admin_Blog/categories/toggle', 'AdminController@blogCategoriesToggle')->name('AdminController.blogCategoriesToggle')->middleware('auth');

Route::GET('/Blog/post/show/{url}', 'AdminController@blogPostIndex')->name('AdminController.blogPostIndex');
Route::GET('/Blog/post/single/{url}', 'AdminController@blogPostSingle')->name('AdminController.blogPostSingle');
Route::POST('/Blog/like/toggle', 'AdminController@blogLikeToggle')->name('AdminController.blogLikeToggle');
Route::GET('/Admin_Blog/post/show/{url}', 'AdminController@blogPostIndex')->name('AdminController.blogPostIndex')->middleware('auth');
Route::GET('/Admin_Blog/post/single/{url}', 'AdminController@blogPostSingle')->name('AdminController.blogPostSingle')->middleware('auth');
Route::GET('/Admin_Blog/post/create', 'AdminController@blogPostCreate')->name('AdminController.blogPostCreate')->middleware('auth');
Route::POST('/Admin_Blog/post/store', 'AdminController@blogPostStore')->name('AdminController.blogPostStore')->middleware('auth');
Route::POST('/Admin_Blog/post/toggle', 'AdminController@blogPostToggle')->name('AdminController.blogPostToggle')->middleware('auth');
Route::GET('/Admin_Blog/post/update/{id}', 'AdminController@blogPostUpdate')->name('AdminController.blogPostUpdate')->middleware('auth');
Route::POST('/Admin_Blog/like/toggle', 'AdminController@blogLikeToggle')->name('AdminController.blogLikeToggle')->middleware('auth');

// Route::GET('/Recursos', 'AdminController@resourcesIndex')->name('AdminController.resourcesIndex')->middleware('auth');
// Route::GET('/Admin_Recursos', 'AdminController@resourcesIndex')->name('AdminController.resourcesIndex')->middleware('auth');
// Route::POST('/Admin_Recursos/resPostFile', 'AdminController@resPostFile')->name('AdminController.resPostFile')->middleware('auth');
// Route::POST('/Admin_Recursos/store', 'AdminController@resStore')->name('AdminController.resStore')->middleware('auth');
// Route::POST('/Admin_Recursos/update', 'AdminController@resUpdate')->name('AdminController.resUpdate')->middleware('auth');
// Route::POST('/Admin_Recursos/delete', 'AdminController@resDelete')->name('AdminController.resDelete')->middleware('auth');
// Route::POST('/Admin_Recursos/resDownPlus', 'AdminController@resDownPlus')->name('AdminController.resDownPlus')->middleware('auth');
Route::GET('/Admin_Audios', 'ResourcesController@admin_audios_index')->name('ResourcesController.admin_audios_index')->middleware('auth');
Route::GET('/Admin_Audios/new_category', 'ResourcesController@admin_audio_form_category_create')->name('ResourcesController.admin_audio_form_category_create')->middleware('auth');
Route::POST('/Admin_Audios/new_category/save', 'ResourcesController@admin_audio_form_category_create_save')->name('ResourcesController.admin_audio_form_category_create_save')->middleware('auth');
Route::GET('/Admin_Audios/upd_category/{id_cat}', 'ResourcesController@admin_audio_form_audio_update')->name('ResourcesController.admin_audio_form_audio_update')->middleware('auth');
Route::POST('/Admin_Audios/upd_category/save', 'ResourcesController@admin_audio_form_category_update_save')->name('ResourcesController.admin_audio_form_audio_update_save')->middleware('auth');

Route::GET('/Admin_Audios/new_audio/{id_cat}', 'ResourcesController@admin_audio_form_audio_create')->name('ResourcesController.admin_audio_form_audio_create')->middleware('auth');
Route::POST('/Admin_Audios/new_audio/save', 'ResourcesController@admin_audio_form_audio_create_save')->name('ResourcesController.admin_audio_form_audio_create_save')->middleware('auth');
Route::POST('/Admin_Audios/delete_audio', 'ResourcesController@delete_audio')->name('ResourcesController.delete_audio')->middleware('auth');
Route::GET('/Admin_Audios/mod_audio/{id}', 'ResourcesController@mod_audio')->name('ResourcesController.mod_audio')->middleware('auth');
Route::POST('/Admin_Audios/mod_audio/save', 'ResourcesController@mod_audio_save')->name('ResourcesController.mod_audio_save')->middleware('auth');

Route::GET('/Admin_Videos', 'ResourcesController@admin_videos_index')->name('ResourcesController.admin_videos_index')->middleware('auth');
Route::GET('/Admin_Videos/new_video', 'ResourcesController@admin_videos_form_create')->name('ResourcesController.admin_videos_form_create')->middleware('auth');
Route::POST('/Admin_Videos/new_video/save', 'ResourcesController@admin_videos_form_save')->name('ResourcesController.admin_videos_form_save')->middleware('auth');
Route::POST('/Admin_Videos/delete_video', 'ResourcesController@delete_video')->name('ResourcesController.delete_video')->middleware('auth');
Route::GET('/Admin_Videos/upd_video/{id}', 'ResourcesController@upd_video')->name('ResourcesController.upd_video')->middleware('auth');
Route::POST('/Admin_Videos/upd_video/save', 'ResourcesController@upd_video_save')->name('ResourcesController.upd_video_save')->middleware('auth');

Route::GET('/Perfil', 'AdminController@perfilIndex')->name('AdminController.perfilIndex')->middleware('auth');
Route::POST('/Perfil/upload', 'AdminController@perfilUploadFile')->name('AdminController.perfilUploadFile')->middleware('auth');
Route::POST('/Perfil/update', 'AdminController@perfilUpdate')->name('AdminController.perfilUpdate')->middleware('auth');

Route::GET('/Clientes', 'AdminController@clientIndex')->name('AdminController.clientIndex')->middleware('auth');
Route::POST('/Clientes/update', 'AdminController@clientUpdate')->name('AdminController.clientUpdate')->middleware('auth');

//--ProvisionalController
Route::GET('/provisional', 'ProvisionalController@index')->name('ProvisionalController.index');
Route::POST('/provisional', 'ProvisionalController@store')->name('ProvisionalController.store');

// Calendar Controllers
Route::resource('Calendario', 'SessionController')->middleware('auth');
// Route::post('/Calendario/actualizar', 'SessionController@edit')->name('Calendario.edit')->middleware('auth');
// Route::post('/Calendario/status', 'SessionController@editStatus')->name('Calendario.editStatus')->middleware('auth');
// Route::post('/Calendario/configurar', 'SessionController@config')->name('Calendario.config')->middleware('auth');
//Session controller
Route::GET('/Sesiones', 'SessionController@main_view')->name('Session.main_view')->middleware('auth');
Route::GET('/Sesiones/videollamada', 'SessionController@call_view')->name('Session.call_view')->middleware('auth');


// Goal routes
Route::GET('/Seguimiento', 'GoalController@index')->name('goal.index')->middleware('auth');
Route::POST('/Seguimiento/vision', 'GoalController@updateVision')->middleware('auth');
Route::POST('/Seguimiento/meta', 'GoalController@updateGoal')->middleware('auth');
Route::POST('/Seguimiento/meta_completada', 'GoalController@updateCompleted')->middleware('auth');

// Chat controller
Route::GET('/Chat', 'ChatController@index')->name('chat.index')->middleware('auth');
Route::POST('Chat/msg_submit', 'ChatController@msg_submit')->name('chat.msg_submit')->middleware('auth');
Route::GET('Chat/msg_get/{id_client}', 'ChatController@msg_get')->name('chat.msg_get')->middleware('auth');
Route::GET('Chat/admin_chats_get/{id_support}', 'ChatController@admin_chats_get')->name('chat.admin_chats_get')->middleware('auth');
Route::POST('Chat/get_this_client_chats', 'ChatController@get_this_client_chats')->name('chat.get_this_client_chats')->middleware('auth');
Route::POST('Chat/close_chat_ticket', 'ChatController@close_chat_ticket')->name('chat.close_chat_ticket')->middleware('auth');



// Pago de Sesiones
Route::GET('/Pago', 'PayController@index')->name('pay.index')->middleware('auth');


Route::GET('/home', 'HomeController@index')->name('home');
Auth::routes();
