<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

use App\Activity;
use App\ActivityMedia;
use App\Children;
use App\UserInfo;
use App\User;
use App\WatchList;
use App\Mail\NewUser;
use App\Mail\AccountVerified;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // echo $request->input('first')."\n"; - can't change
        // echo $request->input('last')."\n"; - can't change
        // echo $request->input('user')."\n"; - can change
        // echo $request->input('email')."\n"; - can change
        // echo $request->input('kids')."\n"; - can change
        // echo $request->input('pass')."\n"; - can change
        // echo $request->input('giver')."\n";

        // check if the user already exists
        $records = DB::table('users')
                    ->where('name', $request->input('user'))
                    ->orWhere('email', $request->input('email'))
                    ->count();

        if($records > 0):
            $response = array(
                "Status" => 0,
                "Message" => "A user with this username/email already exists."
            );
            echo json_encode($response);
        else: 
            $response = array(
                "Status" => 1,
                "Message" => "Thank you for registering! Please verify your email address to log into our site!"
            );

            try
            {
                $giver = $request->input('giver') == 'true' ? true : false;

                // hash the password
                $pw = Hash::make($request->input('pass'));

                // make the timestamp
                $ts = date("Y-m-d H:i:s");

                // create the user
                $u = DB::table('users')->insertGetId(
                    [
                        'name' => $request->input('user'),
                        'email' => $request->input('email'),
                        'password' => $pw,
                        'giver' => $giver,
                        'created_at' => $ts,
                        'updated_at' => $ts
                    ]
                );

                DB::table('user_info')->insert(
                    [
                        'first_name' => $request->input('first'),
                        'last_name' => $request->input('last'),
                        'number_of_children' => $request->input('kids'),
                        'created_at' => $ts,
                        'updated_at' => $ts,
                        'user_id' => $u
                    ]
                );

                DB::table('user_roles')->insert([
                    'user_id' => $u
                ]);

                $id = uniqid();
                $verification = DB::table('user_verification')->insertGetId(
                    ['id' => $id, 'user_id' => $u, 'created_on' => $ts]
                );

                $user = array(
                    "name" => $request->input('first'),
                    "verification" => config('app.url')."verify/{$id}"
                );
                Mail::to($request->input('email'))->send(new NewUser($user));

                // To send HTML mail, the Content-type header must be set
                // $headers[] = 'MIME-Version: 1.0';
                // $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                // Additional headers
                // $headers[] = 'From: ForAfter4 <hi@forafter4.ca>';

                // mail($request->input('email'), "Welcome to ForAfter4", "<p>Hey there! We're excited to have you join our community - thank you for creating your account! To keep our community safe & reliable, we require each new member to verify their email address. Please follow the link below to verify yours & confirm your new account!</p><p><a href=\"{$user["verification"]}\">Verify your account</a>.</p>", implode("\r\n", $headers));
                echo  json_encode($response);
            }
            catch(Exception $e) {
                echo 'A child';
            }
        endif;
    }

    // check if this is a valid user before logging them in
    public function check_login(Request $request)
    {
        $username = $request->input('email');
        $password = $request->input('password');

        $response = array(
            "Status" => 0,
            "Message" => "invalid username/password combination"
        );
        
        $user = DB::table('users')->select('id', 'name', 'email', 'password')
            ->where('email', $username)
            ->orWhere('name', $username)
            ->first();
        
        if($user != null)
        {
            if(Hash::check($password, $user->password))
            {
                // check if they've verified their email address

                $verified = DB::table('user_verification')->select()
                    ->where('user_id', $user->id)
                    ->where('verified', false)
                    ->count();
                
                if($verified > 0)
                {
                    $response["Status"] = 0;
                    $response["Message"] = "Please verify your email address before logging in";
                    echo json_encode($response);
                }
                else
                {
                    $response["Status"] = 1;
                    $response["Message"] = "This user is validated!";
                    echo json_encode($response);
                }
            }
            else
            {
                echo json_encode($response);
            }
        }
        else
        {
            echo json_encode($response);
        }
    }

    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        $username = $request->input('email');
        $password = $request->input('password');

        $email = DB::table('users')->select('email')
            ->where('email', $username)
            ->orWhere('name', $username)
            ->first();

        $credentials = array(
            'email' => $email->email,
            'password' => $password
        );

        if(Auth::attempt($credentials))
        {
            return redirect()->intended('/hub');
        }
        else
        {
            return redirect()->intended('/');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->intended('/');
    }

    // verify the user
    public function verify($uuid) {

        $verification = DB::table('user_verification')
            ->where('id', $uuid)
            ->where('verified', false)
            ->first();

        if($verification != null):
            DB::table('user_verification')
                ->where('id', $uuid)
                ->update(['verified' => true, 'verified_on' => date('Y-m-d H:i:s')]);
            
            $user = User::find($verification->user_id);
            Mail::to($user->email)->send(new AccountVerified($user));
            return redirect()->intended('/verified');
        else:
            echo 'Sorry, but this link has expired!';
        endif;
    }

    // account verification success
    
    public function accountverified()
    {
        return view('users.verified');
    }

    // the hub

    public function dashboard()
    {
        return view('users.dashboard');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $user_info = DB::table('user_info')->select()
            ->where('user_id', $id)->first();

        return view('users.profile', ['ui' => $user_info]);
    }

    public function update_profile(Request $request)
    {
        $id = Auth::user()->id;
        $user_info = UserInfo::where('user_id', $id)->first();

        if($request->file()):
            $image = $request->file('profile_image');
            $path = Storage::disk('public')->put('images/profile_photos', $image);
            $user_info->profile_image = $path;
        endif;

        $user_info->contact_number = $request->input('contact_number');
        $user_info->bio = $request->input('bio');
        $user_info->save();

        return redirect('/hub/edit-profile');
    }

    public function children()
    {
        $bd = new \DateTime('1992-02-01 00:00:00');
        $now = new \DateTime('today');
        $age_stamp = $bd->diff($now);
        // $children = ['birth_day' => $bd, "now" => $now, "age" => $age_stamp->format("%y")];
        
        $children = Children::where('user_id', Auth::user()->id)->get();
        return view('users.children', ['children' => $children]);
    }

    public function save_child(Request $request)
    {
        $this->validate($request, [
            'child_name' => 'required',
            'birth_day' => 'required',
            'birth_month' => 'required',
            'birth_year' => 'required'
        ]);

        $child = new Children;
        $child->user_id = Auth::user()->id;
        $child->name = $request->input('child_name');
        $child->birth_date = $request->input('birth_year').'-'.$request->input('birth_month').'-'.$request->input('birth_day');
        $child->save();
        
        return redirect('/hub/my-children')->with('success', 'Child information saved successfully');
    }

    public function listings()
    {
        if(!Auth::user()->giver_approved):
            return redirect('/');
        endif;

        $activities = Activity::where('user_id', Auth::user()->id)->where('active', true)->get();

        return view('users.listings')->with('activities', $activities);
    }

    public function watch_list()
    {
        return view('users.watchlist');
    }

    public function watchlist_table()
    {
        $watchlist = WatchList::where('user_id', Auth::user()->id)->get();
        return view('users.tables.watchlist')->with('watchlist', $watchlist);
    }
}