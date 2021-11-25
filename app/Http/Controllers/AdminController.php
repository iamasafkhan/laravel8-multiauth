<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
//use App\Http\Controllers\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if(Auth::guard('admin')->attempt($credentials, $request->remember)){
    //         $user = Admin::where('email', $request->email)->first();
    //         Auth::guard('admin')->login($user);
    //         return redirect()->route('admin.home');
    //     }
    //     return redirect()->route('admin.login')->with('status', 'Failed To Process Login');
    // }

    // public function logout(){

    //     if(Auth::guard('admin')->logout()){
    //         return redirect()->route('admin.login')->with('status', 'Logout Successfully');
    //     }
    // }


    protected function authenticated(Request $request, $user){
        return redirect()->route('admin.home');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }


    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }


    protected function guard(){
        return Auth::guard('admin');
    }
}
