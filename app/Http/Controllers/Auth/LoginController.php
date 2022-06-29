<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
	* Login
	*/
	public function login(Request $request){

		$this->validate($request, [
			'email'=>'required|email',
			'password'=>'required'
		]);
		$user = User::where('email', $request->email)/* ->where('verified', 1) */->first();
		if(!empty($user)){
			if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'account_status'=>1], $request->remember)){
				return redirect('dashboard');
			}else{
				 session()->flash("error", "<strong>Whoops! </strong> Invalid login credentials or account is no longer active. Contact admin.");
				 return back();
			}
		}else{
			session()->flash("error", "<strong>Ooops!</strong> Login credentials do not match our records.");
			return back();
		}

	}
}
