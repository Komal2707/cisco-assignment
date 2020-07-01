<?php

namespace App\Repository;

use App\Router;
use App\RouterView;
use Illuminate\Http\Request;

class CiscoRouterRepository implements ICiscoRouterRepository {


    public function __construct()
    {
        $this->table  = new Router();
        $this->dbView = new RouterView();
    }

    public function getBuilder()
    {

        return $this->dbView;

    }

    public function getList()
    {
        return $this->dbView->orderBy('id', 'desc');
    }



    /**
     *
     * @param type $method
     * @param type $args
     * @return type
     */
    public function __call( $method , $args )
    {
        return call_user_func_array([$this->table , $method] , $args);
    }

}