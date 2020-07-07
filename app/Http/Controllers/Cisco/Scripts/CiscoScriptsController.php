<?php

namespace App\Http\Controllers\Cisco\Scripts;

// use App\Router;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 *  Cisco Router
 */

class CiscoScriptsController extends Controller
{

    public function scripts()
    {
        return view('script.view');
        // $response = '';

        // return response()->json([ 'response' => $response ]);
    }
}