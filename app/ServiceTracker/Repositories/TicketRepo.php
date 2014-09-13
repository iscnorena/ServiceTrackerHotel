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
        return Ticket::orderBy('status','asc')->orderBy('id','desc')->paginate();        
    }

    public function cutText($text,$num)
    {
        if(strlen($text) > $num)
        {
            $text=substr($text,0,$num)."...";
        }
        else
        {
            $text=$text;
        }
        return $text;  
    }

    public function cutUser($text,$num)
    {
        if(strlen($text) > $num)
        {
            if($text=='MCARRANZA')
            {
                $text = 'MOCARRANZA';
            }
            $text=substr($text,0,$num);
        }
        else
        {
            $text=$text;
        }
        return $text;  
    }

    public function cutSec($text,$num)
    {
        $text=substr($text,0,$num);
        return $text;  
    }

    public function toHours($min,$type)
    {   //obtener seconds
        $sec = $min * 60;
        //dias es la division de n segs entre 86400 segundos que representa un dia
        $dias=floor($sec/86400);
        //mod_hora es el sobrante, en horas, de la division de días;    
        $mod_hora=$sec%86400;
        //hora es la division entre el sobrante de horas y 3600 segundos que representa una hora;
        $horas=floor($mod_hora/3600);        
        //mod_minuto es el sobrante, en minutos, de la division de horas;       
        $mod_minuto=$mod_hora%3600;
        //minuto es la division entre el sobrante y 60 segundos que representa un minuto;
        $minutos=floor($mod_minuto/60);
        if($horas<=0)
        {
            //echo $minutos." minutos";
            $text = $minutos.' min';
        }
        elseif($dias<=0)
        {
            if($type=='round')
            {
                $text = $horas.' hrs';
            }
            else
            {
            $text = $horas." hrs ".$minutos;
            }
        }
        else
        {
            if($type=='round')
            {
                $text = $dias.' dias';
            }
            else
            {
            $text = $dias." dias ".$horas." hrs ".$minutos." min";
            }
            //echo $dias." dias ".$horas." horas ".$minutos." minutos";
            
        }
        return $text;  
    }

    public function prepareNewTicket($input)
    {
        //Capitalizar Campos
        $input['name_guest'] = ucfirst( strtolower($input['name_guest']) );
        $input['request'] = ucfirst( strtolower($input['request']) );
        $input['report_by'] = ucfirst( strtolower($input['report_by']) );
        $input['attend_by'] = ucfirst( strtolower($input['attend_by']) );
        $input['notes'] = ucfirst( strtolower($input['notes']) );
        //Obtener Piso a partir de la hab
        $room = $input['room'];
        $input['floor'] = $this->getFloor($room);
        
        return $input;
    }

    public function cutRecents($recents_tickets)
    {
        //
        foreach ($recents_tickets as $ticket => &$val)     
            {
                //definir los campos a modificar
                $val['notes'] = $this->cutText($val['notes'],15);
                $val['add_by'] = $this->cutUser($val['add_by'],2);
                $val['request'] = $this->cutText($val['request'],25);
                $val['minutes'] = $this->toHours($val['minutes'],'full');
            }
        return $recents_tickets;

    }

    public function cutPDF($recents_tickets)
    {
        //
        foreach ($recents_tickets as $ticket => &$val)     
            {
                //definir los campos a modificar
                $val['notes'] = $this->cutText($val['notes'],15);
                $val['add_by'] = $this->cutUser($val['add_by'],2);
                $val['request'] = $this->cutText($val['request'],25);
                $val['minutes'] = $this->toHours($val['minutes'],'full');
            }
        return $recents_tickets;

    }

    public function getidCategory($slug)
    {
        return Category::where('slug', '=', $slug)->first();
    }

    public function oneCategory($id, $take=10)
    {
        return Ticket::where('category_id', '=', $id)->orderBy('status','asc')->orderBy('id','desc')->paginate();      
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
            $piso="0";  
        }
        return $piso;
    }

    public function reports($take = 10)
    {
        return Ticket::orderBy('status','asc')->orderBy('created_at','desc')->paginate();        
    }

    public function reportsPdf()
    {
        return Ticket::orderBy('status','asc')->orderBy('created_at','desc')->paginate();       
    }

    public function searchTop($campo,$datei,$datef)
    {
        if (strlen($datei)==0)
        {
           $datei = '2000-01-01'; 
        }
        if (strlen($datef)==0)
        {
           $datef = '2030-01-01'; 
        }
        // $campo = 'request';
        // $datei = '2014-01-01';
        // $datef = '2014-07-09';
        //echo $campo;
        $group_by = array($campo);
        //print_r($group_by);
        //$sql = 'SELECT request , COUNT(*) as solicitudes FROM tickets GROUP BY ? ORDER BY solicitudes desc';
        $sql = "SELECT ".$campo.", COUNT(*) as solicitudes FROM tickets WHERE created_at >= '".$datei."' && created_at <='".$datef."' GROUP BY ".$campo." ORDER BY solicitudes desc LIMIT 0,10";
        //echo $sql;
        return \DB::select( $sql);

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
                return Ticket::orderBy('status','asc')->orderBy('created_at','desc')->paginate();  
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('created_at', '>=', $datei)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();  
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
        }
        elseif(strlen($room)!=0 && strlen($name)==0 && $status=='todos')
        {   
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '>=', $datei)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
                
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status=='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
                        
        }
        elseif(strlen($room)==0 && strlen($name)==0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->orderBy('status','asc')->orderBy('created_at','desc')->paginate();                
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status=='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            
        }
        elseif(strlen($room)!=0 && strlen($name)!=0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('room', 'LIKE', '%'.$room.'%')->where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
                     
        }
        elseif(strlen($room)==0 && strlen($name)!=0 && $status!='todos')
        {
            if (strlen($datei)==0 && strlen($datef)==0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)==0)
            {   
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)==0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            elseif(strlen($datei)!=0 && strlen($datef)!=0)
            {
                return Ticket::where('name_guest', 'LIKE', '%'.$name.'%')->where('status', 'LIKE', '%'.$status.'%')->where('created_at', '>=', $datei)->where('created_at', '<=', $datef)->orderBy('status','asc')->orderBy('created_at','desc')->paginate();
            }
            
        }
        else 
        {
            //return 'no entro a ningun lado';
            return Ticket::orderBy('status','asc')->orderBy('created_at','desc')->paginate(); 
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