<?php

namespace ServiceTracker\Repositories;

use ServiceTracker\Entities\Directory;

class DirectoryRepo extends BaseRepo {

    public function getModel()
    {
        return new Directory;
    }

    /*funciones de usercontroller*/
    public function newTel()
    {
        $tel = new Directory();
        //$tel->type = 'usuario';
        return $tel;
    }
    public function listAllTel()
    {
        $tel_all = Directory::paginate();
        return $tel_all;
    }
    /*-----------------------------*/
    public function findTel($id)
    {

        $tel = new Directory();
        return $tel->find($id);
    }

    public function recents()
    {
        return Directory::orderBy('Depto','asc')->orderBy('full_name','desc')->paginate();        
    }

} 