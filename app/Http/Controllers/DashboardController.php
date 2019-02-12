<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\DB;

use App\Activity;
use App\ActivityMedia;
use App\UserRoles;
use App\Mail\NewUser;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user)
        {
            $role = UserRoles::where('user_id', $user->id)->get();

            if($role[0]->role != 'admin'):
                return redirect('/home');
            endif;

            return view('dashboard.index');
        }
        else
        {
            return redirect('/home');
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
        $user = Auth::user();
        if($user)
        {
            $role = UserRoles::where('user_id', $user->id)->get();

            if($role[0]->role != 'admin'):
                return redirect('/home');
            endif;
        }
        else
        {
            return redirect('/home');
        }

        $users = DB::table('users')
            ->join('user_info', 'users.id', '=', 'user_info.user_id')
            ->get();

        return view('dashboard.users', ['users' => $users]);
    }

    public function givers()
    {
        $user = Auth::user();
        if($user)
        {
            $role = UserRoles::where('user_id', $user->id)->get();

            if($role[0]->role != 'admin'):
                return redirect('/home');
            endif;
        }
        else
        {
            return redirect('/home');
        }

        $users = DB::table('users')
            ->join('user_info', 'users.id', '=', 'user_info.user_id')
            ->where('users.giver', true)
            ->get();

        return view('dashboard.givers', ['users' => $users]);
    }
}
