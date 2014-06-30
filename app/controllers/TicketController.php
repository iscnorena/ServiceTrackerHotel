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
        //$this->userRepo = $userRepo;
	}

	public function category($slug, $id)
	{
		//var_dump($slug);
		$category = $this->categoryRepo->find($id);

		$this->notFoundUnless($category); 

		return View::make('tickets/category', compact('category'));
		//var_dump($slug);
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
        
        //return 'Aqui editamos el usuario: ' . $id;
        $ticket = $this->ticketRepo->find($id);
        $id_user = $ticket->user_id;
        $user = $this->ticketRepo->findUser($id_user);
        $categories=$this->categoryRepo->getList();
        //$queja = Queja::find($id);
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
        //return Input::all();
        $manager = new AccountTManager($ticket, Input::all());

        $manager->save();

        return Redirect::route('home');
    }

    public function deleteTicket($id)
    {
        
        //return "Eliminando el registro $id";
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
        

        /*
        User::destroy($id);
        return Redirect::route('admin.users.index');
        */
    }

    public function resolvedTicket($id)
    {
        $ticket = $this->ticketRepo->find($id);
        $input = $ticket;
        //forzamos que sea el id del usuario logueado
        $input['status'] = 'resuelto';
        $manager = new AccountRManager($ticket, $input);

        $manager->save();

        return Redirect::route('home');
    }


    public function signUp()
    {
        $user = Auth::user();

        //$user = $user->id;
        //return 'esto es user:'.$user;
        //return 'Aqui creamos el ticket: ' . $id;
        //$user=$this->userRepo->getUser();
        //$user = Auth::user();
        $categories=$this->categoryRepo->getList();
        if (is_null ($categories))
        {
           return 'error no existe';
            App::abort(404);
        }

        return View::make('tickets/sign-up',compact ('categories','user'));




        //$fieldBuilder = new \ServiceTracker\Components\FieldBuilder();
        //return View::make('tickets/sign-up');
    }

    public function register()
    {
        $user = Auth::user();
        $input = Input::all();
        //forzamos que sea el id del usuario logueado
        $input['user_id'] = $user->id;
    	$ticket = $this->ticketRepo->newTicket2();
    	//return var_dump(Input::all());
        $manager = new RegisterTManager($ticket, $input);

        $manager->save();
        return Redirect::route('home');
        //return Redirect::back()->withInput()->withErrors($manager->getErrors());
    }

    public function latest()
    {
        $latest_tickets = $this->ticketRepo->latest();
        return View::make('latest',compact ('latest_tickets'));
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
        $tickets = $this->ticketRepo->listAll2();
        return View::make ('tickets/list')->with('tickets', $tickets);
    }


}

