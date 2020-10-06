<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\LocationAddress;
use App\InformalInvoice;
use Illuminate\Http\Request;
use App\InformalCollector;
use QRCode;
use App\User;

class InformalColllectorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $invoices = InformalInvoice::latest()->get();
        return $invoices;
        
        return view('users.informal_collectors')->with('invoices', $invoices);

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
        request()->validate([
            'name' =>  ['required', 'max:255'],
            'surname' =>  ['required', 'max:255'],
            'phone_no' =>  ['required'],
        ]);

        $user = new User;

        $user->name = request('name');
        $user->surname = request('surname');
        $user->gender = "N/A";
        $user->email = uniqid();
        $user->phone_no = request('phone_no');
        $user->QRCode = "independent_collector.png";
        $user->password = Hash::make(request('password'));
        
        $user->save();

        $address = new LocationAddress;
        $address->street_name = "N/A";
        $address->unit_number = 000;
        $address->complexe_name = "N/A";
        $address->province_name = 0000;
        $address->city_name = "N/A";

        $address->user_id = $user->id;

        $address->save();
        
        return redirect()->back()->withSuccess('Informal Collector Added !');

       

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
}
