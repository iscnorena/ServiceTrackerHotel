<?php

use ServiceTracker\Entities\Directory;
use ServiceTracker\Managers\RegisterDManager;
use ServiceTracker\Repositories\DirectoryRepo;
use ServiceTracker\Managers\AccountDManager;
 
class DirectoryController extends BaseController {

	protected $directoryRepo;

    public function __construct(DirectoryRepo $directoryRepo)
    {
        $this->directoryRepo = $directoryRepo;
    }
    /*
    Funcion GET muestra el formulario para dar de alta un nuevo usuario
    Se envia el objeto del Usuario Logeado
    */
	public function signUp()
    {
        $user = Auth::user();
        return View::make('directory/sign-up', compact('user'));
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
    	$tel = $this->directoryRepo->newTel();
        $manager = new RegisterDManager($tel, Input::all());

        $manager->save();
        return Redirect::route('home');
        //return Redirect::back()->withInput()->withErrors($manager->getErrors());
    }


    /*
    Funcion GET muestra una lista de los usuario de la DB
    Se envia el objeto del Usuario Logeado y un listado de usuarios
    */
    public function listAll()
    {   
        $user = Auth::user();
        $tel_all = $this->directoryRepo->listAllTel();
        return View::make ('directory/list',compact ('tel_all','user'));
    }

    /*
    Funcion GET muestra el formulario para editar un usuario
    Se envia el objeto del Usuario Logeado, se envia el objeto del usuario a editar
    */
    public function edit($id)
    {
        $user = Auth::user();
        $tel = $this->directoryRepo->findTel($id);
        return View::make('directory/sign-up2',compact ('tel','user'));    
    }

    /*
    Funcion PUT para guardar en la DB la actualizacion del usuario 
    Se envia el  objeto usuario editado y se valida con el manager
    al finalizar se redirecciona al HOME (/)
    */
    public function update($id)
    {
        $tel = $this->directoryRepo->findTel($id);
        //$directory = $this->directoryRepo->find($id);
        $input = Input::all();
        //forzamos que sea el id del usuario logueado sea el de update_by
        //$input['update_by'] = $user->id;
        $manager = new AccountDManager($tel, $input);
        $manager->save();

        return Redirect::route('home');
    }
   

}

             
/*

    if ($tel->exists):
        // $form_data = array('route' => array('admin.users.update', $user->id), 'method' => 'PATCH');
        $form_data = array('route'=> array('update-tel',$tel->id) , 'method' => 'PUT');
        $action    = 'Editar';
    else:
        // $form_data = array('route' => 'admin.users.store', 'method' => 'POST');
        $form_data = array('route'=> array('register-tel'), 'method' => 'POST');
        $action    = 'Crear';        
    endif;

*/