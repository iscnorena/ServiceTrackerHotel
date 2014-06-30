<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
  
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('tickets/{slug}/{id}', ['as' => 'category', 'uses' => 'TicketController@category']);

//Route::get('{slug}/{id}', ['as' => 'ticket', 'uses' => 'TicketController@show']);

//accedera al ticket con el id que es un valor unico
Route::get('show/{id}', ['as' => 'ticket', 'uses' => 'TicketController@show']);
Route::get('list-ticket', ['as' => 'list-ticket', 'uses' => 'TicketController@listAll']);
Route::get('tickets/{id}', ['as' => 'edit-ticket', 'uses' => 'TicketController@edit']);
Route::get('recents-ticket', ['as' => 'recents-ticket', 'uses' => 'TicketController@recents']);

Route::get('last-ticket', ['as' => 'recent-ticket', 'uses' => 'TicketController@lastTicket']);


Route::put('ticket/{id}', ['as' => 'update-ticket', 'uses' => 'TicketController@updateTicket']);
Route::delete('delete/{id}', ['as' => 'delete-ticket', 'uses' => 'TicketController@deleteTicket']);
Route::put('resolved/{id}', ['as' => 'resolved-ticket', 'uses' => 'TicketController@resolvedTicket']);


//Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::get('sign-up', ['as' => 'sign_up', 'uses' => 'UsersController@signUp']);
Route::post('sign-up', ['as' => 'register', 'uses' => 'UsersController@register']);

//Tickets
Route::get('new-ticket', ['as' => 'new-ticket', 'uses' => 'TicketController@signUp']);
Route::post('new-ticket', ['as' => 'register-ticket', 'uses' => 'TicketController@register']);
Route::get('latest-ticket', ['as' => 'latest-ticket', 'uses' => 'TicketController@latest']);
Route::get('top-ticket', ['as' => 'top-ticket', 'uses' => 'TicketController@top']);

//Route::get('profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
//Route::put('profile', ['as' => 'update_profile', 'uses' => 'UsersController@updateProfile']);

Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);


Route::group(['before' => 'guest'], function () {
    Route::get('sign-up', ['as' => 'sign_up', 'uses' => 'UsersController@signUp']);
    Route::post('sign-up', ['as' => 'register', 'uses' => 'UsersController@register']);

    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
    
});

// Formularios
Route::group(['before' => 'auth'], function () {
   //formularios
Route::get('account', ['as' => 'account', 'uses' => 'UsersController@account']);
Route::put('account', ['as' => 'update_account', 'uses' => 'UsersController@updateAccount']);


    // Admin routes

    Route::group(['before' => 'is_admin'], function () {
        //requiere servira para colocar los Route dentro de una archivo php
        //y asi poder tener mas limpio este archivo
        //require (__DIR__ . '/routes/admin.php');
        Route::get('admin/candidate/{id}', ['as' => 'admin_candidate_edit', function ($id) {

    return 'Editando el candidato ' . $id;
    }]);

    });

});

Route::get('search', function (){
   return View::make('search');
});

Route::get('results', function (){
    $name = Input::get ('name');
    $users = ServiceTracker\Entities\User::where('full_name','LIKE','%'.$name.'%')->take(20)->get();
    return Response ::json($users);

});


//PDF DOMPDF de BAridhv
Route::get('pdf', function (){
    $pdf = App::make('dompdf');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();

   //return View::make('pdf');
});