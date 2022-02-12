<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login2(){
        return view('layout.login');
    }

    function checkpasswordLogin(Request $request){
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

    //     $email = $request->email;
    //     $password = $request->password;

    //    // $users = DB::table('users')->get();

    //     $users = DB::table('users')
    //     ->where('email', $email)
    //     ->where('password', $password)
    //     ->first();


    //     if($users){
    //         if($users->role == 1){
    //           //  echo "superadmin";

    //             return redirect()->to('/dashboard');
    //         }elseif($users->role == 2){
    //             echo "admin";
    //         }
    //     }else{
    //         return redirect()->to('/login2')->with('error', 'Invalid Email address or Password');;
    //     }


        $inputVal = $request->all();
   
        
        
   
        if(auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))){

            echo "<pre>";
        print_r(auth()->user());
        die;

            if (auth()->user()->role == 1) {
                return redirect()->route('admin.route');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->to('login2')
                ->with('error','Email & Password are incorrect.');
        } 

    }
}
