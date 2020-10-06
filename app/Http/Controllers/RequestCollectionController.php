<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\RequestCollection;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class RequestCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $request_collections = RequestCollection::latest()->get();

        return view('collection.index')->with('request_collections', $request_collections);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('collection.create');
        
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
            'name' =>  ['required', 'max:255'],
            'surname' =>  ['required', 'max:255'],
            'email' =>  ['required', 'max:255'],
            'phone_no' =>  ['required', 'max:255'],
            'address' =>  ['required'],
            'material_type' =>  ['required'],
            'material_quantity' =>  ['required', 'numeric', 'min:150']
        ]);

        $request_collection = new RequestCollection;

        $request_collection->name = request('name');
        $request_collection->surname = request('surname');
        $request_collection->email = request('email');
        $request_collection->phone_no = request('phone_no');
        $request_collection->address = request('address');
        $request_collection->material_type = request('material_type');
        $request_collection->material_quantity = request('material_quantity');
        $request_collection->collection_value = request('material_quantity') * 5;
        
        $request_collection->collection_status = "available";
        $request_collection->user_id = Auth::user()->id;

        $request_collection->save();

        return redirect()->back()->withSuccess('Request for collection sent !');
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
        //
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

    public function request_collection($id){
        $request_collection = RequestCollection::findOrFail($id);

        $request_collection->collection_status = "in progress";

        $request_collection->save();

        return redirect()->back()->withSuccess("You may process to picking up the recyclables !");
    }
}
