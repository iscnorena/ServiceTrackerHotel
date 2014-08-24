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
        $user = Auth::user();
        //$id_user = $ticket->user_id;
        //$user = $this->ticketRepo->findUser($id_user);
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
        $input = Input::all();
        $status = $input['status'];
        if ($status == 'en_proceso')
        {
            $input['minutes'] = '';
            $date = date("Y-m-d G:i:s");
            $input['created_at'] = date("Y-m-d G:i:s");
            //echo $input['created_at'];
        }
        elseif ($status == 'resuelto')
        {
            $created_at = $ticket['created_at'];
            $date = date("Y-m-d G:i:s");
            $ticket['resolved_at'] = $date;
            $sec =strtotime($date) - strtotime($created_at);
            $min = intval($sec/60);
            $input['minutes'] = $min;
        }
        //Capitalizar Campos
        $input['name_guest'] = ucfirst( strtolower($input['name_guest']) );
        $input['request'] = ucfirst( strtolower($input['request']) );
        $input['report_by'] = ucfirst( strtolower($input['report_by']) );
        $input['attend_by'] = ucfirst( strtolower($input['attend_by']) );
        //forzamos que sea el id del usuario logueado sea el de update_by
        //$input['update_by'] = $user->id;
        $manager = new AccountTManager($ticket, $input);
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
        $created_at = $ticket['created_at'];
        $date = date("Y-m-d G:i:s");
        $ticket['resolved_at'] = $date;
        $sec =strtotime($date) - strtotime($created_at);
        $min = intval($sec/60);
        $ticket['minutes'] = $min;
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
        //Capitalizar Campos
        $input['name_guest'] = ucfirst( strtolower($input['name_guest']) );
        $input['request'] = ucfirst( strtolower($input['request']) );
        $input['report_by'] = ucfirst( strtolower($input['report_by']) );
        $input['attend_by'] = ucfirst( strtolower($input['attend_by']) );
        //Obtener Piso a partir de la hab
        $room = $input['room'];
        $input['floor'] = $this->ticketRepo->getFloor($room);
    	//return $input['floor'];
        $ticket = $this->ticketRepo->newTicket();
        $manager = new RegisterTManager($ticket, $input);
        $manager->save();
        return Redirect::route('home');
    }

    public function recents()
    {
        $recents_tickets = $this->ticketRepo->recents();
        foreach ($recents_tickets as $ticket => &$val)     
        {
            //echo $ticket;
            //echo $val['notes'];
            $val['notes'] = $this->ticketRepo->cutText($val['notes'],10);
            //echo $val['notes'];
            //echo "--------------otro-----------";
            //$ticket->notes = $this->ticketRepo->cutText($ticket->notes,3);
        }
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
        $datei = $input['datei'];
        $datef = $input['datef'];
        //return 'status: '.$status.' room: '.$room.' name: '.$name;
        //$recents_tickets = $this->ticketRepo->search($room,$name,$status);
        $recents_tickets = $this->ticketRepo->searchReport($room,$name,$status,$datei,$datef);
        return View::make('tickets/search',compact ('recents_tickets'));
    }

    public function reportsView()
    {   
        //check which submit was clicked on
        if(Input::get('buscar')) 
        {
            $input = Input::all();
            $room = $input['room'];
            $name = $input['name_guest'];
            $status = $input['status'];
            $datei = $input['datei'];
            $datef = $input['datef'];
            //return 'status: '.$status.' room: '.$room.' name: '.$name;
            //return 'datei : '.$datei.'------datef: '.$datef;
            $reports_tickets = $this->ticketRepo->searchReport($room,$name,$status,$datei,$datef);
            return View::make('tickets/reports',compact ('reports_tickets'));            
        } 
        elseif(Input::get('pdf')) 
        {
            $input = Input::all();
            $room = $input['room'];
            $name = $input['name_guest'];
            $status = $input['status'];
            $datei = $input['datei'];
            $datef = $input['datef'];
            //return 'status: '.$status.' room: '.$room.' name: '.$name;
            //return 'datei : '.$datei.'------datef: '.$datef;
            $reports_tickets = $this->ticketRepo->searchReportPdf($room,$name,$status,$datei,$datef);
            $pdf = PDF::loadView('search2',compact ('reports_tickets'));
            return $pdf->stream();
        }



        
    }

    public function reportsTicket()
    {
        $reports_tickets = $this->ticketRepo->reports();
        return View::make('tickets/reports',compact ('reports_tickets'));
    }

    public function reportspdfTicket()
    {

        //$recents_tickets = $this->ticketRepo->recents();
        //$user = Auth::user();
        $reports_tickets = $this->ticketRepo->reportsPdf();
        //return 'status: '.$status.' room: '.$room.' name: '.$name;

        //$pdf->loadFile(public_path().'\mypdf1.html'); 
        //$html = View::make('hello');

        //$recents_tickets = $this->ticketRepo->recents();
        //$data = Model::findOrFail($id);
        //$pdf = PDF::loadView('hello');
        $pdf = PDF::loadView('search2',compact ('reports_tickets'));
        return $pdf->stream();

        //$pdf = App::make('dompdf');
        //$pdf->loadFile(public_path().'\mypdf.html');
        //$pdf->loadHTML('<h1>Test</h1>');
        //$pdf->loadHTML($html);
        //return $pdf->stream();
    }
    public function topView()
    {   
        $input = Input::all();
        $campo = $input['room'];
        $name = $input['name_guest'];
        $status = $input['status'];
        $datei = $input['datei'];
        $datef = $input['datef'];
        //return 'status: '.$status.' room: '.$room.' name: '.$name;
        //return 'datei : '.$datei.'------datef: '.$datef;
        $reports_tickets = $this->ticketRepo->searchReport($room,$name,$status,$datei,$datef);
        return View::make('tickets/reports',compact ('reports_tickets'));
    }

    public function topTicket()
    {
        //$input = Input::all();
        $campo = 'request';
        $datei = '2014-01-01';
        $datef = '2014-07-09';
        $top_tickets = $this->ticketRepo->searchTop($campo,$datei,$datef);
        //return $top_tickets;
        return View::make('tickets/top',compact ('top_tickets'));
    }

    public function searchDirectory()
    {
        $user = Auth::user();
        return View::make('search3',compact ('user'));
    }
}

