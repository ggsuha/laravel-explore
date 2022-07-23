<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * {@inheritDoc}
     */
    public function showLoginForm()
    {
        return view('admin.pages.auth.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('admin.dashboard.index');
    }

    /**
     * {@inheritDoc}
     */
    protected function attemptLogin(Request $request)
    {
        $user = Admin::query()
            ->where('email', $request->input('email'))
            ->get();

        if ($user->isEmpty()) return;

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
