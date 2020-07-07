<?php

namespace App\Http\Controllers\Api;
 
use App\User;
use Validator;
use App\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 
 
class CiscoRouterController extends Controller
 
{
 
   public $successStatus = 200;
 
   /**
    * new router api - unique loopback and hostname values
    *
    * @return \Illuminate\Http\Response
    */
 
   public function create(Request $request)
   {
 
       $validator = Validator::make($request->all(), [
 
            'sap_id'    => 'required', 
            'hostname'  => 'required|unique:routers',
            'type'      => 'required',
            'loopback'  => 'required|unique:routers',
            'mac_address' => 'required',
 
       ]);

       if ($validator->fails()) {
 
           return response()->json(['error'=>$validator->errors()], 401);            
 
       }
 
       $data    = $request->all();
       $router  = Router::create($data);

       return response()->json(['success'=>$router], $this->successStatus);
 
   }

   /**
    * update router api - based on IP
    *
    * @return \Illuminate\Http\Response
    */
 
    public function update( $ip, Request $request)
    {
        $router = Router::where('loopback',$ip)->first();
 
        $validator = Validator::make($request->all(), [
    
            'sap_id'    => 'required',
            'hostname'  => 'required|unique:routers,hostname,'.$router->id,
            'type'      => 'required',
            'loopback'  => 'unique:routers,loopback,'.$router->id,
            'mac_address' => 'required',

        ]);
   
        if ($validator->fails()) {
  
            return response()->json(['error'=>$validator->errors()], 401);            
  
        }
  
        $data    = [
            'sap_id'        =>  $request->sap_id,
            'hostname'      =>  $request->hostname,
            'type'          =>  $request->type,
            'mac_address'   =>  $request->mac_address,
        ];

        $router  = Router::where('loopback',$ip)->update($data);
 
        return response()->json(['success'=>$router], $this->successStatus);
  
    }
 

   /**
    * delete router api - based on IP - softdelete
    *
    * @return \Illuminate\Http\Response
    */

    public function delete( $ip )
    {
        $router  = Router::where('loopback',$ip)->delete();
        return response()->json(['success'=>$router], $this->successStatus);
    }
 
   /**
    * details api 
    *
    * @return \Illuminate\Http\Response
    */
 
   public function getRoutersByIPRange( Request $request )
   {
       $validator = Validator::make($request->all(), [
    
            'from'  => 'required',
            'to'    => 'required',

        ]);

        if ($validator->fails())
            return response()->json(['error'=>$validator->errors()], 401);

        $from = $request->from;
        $to   = $request->to;

        $router = Router::whereBetween('loopback', [$from, $to])->get();

       return response()->json(['router' => $router], $this->successStatus);
   }

   public function getRoutersByTypeAndSapId( Request $request )
   {
       $validator = Validator::make($request->all(), [
    
            'sap_id'  => 'required',
            'type'    => 'required',

        ]);

        if ($validator->fails())
            return response()->json(['error'=>$validator->errors()], 401);

        $type   = $request->type;
        $sap_id = $request->sap_id;

        $router = Router::whereType($type)->whereSapId($sap_id)->get();

       return response()->json(['router' => $router], $this->successStatus);
   }
 
}