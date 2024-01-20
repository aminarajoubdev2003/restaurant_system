<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GeneralTrait;

class AuthController extends Controller
{   
    use GeneralTrait;
    public function register( Request $request) {
        
        $validatedData = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|min:8',
        ],[
           
            'email.unique' => ' Email already exists',
        ]);
        
         
        if ($validatedData->fails()) {
            return $this->apiResponse( null, false, $validatedData->messages(), 401);
        }
     
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
       
        if ( $user ) {
        $tokenresult = $user->createToken('personal access token');
        $token = $tokenresult->plainTextToken;
        //return $this->apiResponse( $user, true, null, 200);
        return response()->json([
            'message' => $this->apiResponse( $user, true, null, 200),
            'accessToken' =>$token,
        ]);
        
        }else{
            return $this->unAuthorizeResponse();
        }
    }

    public function login( Request $request ) {
        $validatedData = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|min:8',
        ],[
           
            'email.unique' => ' Email already exists',
        ]);
        $user = User::where('email', $request->email)->first();
        
        if( !Hash::check($request->password, $user->password)) {
            return $this->unAuthorizeResponse();
        }
        $tokenresult = $user->createToken('personal access token');
        $token = $tokenresult->plainTextToken;
        return response()->json([
            'message' => $this->apiResponse( $user, true, null, 200),
            'accessToken' =>$token,
        ]);

    }

    
    
}




