<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Session;
use App\Models\User;
// use Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('content.auth.login');
    }  
      
    public function registration()
    {
        return view('content.auth.registration');
    }
      
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('content.dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}