<?php

use ServiceTracker\Repositories\TicketRepo;
use ServiceTracker\Repositories\CategoryRepo;

class HomeController extends BaseController {

	protected $categoryRepo;
	protected $ticketRepo;
    
	public function __construct(CategoryRepo $categoryRepo,
								TicketRepo $ticketRepo)
	{
		$this->categoryRepo = $categoryRepo;
		$this->ticketRepo = $ticketRepo;
        //$this->userRepo = $userRepo;
	}

	public function index()
	{
		$user = Auth::user();
        $categories=$this->categoryRepo->getList();
        if (is_null ($categories))
        {
           return 'error no existe';
            App::abort(404);
        }
		$recents_tickets = $this->ticketRepo->recents();
        return View::make('home',compact ('recents_tickets','categories','user'));
		//return View::make('home');//,compact ('latest_tickets'));
	}

}
 