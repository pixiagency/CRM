<?php

namespace App\Http\Controllers\Web\Landlord;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\NotFoundException;
use App\Services\Landlord\AuthService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdateAuthRequest;
use App\Http\Requests\Landlord\Auth\SignupRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function signupForm()
    {
        return view('landlord.dashboard.auth.signup');
    }

    public function signup(SignupRequest $request)
    {
        try {
            $this->authService->signup(name: $request->name, organization: $request->organization, email: $request->email, password: $request->password);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.signup_successfully')
            ];
            return to_route('landlord.login');
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', $e->getMessage());
        }
    }

    public function loginForm()
    {
        return view('landlord.dashboard.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->authService->loginWithEmailOrPhone(identifier: $request->identifier, password: $request->password);
            $user->load('tenant');  // This loads the tenant relationship

            // Pass the user to the view
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.login_successfully')
            ];

            // Return to the route and pass user data
            // return to_route('landlord.home')->with(['toast' => $toast, 'user' => $user]);
            Session::flash('toast', $toast);
            return view('landlord.dashboard.index', compact('user'));
        } catch (NotFoundException $e) {
            return back()->with('error', "email or password incorrect please try again");
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', $e->getMessage());
        }
    }


    public function getProfile()
    {
        return view('landlord.dashboard.user.profile');
    }

    public function updateProfile(UpdateAuthRequest $request)
    {
        try {
            $this->authService->updateProfile($request->validated());
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.success_operation')
            ];

            return to_route('home')->with('toast', $toast);
        } catch (Exception $e) {
            dd($e);
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast', $toast);
        }
    }
    

    public function logout()
    {
        Auth::logout();
        return to_route('landlord.login');
    }
}
