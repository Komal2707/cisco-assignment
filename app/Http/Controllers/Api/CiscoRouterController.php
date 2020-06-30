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
            'hostname'  => 'required|unique:posts',
            'type'      => 'required',
            'loopback'  => 'required|unique:posts',
            'mac_address' => 'required',
 
       ]);
//   return ($request->all());
       if ($validator->fails()) {
 
           return response()->json(['error'=>$validator->errors()], 401);            
 
       }
 
       $data    = $request->all();
       $data['api_token'] = str_random(60);
       $router  = Router::create($data);

       $success['token']    =  $router->createToken('MyApp')->accessToken;
       $success['hostname'] =  $router->hostname;
       $success['loopback'] =  $router->loopback;
 
       return response()->json(['success'=>$success], $this->successStatus);
 
   }

   /**
    * update router api - based on IP
    *
    * @return \Illuminate\Http\Response
    */
 
    public function update(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
  
             'sap_id'    => 'required', 
             'hostname'  => 'required|unique:posts',
             'type'      => 'required',
             'loopback'  => 'required|unique:posts',
             'mac_address' => 'required',
  
        ]);
   
        if ($validator->fails()) {
  
            return response()->json(['error'=>$validator->errors()], 401);            
  
        }
  
        $data    = $request->all();
        $router  = Router::where('loopback',$request->loopback)->update($data);
 
        // $success['token']    =  $router->createToken('MyApp')->accessToken;
        // $success['hostname'] =  $router->hostname;
        // $success['loopback'] =  $router->loopback;
  
        return response()->json(['success'=>$router], $this->successStatus);
  
    }
 

   /**
    * delete router api - based on IP - softdelete
    *
    * @return \Illuminate\Http\Response
    */

    public function delete( Router $router )
    {
        $router  = Router::where('loopback',$request->loopback)->delete();
    }
 
   /**
    * details api 
    *
    * @return \Illuminate\Http\Response
    */
 
   public function getDetails()
   {# code...
       $user = Auth::user();
       return response()->json(['success' => $user], $this->successStatus);
   }
 
}