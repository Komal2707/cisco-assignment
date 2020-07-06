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

        return $this->table;

    }

    public function getList()
    {
        return $this->table->select(
            'id',
            'sap_id',
            'type',
            'hostname',
            'loopback',
            'mac_address',
            'created_at'
        )->orderBy('id', 'desc');
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