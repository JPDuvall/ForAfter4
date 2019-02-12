<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityMedia;
use App\ActivityCategory;
use App\Term;
use App\Session;
use App\Children;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activities.index')->with('activities', $activities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()):
            return redirect('/');
        endif;
        $categories = ActivityCategory::all();

        return view('activities.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'tagline' => 'required',
            'images' => 'required',
            'location' => 'required'
        ]);
        
        $activity = new Activity;
        $activity->name = $request->input('name');
        $activity->tagline = $request->input('tagline');
        $activity->description = $request->input('description');
        $activity->term = $request->input('term');
        $activity->price = $request->input('price');
        $activity->location = $request->input('location');
        $activity->category_id = $request->input('category');
        $activity->user_id = Auth::user()->id;
        $activity->save();

        if($request->input('term') == "term"):
            $term = new Term;
            $term->activity_id = $activity->id;
            $term->start = $request->input('term_start');
            $term->end = $request->input('term_end');
            $term->spots_available = $request->input('spots_available');
            $term->save();
        endif;

        
        foreach($request->file('images') as $image):
            $path = Storage::disk('public')->put('images', $image);
            $media = new ActivityMedia;

            $media->img_url = $path;
            $media->activity_id = $activity->id;
            $media->save();
        endforeach;

        return redirect("/activities/{$activity->id}")->with('success', 'Activity Listed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);
        $media = ActivityMedia::where('activity_id', $id)->get();

        // tax rates and fees
        $mbRSTRate = 0.08;
        $caGSTRate = 0.05;
        $fa4Fee = 4.5;

        $subtotal = $activity->price + $fa4Fee;

        $RST = $subtotal * $mbRSTRate;
        $GST = $subtotal * $caGSTRate;

        $taxes = number_format($RST + $GST, 2);

        $total = number_format($subtotal + $RST + $GST, 2);
        
        if(Auth::user()):
            $children = Children::where('user_id', Auth::user()->id)->get();
        else:
            $children = null;
        endif;

        return view('activities.show',
            [
                'activity' => $activity,
                'media' => $media,
                'children' => $children,
                'fa4Fee' => number_format($fa4Fee, 2),
                'taxes' => $taxes,
                'total' => $total
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        $media = ActivityMedia::where('activity_id', $id)->get();
        $categories = ActivityCategory::All();

        if($activity->term == "term"):
            $term = Term::where('activity_id', $id)->get();
        else:
            $term = Session::where('activity_id', $id)->get();
        endif;

        return view('activities.edit', ['activity' => $activity, 'media' => $media, 'categories' => $categories, 'term' => $term]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'tagline' => 'required',
            'location' => 'required'
        ]);
        
        $activity = Activity::find($id);
        $activity->name = $request->input('name');
        $activity->tagline = $request->input('tagline');
        $activity->description = $request->input('description');
        $activity->term = $request->input('term');
        $activity->price = $request->input('price');
        $activity->location = $request->input('location');
        $activity->category_id = $request->input('category');
        $activity->save();

        if($request->input('term') == "term"):
            
            if($request->input('term_id')):
                $term = Term::find($request->input('term_id'));
            else:
                $term = new Term();
            endif;

            $term->activity_id = $activity->id;
            $term->start = $request->input('term_start');
            $term->end = $request->input('term_end');
            $term->spots_available = $request->input('spots_available');
            $term->save();
        endif;

        if($request->file()):
            foreach($request->file('images') as $image):
                $path = Storage::disk('public')->put('images', $image);
                $media = new ActivityMedia;

                $media->img_url = $path;
                $media->activity_id = $activity->id;
                $media->save();
            endforeach;
        endif;

        return redirect("/activities/{$activity->id}")->with('success', 'Activity Successfully Updated');
    }

    public function delete_image(Request $request)
    {
        die('eh');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
