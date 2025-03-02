<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return response()->json($users);
        //return $users;
        //return view('welcome');
        
    }
   
    public function registerto(Request $request)
    { 

        // $request->validate([
        //     'fullname' => 'required|string|min:3',
        //     'email' => 'required|string',
        //     'password' => 'required|string',
        // ]);
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|min:3',
            'email' => 'required|string',
             'password' => 'required|string',
         ]);
         
         if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
          
        }
        // $user=new User;
        // $user->fullname=$request->fullname;
        // $user->email=$request->email;
        // $user->password=Hash::make($request->password);
        // $user->save();
        try{

            $user=User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }catch (Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        
        if($user){

            return back()->with('success','New User Singup Successfully.');
        }
        else{
            return redirect()->back()->withErrors('Data not saved');
        }


       
    }

    
   
    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
       //return 'Hi';
       //echo '<script>alert("Hi");</script>';

    }

    
    public function loginto(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:3',
        ]);
  
        
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            $user = Auth::User();
            return view('dashboard',['user' => $user]);
        }
       // $credentials = $request->only('username', 'password');
        //dd($credentials);
        // if (Auth::guard('customer')->attempt($credentials)) {
        //     // Authentication passed...
           
        //     return redirect()->route('dashboard');
        // }
        return back()->with('error','Invalid Email / Password');
       
    }

    public function emailcheck(Request $request){
        if ($request->ajax()) { 
        
            $emailExists = User::where('email', $request->email)->exists();
           
            if ($emailExists) {
                $msg='Email already exists';
            } else {
                $msg='Email is available';
            }

            echo $msg;
            return response()->json(['message' => $msg]);
        }else{
            echo 'error';
        }
        
    }
    public function edit()
    {

        return view('edit');
        
    }
    public function editSave(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fullname = $request->fullname;
        $user->email = $request->email;
    
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect('/login')->with('success', 'User details updated successfully.');
        
        
    }
    public function logout(Request $request)
    {
        Auth::logout(); 
        return redirect('/login')->with('logout', 'You have been logged out!');
    }
}