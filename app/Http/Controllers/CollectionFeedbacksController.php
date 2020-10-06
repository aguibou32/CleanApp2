<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\CollectionFeedback;
use App\Collection;

class CollectionFeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('collection.collection_feedback');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'feedback_message'=> ['required'],
            'rating' => ['required'],
            'collection_id' => ['required'],
            'collector_id' => ['required'],
        ]);

        $collection_feedback = new CollectionFeedback;


        $collection = Collection::findOrFail(request('collection_id'));

        $collection_feedback->feedback_message = request('feedback_message');
        $collection_feedback->rating = request('rating');
        $collection_feedback->collection_id =$collection->id;
        $collection_feedback->collector_id = request('collector_id');

        $collection_feedback->save();

        return redirect()->route('welcome')->withSuccess('Thank you for rating our collector');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $collection = Collection::findOrFail($id);

        return view('collection.collection_feedback')->with('collection', $collection);

        // $collection_feedback = CollectionFeedback::findOrFail($id);
        // return $collection_feedback;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $collection_feedback = CollectionFeedback::findOrFail($id);

        request()->validate([
            'feedback_message'=> ['required'],
            'rating' => ['required'],
            'collection_id' => ['required'],
        ]);

        $collection_feedback->feedback_message = request('feedback_message');
        $collection_feedback->rating = request('rating');
        $collection_feedback->collection_id = request('collection_id');

        $collection_feedback->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection_feedback = CollectionFeedback::findOrFail($id);
        $collection_feedback->delete();
    }
}
