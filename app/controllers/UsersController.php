<?php

use ServiceTracker\Entities\User;
use ServiceTracker\Managers\RegisterManager;
use ServiceTracker\Repositories\TicketRepo;
use ServiceTracker\Managers\AccountManager;
 
class UsersController extends BaseController {

	protected $ticketRepo;

    public function __construct(TicketRepo $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }
    /*
    Funcion GET muestra el formulario para dar de alta un nuevo usuario
    Se envia el objeto del Usuario Logeado
    */
	public function signUp()
    {
        $user = Auth::user();
        return View::make('users/sign-up', compact('user'));
        //$fieldBuilder = new \ServiceTracker\Components\FieldBuilder();
        //return View::make('users/sign-up');
    }

    /*
    Funcion POST para guardar en la DB un nuevo usuario 
    Se crea un nuevo objeto usuario y se valida con el manager
    al finalizar se redirecciona al HOME (/)
    */
    public function register()
    {
    	$user = $this->ticketRepo->newUser();
        $manager = new RegisterManager($user, Input::all());

        $manager->save();
        return Redirect::route('home');
        //return Redirect::back()->withInput()->withErrors($manager->getErrors());
    }

    /*
    Funcion GET muestra el formulario para modificar el perfil del usuario
    Se envia el objeto del Usuario Logeado
    */
    public function account()
    {
        $user = Auth::user();
        return View::make('users/account', compact('user'));
    }

    /*
    Funcion PUT para guardar en la DB la actualizacion del perfil de usuario 
    Se envia el  objeto usuario logueado y se valida con el manager
    al finalizar se redirecciona al HOME (/)
    */
    public function updateAccount()
    {
        $user = Auth::user();
        $manager = new AccountManager($user, Input::all());

        $manager->save();

        return Redirect::route('home');
    }

    /*
    Funcion GET muestra una lista de los usuario de la DB
    Se envia el objeto del Usuario Logeado y un listado de usuarios
    */
    public function listAll()
    {   
        $user = Auth::user();
        $users = $this->ticketRepo->listAllUser();
        return View::make ('users/list',compact ('users','user'));
    }

    /*
    Funcion GET muestra el formulario para editar un usuario
    Se envia el objeto del Usuario Logeado, se envia el objeto del usuario a editar
    */
    public function edit($id)
    {
        $user = Auth::user();
        $user_edit = $this->ticketRepo->findUser($id);
        return View::make('users/sign-up2',compact ('user_edit','user'));    
    }

    /*
    Funcion PUT para guardar en la DB la actualizacion del usuario 
    Se envia el  objeto usuario editado y se valida con el manager
    al finalizar se redirecciona al HOME (/)
    */
    public function updateUser($id)
    {
        $user = $this->ticketRepo->findUser($id);
        //$ticket = $this->ticketRepo->find($id);
        $input = Input::all();
        //forzamos que sea el id del usuario logueado sea el de update_by
        //$input['update_by'] = $user->id;
        $manager = new AccountManager($user, $input);
        $manager->save();

        return Redirect::route('home');
    }
   

}
