<?php

namespace ServiceTracker\Repositories;

use ServiceTracker\Entities\Ticket;
use ServiceTracker\Entities\Category;
use ServiceTracker\Entities\User;

class TicketRepo extends BaseRepo {

    public function getModel()
    {
        return new Ticket;
    }

    /*funciones de usercontroller*/
    public function newUser()
    {
        $user = new User();
        $user->type = 'usuario';
        return $user;
    }
    public function listAllUser()
    {
        $users = User::paginate();
        return $users;
    }
    /*-----------------------------*/

    public function recents()
    {
        return Ticket::orderBy('created_at','desc')->paginate();        
    }

    public function getidCategory($slug)
    {
        return Category::where('slug', '=', $slug)->first();
    }

    public function oneCategory($id, $take=10)
    {
        return Ticket::where('category_id', '=', $id)->orderBy('created_at','desc')->paginate();           
    }

    public function newTicket()
    {

        $ticket = new Ticket();
        $ticket->status = 'en_proceso';
        return $ticket;
    }

        public function newTicket0()
    {
        $ticket = new Ticket();
        return $ticket;
    }

    public function newTicket3()
    {
        $ticket = new Ticket();
        return $ticket;
    }

    public function listAll()
    {
        $tickets = Ticket::paginate();
        return $tickets;
    }

    public function findUser($id)
    {

        $user = new User();
        return $user->find($id);
    }

    public function getFloor($room)
    {
        if (strlen($room)==4)
        {
            $piso=substr($room,0, 2);
        }   
        elseif (strlen($room)==3)
        {
            $piso=substr($room,0, 1);
        }
        else
        {
            $piso="cualquier cosa qeu o es piso";  
        }
        return $piso;
    }

    public function reports($take = 10)
    {
        return Ticket::orderBy('created_at','desc')->paginate();        
    }

    public function reportsPdf()
    {
        return Ticket::orderBy('created_at','desc')->paginate();       
    }

    public function searchTop($campo,$datei,$datef)
    {
        $campo = 'request';
        $datei = '2014-01-01';
        $datef = '2014-07-09';
        return \DB::select('SELECT request , COUNT(*) as solicitudes FROM tickets GROUP BY ? ORDER BY solicitudes desc',array($campo));

        //return Ticket::orderBy($campo,'desc')->take(10)-get($campo,); 
        //return \DB::select('SELECT ? , COUNT(*) as solicitudes FROM tickets WHERE created_at >= ? && created_at <= ? GROUP BY ? ORDER BY solicitudes desc',array($campo,$datei,$datef,$campo));
        //return \DB::select('SELECT * FROM tickets',array(''));
        //return \DB::table('tickets')->select($campo,$campo.' as solicitudes')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->take(10)->get();
        //return Ticket::orderBy($campo,'desc')->take(10)->count(); 
        //return \DB::table('tickets')->get();
        // En este caso ? será remplazado por las variables
        // SELECT * FROM carros WHERE color = 'Blanco'

    }

    public function searchReport($room,$name,$status,$datei,$datef,$take = 10)
    {
        //return $status;
        //$usuarios = DB::table('usuarios')->where('sexo', '=', 'M')->get();
        // SELECT * FROM usuarios WHERE sexo = 'M'
        //$resultado = DB::table('carros')->where('color', '=', 'Verde')->get(array('id', 'modelo', 'color'));
        //$resultado = Carros::where('color', '=', 'Verde')->get(array('id', 'modelo', 'color'));

        //Se dejaron en blanco todos los campos
        if (strlen($room)==0 && strlen($name)==0 && $status=='todos')
        {   
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::orderBy('created_at','desc')->paginate();  
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate();  
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
        }
        elseif(strlen($room)!=0 && strlen($name)==0 && $status=='todos')
        {   
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
                
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status=='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
                        
        }
        elseif(strlen($room)==0 && strlen($name)==0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate();                
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status=='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
                     
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate();
            }
            
        }
        else 
        {
            //return 'no entro a ningun lado';
            return Ticket::orderBy('created_at','desc')->paginate(); 
        } 
    }

    public function searchReportPdf($room,$name,$status,$datei,$datef,$take = 10)
    {
        $pagepdf = 100;
        //return $status;
        //$usuarios = DB::table('usuarios')->where('sexo', '=', 'M')->get();
        // SELECT * FROM usuarios WHERE sexo = 'M'
        //$resultado = DB::table('carros')->where('color', '=', 'Verde')->get(array('id', 'modelo', 'color'));
        //$resultado = Carros::where('color', '=', 'Verde')->get(array('id', 'modelo', 'color'));

        //Se dejaron en blanco todos los campos
        if (strlen($room)==0 && strlen($name)==0 && $status=='todos')
        {   
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::orderBy('created_at','desc')->paginate($pagepdf);  
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate($pagepdf);  
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
        }
        elseif(strlen($room)!=0 && strlen($name)==0 && $status=='todos')
        {   
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
                
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status=='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
                        
        }
        elseif(strlen($room)==0 && strlen($name)==0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate($pagepdf);                
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status=='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
                     
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('created_at','desc')->paginate($pagepdf);
            }
            
        }
        else 
        {
            //return 'no entro a ningun lado';
            return Ticket::orderBy('created_at','desc')->paginate($pagepdf); 
        } 
    }

} 