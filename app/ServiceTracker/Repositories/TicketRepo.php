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

    public function recents($take = 10)
    {
        return Ticket::orderBy('created_at','desc')->paginate();        
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

    public function search($room,$name,$status,$take = 10)
    {
        //return $status;
        //$usuarios = DB::table('usuarios')->where('sexo', '=', 'M')->get();
        // SELECT * FROM usuarios WHERE sexo = 'M'
        //$resultado = DB::table('carros')->where('color', '=', 'Verde')->get(array('id', 'modelo', 'color'));
        //$resultado = Carros::where('color', '=', 'Verde')->get(array('id', 'modelo', 'color'));
        if (strlen($room)==0 && strlen($name)==0 && $status=='todos')
        {   
            return Ticket::orderBy('created_at','desc')->paginate();  
        }
        elseif(strlen($room)!=0 && strlen($name)==0 && $status=='todos')
        {   
            return Ticket::where('room', 'LIKE', '%'.$room.'%')->orderBy('created_at','desc')->paginate();
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status=='todos')
        {
            return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('created_at','desc')->paginate();            
        }
        elseif(strlen($room)==0 && strlen($name)==0 && $status!='todos')
        {
            return Ticket::where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate();                
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status=='todos')
        {
            return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('created_at','desc')->paginate();
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status!='todos')
        {
            return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate();         
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status!='todos')
        {
            return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('created_at','desc')->paginate();
        }
        else 
        {
            return 'no entro a ningun lado';
        } 
    }

} 