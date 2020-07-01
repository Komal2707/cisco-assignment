<?php

namespace App\Repository;

use App\Router;
use App\RouterView;
use Illuminate\Http\Request;

interface ICiscoRouterRepository {

    public function getBuilder();
    public function getList();


}