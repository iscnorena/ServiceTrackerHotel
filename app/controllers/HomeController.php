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
		if ($user['type']=='depto')
		{
			//$recents_tickets = $this->ticketRepo->recents();
			//$categories=$this->categoryRepo->getList();
			//$view = $user['view'];
			//return $user;
			$slug=$user['view'];
			$category_id = $this->ticketRepo->getidCategory($slug);
			//return $category['id'];
			//return $view;
			$id=$category_id['id'];
			$onecategory_tickets = $this->ticketRepo->oneCategory($id);
			//return $onecategory_tickets;
        	return View::make('depto',compact ('onecategory_tickets','user'));
			//return 'eres visitante';
		}
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

	public function backPage()
	{
		return Redirect::back();
	}

}
 