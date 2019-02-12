<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use App\Activity;
use App\ActivityMedia;
use App\ActivityCategory;
use App\Children;
use App\WatchList;
use App\Mail\NewUser;
use Stripe;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function landing()
    {
        return view('pages.landing');
    }

    public function subscribe(Request $request)
    {
        $db = DB::table('newsletter')->insert(
            ['email' => $request->input('email')]
        );

        echo $request->input('email');
    }

    public function test_email()
    {
        return view('pages.email');
    }

    public function send_test()
    {
        try
        {
            $user = array(
                "name" => "John",
                "verification" => "123456"
            );
            Mail::to('phillipdvll@gmail.com')->send(new NewUser($user));
            echo 'Sent';
        }
        catch(Exception $e)
        {
            die('Error');
        }
    }

    public function view_email() {
        return new NewUser();
    }

    public function about()
    {
        return view('pages.about');
    }

    public function explore()
    {
        $categories = ActivityCategory::all();
        
        foreach($categories as $category) {
            $category->total = Activity::where([
                ['category_id', $category->id],
                ['active', true]
            ])->count();
        }

        return view('pages.explore', ['categories' => $categories]);
    }

    public function explorelist(Request $request)
    {
        $location  = $request->input('location');
        $category  = $request->input('category');
        
        switch($request->input('sort')):
            case 'price-lowest':
                $sort = ['price', 'asc'];
                break;
            case 'price-highest':
                $sort = ['price', 'desc'];
                break;
            default:
                $sort = null;
        endswitch;

        $activities = Activity::when($location, function($query, $location){
                $query->where('location', 'like', "%$location%");
            })
            ->when($category, function($query, $category){
                $query->where('category');
            })
            ->where('active', true)
            ->when($sort, function($query, $sort){
                $query->orderBy($sort[0], $sort[1]);
            })->get();
        return view('pages.explore_list')->with('activities', $activities);
    }

    public function calculate_booking(Request $request)
    {
        $activity = Activity::find($request->input('activityID'));

        echo $activity->price;
    }

    public function book(Request $request)
    {
        // publishable key pk_test_Wa36zNLmhI4Qll1R1fF66JKk
        // secret key sk_test_s4TYjogt9JKrk9WKNJNuVRAY

        // get the activity
        $id = $request->input('id');
        $token = $request->input('token');

        $activity = Activity::find($id);

        // tax rates and fees
        $mbRSTRate = 0.08;
        $caGSTRate = 0.05;
        $fa4Fee = 4.5;

        $subtotal = $activity->price + $fa4Fee;

        $RST = $subtotal * $mbRSTRate;
        $GST = $subtotal * $caGSTRate;

        // get the total
        $total = round(($subtotal + $RST + $GST) * 100);

        // invoke stripe
        $stripe = [
            "secret_key" => "sk_test_s4TYjogt9JKrk9WKNJNuVRAY",
            "publishable_key" => "pk_test_Wa36zNLmhI4Qll1R1fF66JKk"
        ];

        Stripe\Stripe::setApiKey($stripe['secret_key']);

        $charge = Stripe\Charge::create([
            'amount' => $total,
            'currency' => 'cad',
            'description' => $activity->name,
            'source' => $token,
            'receipt_email' => Auth::user()->email
        ]);

        echo 'success!';
    }

    public function contact(Request $request)
    {
        die('hello');
    }

    public function addToList(Request $request)
    {
        $id = $request->input('activity_id');
        $uID = Auth::user()->id;
        $now = date("Y-m-d H:i:s");

        $watchlist = WatchList::where([['activity_id', $id], ['user_id', $uID]])->get();

        if(count($watchlist) < 1):

            $watchlist = new WatchList();
            $watchlist->user_id = $uID;
            $watchlist->activity_id = $id;
            $watchlist->date_added = $now;

            $watchlist->save();
        else:
            WatchList::destroy($watchlist[0]->id);
        endif;
    }
}
