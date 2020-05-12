<?php

namespace Facilitador\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    use AuthenticatesUsers, ValidatesRequests;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'getLogout']);
        // $this->middleware('guest', ['except' => 'logout']);
        $this->middleware('facilitador.guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function login(Request $request)
    {
        $email      = $request->get('email');
        $password   = $request->get('password');
        $remember   = $request->get('remember');

        if (Auth::attempt([
            'email'     => $email,
            'password'  => $password
        ], $remember == 1 ? true : false)) {
            return redirect()->route('root.home');
            if ( Auth::user()->hasRole('root')) {

                return redirect()->route('root.home');

            }

            if ( Auth::user()->hasRole('administrator')) {

                return redirect()->route('admin.home');

            }

            return redirect()->route('user.home');

        }
        

        return redirect()->back()
            ->with('message', trans('default.incorrect_email_or_password'))
            ->with('status', 'danger')
            ->withInput();
    

    }


    /**
     * Abaixo peguei do Decoy
     */
    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // Pass validation rules
        Former::withRules(array(
            'email'    => 'required|email',
            'password' => 'required',
        ));

        // Show the login homepage
        return view('facilitador::layouts.blank', [
            'content' => view('facilitador::account.login'),
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        // Logout the session
        Auth::logout();

        // Redirect back to previous page so that switching users takes you back to
        // your previous page.
        $previous = url()->previous();
        if ($previous == url('/')) {
            return redirect(route('facilitador.account@login'));
        }

        return redirect($previous);
    }

    /**
     * Get the post register / login redirect path. This is set to the login route
     * so that the guest middleware can pick it up and redirect to the proper
     * start page.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('facilitador.account@login');
    }
}
