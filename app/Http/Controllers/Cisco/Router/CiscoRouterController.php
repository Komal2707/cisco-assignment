<?php

namespace App\Http\Controllers\Cisco\Router;

use App\Router;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\DataTables\Cisco\Router\CiscoRouterListDatatable;

/**
 *  Cisco Router
 */

class CiscoRouterController extends Controller
{

    public function dataTable( CiscoRouterListDatatable $dataTable , Request $request ,$search =null)
    {

        if ( $request->ajax() || $request->wantsJson() || 1==1 )
            return $dataTable->ajax();

        $builder = $dataTable->with('id',$search)->html();
        $pageName = ["Ciscp Router" , "list of all the cisco router"];

        return view('router.datatable' , compact('pageName' , 'builder'));
    }

    public function create()
    {
        // $pageName = ["Cisco Routers", "list of all cisco router"];

        $data = [
            'pageName'  => ["Cisco Routers", "create new cisco router"],
            'meta'      => [
                'router_types' => $this->getRouterType()
            ],
            'router'    => false
        ];

        return view( 'router.create', $data );
    }

    public function edit( Router $router )
    {
        // $pageName = ["Cisco Routers", "list of all cisco router"];
// dd($router);

        $data = [
            'meta'      => [
                'router_types' => $this->getRouterType()
            ],
            'router'    => $router
        ];

        return view( 'router.create', $data );
    }


    public function getRouterType( $id = null )
    {

        $router_types = [
            'AGI' => 'AGI',
            'CSS' => 'CSS'
        ];


       $collection = new \Illuminate\Support\Collection();

        foreach($router_types as $key => $val){

            $obj = new \StdClass();
            $obj->id = $key;
            $obj->name = $val;
            $collection->push($obj);
        }

        if ( isset($router_types[$id]) )
            return $collection->where('id',$id)->first();
        else 
            return $collection;
    }

    public function store()
    {
        $router = request('router');

        if( $router['id'] )
        {
            
            $validator = Validator::make($router, [
    
                'sap_id'    => 'required', 
                'hostname'  => 'required|unique:routers,hostname,'.$router['id'],
                'type'      => 'required',
                'loopback'  => 'required|unique:routers,loopback,'.$router['id'],
                'mac_address' => 'required',

            ]);

        } else {

            $validator = Validator::make($router, [
    
                'sap_id'    => 'required', 
                'hostname'  => 'required|unique:routers',
                'type'      => 'required',
                'loopback'  => 'required|unique:routers',
                'mac_address' => 'required',

            ]);
        }

        if ($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);            

        }


        $data = [
            'sap_id' => $router['sap_id'],
            'hostname' => $router['hostname'],
            'type' => $router['type'],
            'loopback' => $router['loopback'],
            'mac_address' => $router['mac_address']
        ];

        if( $router['id'] ) {

            $router = Router::find($router['id']);
            $router->update($data);
            return response()->json($router);

        } else {
            $router = Router::create($data);
            return response()->json($router);
        }
    }

    public function delete( Router $router )
    {
        return response()->json([ 'result' => $router->delete() ]);
    }
}