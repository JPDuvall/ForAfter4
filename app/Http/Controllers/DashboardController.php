<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\DB;

use App\Activity;
use App\ActivityMedia;
use App\Mail\NewUser;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user)
        {
            return view('dashboard.index');
        }
        else
        {
            return redirect('/dashboard/login');
        }
    }

    public function login()
    {
        return view('dashboard.login');
    }

    public function check_login(Request $request)
    {
        
    }

    public function users()
    {
        $users = DB::table('users')
            ->join('user_info', 'users.id', '=', 'user_info.user_id')
            ->get();

        return view('dashboard.users', ['users' => $users]);
    }

    public function givers()
    {
        $users = DB::table('users')
            ->join('user_info', 'users.id', '=', 'user_info.user_id')
            ->where('users.giver', true)
            ->get();

        return view('dashboard.givers', ['users' => $users]);
    }
}
