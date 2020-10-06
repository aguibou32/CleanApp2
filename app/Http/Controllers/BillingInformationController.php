<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillingInformation;

class BillingInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $billing_information = BillingInformation::latest()->get();
        return $billing_information;

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
        //

        $billing_information = new BillingInformation;

        request()->validate([
            'name_on_card'=> ['required'],
            'card_type' => ['required'],
            'card_number' => ['required'],
            'month' => ['required', 'min:2', 'max:2'],
            'year' => ['required', 'min:4','max:4'],
        ]);

        $billing_information->name_on_card = request('name_on_card');
        $billing_information->card_type = request('card_type');
        $billing_information->card_number = request('card_number');
        $billing_information->month = request('month');
        $billing_information->year = request('year');
        $billing_information->user_id = request('user_id');
        $billing_information->save();

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
        $billing_information = BillingInformation::findOrFail($id);
        return $billing_information;
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

        $billing_information = BillingInformation::findOrFail($id);

        request()->validate([
            'name_on_card'=> ['required'],
            'card_type' => ['required'],
            'card_number' => ['required'],
            'month' => ['required', 'min:2', 'max:2'],
            'year' => ['required', 'min:4','max:4'],
            'user_id' => ['required'],
        ]);

        $billing_information->name_on_card = request('name_on_card');
        $billing_information->card_type = request('card_type');
        $billing_information->card_number = request('card_number');
        $billing_information->month = request('month');
        $billing_information->year = request('year');
        $billing_information->user_id = request('user_id');

        $billing_information->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $billing_information = BillingInformation::findOrFail($id);
        $billing_information->delete();
    }
}
