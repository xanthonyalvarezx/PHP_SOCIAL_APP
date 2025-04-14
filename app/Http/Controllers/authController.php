<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class authController extends Controller
{


    /**
     * Handles user login.
     *
     * This function validates the login form data, attempts to authenticate the user,
     * and redirects the user to the homepage with a success or error message.
     *
     * @param Request $request The incoming request containing the login form data.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\Response The redirect response.
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            "loginusername" => 'required',
            "loginpassword" => 'required'
        ]);

        if (auth()->attempt(['username' => $loginData['loginusername'], 'password' => $loginData['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You\'ve successfully loggen in');
        } else {
            return redirect('/')->with('error', 'Invalid credentials');
        }
    }


    /**
     * Handles user registration.
     *
     * This function validates the registration form data, creates a new user in the database,
     * logs the user in, and redirects them to the homepage with a success message.
     *
     * @param Request $request The incoming request containing the registration form data.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\Response The redirect response.
     */
    public function register(Request $request)
    {
        $registerData = $request->validate([
            "username" => ['required', ' min:4', ' max:20', Rule::unique('users', 'username')],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => ['required', 'min:8', 'confirmed']
        ]);
        $newUser = User::create($registerData);
        auth()->login($newUser);

        return redirect('/')->with('success', 'Thank you for signing up!');
    }

    /**
     * Handles user logout.
     *
     * This function logs out the currently authenticated user,
     * redirects them to the homepage with a success message,
     * and invalidates the session.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\Response The redirect response.
     */
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out');
    }


    /**
     * Displays the dynamic homepage based on the user's authentication status.
     *
     * This function checks the authentication status of the current user using Laravel's auth()->check() method.
     * Depending on the authentication status, it returns the appropriate view for the homepage.
     * If the user is authenticated, it returns the 'homepage-feed' view.
     * If the user is not authenticated, it returns the 'homepage' view.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *         Returns the appropriate view for the homepage based on the user's authentication status.
     */
    public function showDynamicHomepage()
    {
        switch (auth()->check()) {
            case true:
                return view('homepage-feed');
                break;
            case false:
                return view('homepage');
                break;
            default:
                break;
        }
    }
}
