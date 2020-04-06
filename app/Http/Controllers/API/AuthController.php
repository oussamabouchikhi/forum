<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {
        # Validate data coming from request
        $v = Validator::make($request->all(), [
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        // if one of the rules not valid
        if ($v->fails()) {
            # return json file with errors
            return response()->json([
                "status" => "error",
                "errors" => $v->errors(),
            ], 422);
        }

        // Create a new user with these data
        $user = new  User([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $user->save(); // save user in database
        return response()->json([
            "message" => "User created successfully"
        ], 201);
    }


    /**
     *  Login user & create a token
     */
    public function login(Request $request)
    {
        # Validate data coming from request
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean'
        ]);

        // User data (only email & password)
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            # code...
            return $this->respondWithToken($token);
        }

        return response()->json(["error" => "Your email or password is wrong"], 401);


    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id); // get user id
        return response()->json(["data" => $user]);
    }

    /**
     * Refresh JWT token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
    /** Logout user */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            "status"  => "success",
            "message" => "Logged out successfully"
        ], 200);
    }

    

    /** Get the guard */
    private function guard()
    {
        
        return Auth::guard();
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
}
