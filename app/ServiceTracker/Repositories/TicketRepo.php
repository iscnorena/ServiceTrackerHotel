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

    public function findLatest($take = 10)
    {

        return Category::with([
            'tickets' => function ($q) use ($take) {
                    $q->take($take);
                    $q->orderBy('created_at', 'DESC');
                },
            'tickets.user'
        ])->get();
        
    }

    public function recents($take = 10)
    {
        return Ticket::orderBy('created_at','desc')->paginate();        
    }

    public function latest($take = 10)
    {

        return Ticket::with([
            'tickets' => function ($q) use ($take) {
                    $q->take($take);
                    $q->orderBy('created_at', 'DESC');
                },
            'tickets'
        ])->get();
        
    }

    public function newTicket()
    {
        $user = new User();
        $user->type = 'candidate';
        return $user;
    }

    public function newTicket2()
    {

        $ticket = new Ticket();
        $ticket->status = 'en_proceso';
        //$ticket->category_id = 1;
        //$ticket->user_id = 12;
        return $ticket;
    }

    public function newTicket3()
    {
        $ticket = new Ticket();
        //$ticket->status = 'en_proceso';
        //$ticket->category_id = 1;
        //$ticket->user_id = 12;
        return $ticket;
    }

    public function listAll2()
    {
        $tickets = Ticket::paginate();
        return $tickets;
    }

    public function findUser($id)
    {

        $user = new User();
        return $user->find($id);
    }

} 