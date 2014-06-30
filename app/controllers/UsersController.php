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

	public function signUp()
    {
        //$fieldBuilder = new \ServiceTracker\Components\FieldBuilder();
        return View::make('users/sign-up');
    }

    public function register()
    {
    	$user = $this->ticketRepo->newTicket();
        $manager = new RegisterManager($user, Input::all());

        $manager->save();
        return Redirect::route('home');
        //return Redirect::back()->withInput()->withErrors($manager->getErrors());
    }

    public function account()
    {
        $user = Auth::user();
        return View::make('users/account', compact('user'));
    }

    public function updateAccount()
    {
        $user = Auth::user();
        $manager = new AccountManager($user, Input::all());

        $manager->save();

        return Redirect::route('home');
    }

        public function profile()
    {
        $user = Auth::user();
        $ticket = $user->ticket;
        return View::make('users/profile', compact('user', 'ticket'));
    }

    public function updateProfile()
    {
        $user = Auth::user();
        $ticket = $user->ticket;
        $manager = new ProfileManager($user, Input::all());

        $manager->save();

        return Redirect::route('home');
    }

   

}