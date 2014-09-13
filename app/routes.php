<?php
//Index
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('tickets/{slug}/{id}', ['as' => 'category', 'uses' => 'TicketController@category']);

Route::get('last-ticket', ['as' => 'recent-ticket', 'uses' => 'TicketController@lastTicket']);

Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);



/*********** usuarios ****************/
//nuevo
Route::get('sign-up', ['as' => 'sign_up', 'uses' => 'UsersController@signUp']);
Route::post('sign-up', ['as' => 'register', 'uses' => 'UsersController@register']);
//lista
Route::get('list', ['as' => 'list-user', 'uses' => 'UsersController@listAll']);
//edit
Route::get('users/{id}', ['as' => 'edit-user', 'uses' => 'UsersController@edit']);
Route::put('user/{id}', ['as' => 'update-user', 'uses' => 'UsersController@updateUser']);


/*********** tickets ****************/
//Nuevo Ticket
Route::get('new-ticket', ['as' => 'new-ticket', 'uses' => 'TicketController@signUp']);
Route::post('new-ticket', ['as' => 'register-ticket', 'uses' => 'TicketController@register']);
//edit and update
Route::put('ticket/{id}', ['as' => 'update-ticket', 'uses' => 'TicketController@updateTicket']);
//Busqueda
Route::get('search2', ['as' => 'search-ticket', 'uses' => 'TicketController@searchTicket']);
Route::post('search2', ['as' => 'searchview-ticket', 'uses' => 'TicketController@searchView']);
//Lista de todos los tickets
Route::get('list-ticket', ['as' => 'list-ticket', 'uses' => 'TicketController@listAll']);
//Ultimos Tickets
Route::get('recents-ticket', ['as' => 'recents-ticket', 'uses' => 'TicketController@recents']);
//acciones
Route::get('show/{id}', ['as' => 'ticket', 'uses' => 'TicketController@show']);
Route::get('tickets/{id}', ['as' => 'edit-ticket', 'uses' => 'TicketController@edit']);
Route::delete('delete/{id}', ['as' => 'delete-ticket', 'uses' => 'TicketController@deleteTicket']);
Route::get('resolved/{id}', ['as' => 'resolved-ticket', 'uses' => 'TicketController@resolvedTicket']);
//Reportes
Route::get('reports', ['as' => 'reports-ticket', 'uses' => 'TicketController@reportsTicket']);
Route::post('reports', ['as' => 'reportsview-ticket', 'uses' => 'TicketController@reportsView']);
//TOP
Route::get('reports/top', ['as' => 'top-ticket', 'uses' => 'TicketController@topTicket']);
Route::post('reports/top', ['as' => 'topview-ticket', 'uses' => 'TicketController@topView']);
//Reportes PDF
Route::get('reports/pdf', ['as' => 'reports-pdf', 'uses' => 'TicketController@reportspdfTicket']);

Route::post('reports/tickets', array('uses' => 'TicketController@reportsView'));
//TEST TICKETS


/*********** Directory ****************/
//Directory
//nuevo
Route::get('directory/sign-up', ['as' => 'sign_up-tel', 'uses' => 'DirectoryController@signUp']);
Route::post('directory/sign-up', ['as' => 'register-tel', 'uses' => 'DirectoryController@register']);
//lista
Route::get('directory/list', ['as' => 'list-tel', 'uses' => 'DirectoryController@listAll']);
//edit
Route::get('directory/{id}', ['as' => 'edit-tel', 'uses' => 'DirectoryController@edit']);
Route::put('directory/{id}', ['as' => 'update-tel', 'uses' => 'DirectoryController@update']);

//busqueda
Route::get('search-directory', ['as' => 'directory-search', 'uses' => 'TicketController@searchDirectory']);
Route::get('res', function (){
    $name = Input::get ('name');
    $users = ServiceTracker\Entities\Directory::where('full_name','LIKE','%'.$name.'%')->take(20)->get();
    return Response::json($users);
});

//Back
Route::get('back', function (){
   return Redirect::back();
});
Route::get('back', ['as' => 'back', 'uses' => 'HomeController@backPage']);

//Experimentales
//Route::get('latest-ticket', ['as' => 'latest-ticket', 'uses' => 'TicketController@latest']);
//Route::get('top-ticket', ['as' => 'top-ticket', 'uses' => 'TicketController@top']);
//Route::get('profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
//Route::put('profile', ['as' => 'update_profile', 'uses' => 'UsersController@updateProfile']);


Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);

// Formularios
Route::group(['before' => 'auth'], function () 
{
  //formularios editar perfil
  Route::get('account', ['as' => 'account', 'uses' => 'UsersController@account']);
  Route::put('account', ['as' => 'update_account', 'uses' => 'UsersController@updateAccount']);
  // Admin routes
  Route::group(['before' => 'is_admin'], function () 
  {
      //requiere servira para colocar los Route dentro de una archivo php
      //y asi poder tener mas limpio este archivo
      //require (__DIR__ . '/routes/admin.php');
      Route::get('admin/candidate/{id}', ['as' => 'admin_candidate_edit', function ($id) {
      return 'Editando el candidato ' . $id;
      }]);
  });
});


/*********** Experimentales ****************/

/*
Route::get('search', function (){
   return View::make('search3');
});
*/

Route::get('autocomplete', function (){
   return View::make('autocomplete');
});

//PDF DOMPDF de BAridhv
Route::get('pdf', function (){
    $pdf = App::make('dompdf');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();

   //return View::make('pdf');
});