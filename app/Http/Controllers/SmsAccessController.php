<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Access; 
use App\Secrets;  
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;  

use Illuminate\Support\Facades\Crypt;

use DB; 
use Symfony\Component\HttpFoundation\Response;
 

class SmsAccessController extends Controller
{

    protected function ValidationResponse( array $errors)
  {
      return response()->json([
          'error' => $errors,
      ], Response::HTTP_BAD_REQUEST);
  }

    /**
     * Display a listing of the resource
     *
     * @return Response|array
     */
    public function index()
    {
       echo 'SMS';
        exit;
    }

    /**
     * Get Server Key.
     *
     * @return Response
     */
    public function getServerKey(Request $request)
    {
       
        return response()->json([
            'data' => config('app.server_key'),
            'status' => 200
        ]);
    }

    /**
     * New registration.
     *
     * @return Response
     */
    public function register(Request $request)
    {
        /**
         * Get a validator for an incoming registration request.
         * username and a public_key
         * @param  array  $request
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $valid = validator($request->only('username', 'public_key' ), [
            'username' => 'required|string|max:255|unique:access',
            'public_key' => 'required|string' 
        ]);

        if ($valid->fails()) {
            return $this->ValidationResponse($valid->errors()->all());
        }

        $data = request()->only('username', 'public_key' );
        
        $smsAccess = Access::create([
            'username' => $data['username'],
            'public_key' => $data['public_key'],
            'private_key' => Crypt::encrypt($data['username'])

        ]);
  
        $data['access_id'] = $smsAccess->id;
        $data['server_key'] = config('app.server_key');
           
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

    /**
     * Store Secret
     *  
     * @return json response
     */
    function storeSecret(Request $request)
    {
        $valid = validator($request->only('username', 'secretName', 'encryptedSecret', 'server_key' ), [
            'username' => 'required|string|max:255',
            'secretName' => 'required|string|unique:secrets',
            'encryptedSecret' => 'required|string',
            'server_key' => 'required|string' 
        ]);

        if ($valid->fails()) {
            return $this->ValidationResponse($valid->errors()->all());
        }

        $data = request()->only('secretName', 'encryptedSecret', 'server_key', 'username' );

       
        $user = Access::where('username', $data['username'])->first();
    
        if(!is_object($user)){
            return $this->ValidationResponse(array('User not found!'));
        }

        if($data['server_key'] != config('app.server_key')){
            return $this->ValidationResponse(array('server_key is not valid!'));
        }
 
        $smsSecrets = Secrets::create([
            'access_id' => $user->id,
            'secret_name' => $data['secretName'],
            'encrypted_secret' => $data['encryptedSecret']  
        ]);

        return response()->json([
            'data' => 'ok',
            'status' => 200
        ]);
    }

    /**
     * Get secret 
     * 
     * @return Response 
     */
    public function getSecret(Request $request)
    {

        $valid = validator($request->only('username', 'secretName',  'server_key' ), [
            'username' => 'required|string|max:255',
            'secretName' => 'required|string', 
            'server_key' => 'required|string' 
        ]);

        if ($valid->fails()) {
            return $this->ValidationResponse($valid->errors()->all());
        }

        $data = request()->only('secretName', 'server_key', 'username' );

        $user = Access::where('username', $data['username'])->first();
    
        if(!is_object($user)){
            return $this->ValidationResponse(array('User not found!'));
        }

        if($data['server_key'] != config('app.server_key')){
            return $this->ValidationResponse(array('server_key is not valid!'));
        }

        $smsSecrets = Secrets::where('secret_name', $data['secretName'])->first();

        if(!is_object($smsSecrets)){
            return $this->ValidationResponse(array('secretName not found!'));
        }

        $data =  [
            'access_id' => $user->id,
            'secret_name' => $data['secretName'],
            'encrypted_secret' => $smsSecrets->encrypted_secret 
        ] ;

        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

     /**
     * Get secret 
     * 
     * @return Response 
     */
    public function getEncripted(Request $request)
    {
        $valid = validator($request->only( 'secret', 'server_key', 'private_key' ), [  
            'secret' => 'required|string',
            'private_key' => 'required|string',
            'server_key' => 'required|string' 
        ]);

        if ($valid->fails()) {
            return $this->ValidationResponse($valid->errors()->all());
        }

        
        $data = request()->only('secret', 'server_key', 'private_key' );
        if($data['server_key'] != config('app.server_key')){
            return $this->ValidationResponse(array('server_key is not valid!'));
        }

       return response()->json([
        'data' => Crypt::encrypt($data['secret'].'-=-'.$data['private_key']),
        'status' => 200
    ]);

    }

    /**
     * Get secret 
     * 
     * @return Response 
     */
    public function getDecrypt(Request $request)
    {
        $valid = validator($request->only( 'encrypted_secret', 'server_key'  ), [  
            'encrypted_secret' => 'required|string', 
            'server_key' => 'required|string' 
        ]);

        if ($valid->fails()) {
            return $this->ValidationResponse($valid->errors()->all());
        }

        $data = request()->only('encrypted_secret', 'server_key' );
        if($data['server_key'] != config('app.server_key')){
            return $this->ValidationResponse(array('server_key is not valid!'));
        }
        // Decrypt the $encrypted  
        

         try {
            $message   = Crypt::decrypt($data['encrypted_secret']);
        } catch (\Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException $ex) {
            return $this->ValidationResponse(array('something wrong!'));
        }
         $msg = explode('-=-',$message);
         if(!isset($msg[1])){
            return $this->ValidationResponse(array('something is wrong!'));
         }

       return response()->json([
        'data' => $msg[0],
        'status' => 200
    ]);

    }
 
}
