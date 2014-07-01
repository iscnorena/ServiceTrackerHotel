<?php
use ServiceTracker\Repositories\CategoryRepo;
use ServiceTracker\Repositories\TicketRepo;
use ServiceTracker\Managers\RegisterTManager;
use ServiceTracker\Managers\AccountTManager;
use ServiceTracker\Managers\AccountRManager;

class TicketController extends BaseController {

	protected $categoryRepo;
	protected $ticketRepo;
    
	public function __construct(CategoryRepo $categoryRepo,
								TicketRepo $ticketRepo)
	{
		$this->categoryRepo = $categoryRepo;
		$this->ticketRepo = $ticketRepo;
	}

	public function category($slug, $id)
	{
		$category = $this->categoryRepo->find($id);
		$this->notFoundUnless($category); 
		
        return View::make('tickets/category', compact('category'));
	}

	public function show($id)
    {   
        $ticket = $this->ticketRepo->find($id);
        $id_user = $ticket->user_id;
        $user = $this->ticketRepo->findUser($id_user);
        $this->notFoundUnless($ticket);

        return View::make('tickets/show', compact('ticket','user'));
    }

    public function edit($id)
    {
        
        $ticket = $this->ticketRepo->find($id);
        $id_user = $ticket->user_id;
        $user = $this->ticketRepo->findUser($id_user);
        $categories=$this->categoryRepo->getList();
        if (is_null ($ticket))
        {
           return 'error no existe';
            App::abort(404);
        }

        return View::make('tickets/sign-up2',compact ('ticket', $ticket,'categories','user'));    
    }

    public function updateTicket($id)
    {
        $ticket = $this->ticketRepo->find($id);
        $manager = new AccountTManager($ticket, Input::all());
        $manager->save();

        return Redirect::route('home');
    }

    public function deleteTicket($id)
    {
        $ticket = $this->ticketRepo->find($id);
        if (is_null ($ticket))
        {
            return 'no existe model-ticket';
            App::abort(404);
        }
        $ticket->delete();
        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Ticket ' . $ticket->id . ' eliminado',
                'id'      => $ticket->id
            ));
        }
        else
        {
            return Redirect::route('home');
        }
    }

    public function resolvedTicket($id)
    {   
        $ticket = $this->ticketRepo->find($id);
        $ticket['status'] = 'resuelto';
        $ticket->save();

        return Redirect::route('home');
    }


    public function signUp()
    {
        $user = Auth::user();
        $categories=$this->categoryRepo->getList();
        if (is_null ($categories))
        {
           return 'error no existe';
            App::abort(404);
        }

        return View::make('tickets/sign-up',compact ('categories','user'));
    }

    public function register()
    {
        $user = Auth::user();
        $input = Input::all();
        //forzamos que sea el id del usuario logueado
        $input['user_id'] = $user->id;
    	$ticket = $this->ticketRepo->newTicket();
        $manager = new RegisterTManager($ticket, $input);
        $manager->save();
        return Redirect::route('home');
    }

    public function recents()
    {
        $recents_tickets = $this->ticketRepo->recents();
        return View::make('tickets/recents',compact ('recents_tickets'));
    }

    public function listAll()
    {   
        //$tickets = Ticket::all();
        //return View::make ('admin/quejas/list')->with('ejas', $quejas);
        $all_tickets = $this->ticketRepo->listAll();
        return View::make ('tickets/list',compact ('all_tickets'));
        //return View::make ('tickets/list')->with('alltickets', $tickets);
    }

    public function searchTicket()
    {   
        $recents_tickets = $this->ticketRepo->recents();
        return View::make('tickets/search',compact ('recents_tickets'));
    }

    public function searchView()
    {   
        $input = Input::all();
        $room = $input['room'];
        $name = $input['name_guest'];
        $status = $input['status'];
        //return 'status: '.$status.' room: '.$room.' name: '.$name;
        $recents_tickets = $this->ticketRepo->search($room,$name,$status);
        return View::make('tickets/search',compact ('recents_tickets'));
    }

}

