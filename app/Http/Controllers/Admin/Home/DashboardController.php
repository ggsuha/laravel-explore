<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * {@inheritDoc}
     */
    public function index()
    {
        dd('test');
    }
}
