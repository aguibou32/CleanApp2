<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDumpingExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ReportDumping;

class ReportDumpingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['verified', 'auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dumpings = ReportDumping::latest()->get();
        // return $dumpings;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('report_dumpings.create');
    }

    public function export_dumping_requests(){
        // $requests = RecyclingRequest::all();
        // return $requests;
        return Excel::download(new ReportDumpingExport, 'illigal_dumping_requests.xlsx');
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
            'address'=> ['required'],
            'dumping_picture' => ['required', 'file', 'image', 'max:5000'],
        ]);

        $dumping = new ReportDumping;

        $dumping->address = request('address');
        $dumping->dumping_picture = request()->dumping_picture->store('report_dumpings','public');

        $dumping->resident_id = Auth::user()->profile_id;

        $dumping->save();

        return redirect()->route('welcome')->withSuccess('Thank you for report illigal dumping ! <br/> We will collect it');
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
        $dumping = ReportDumping::find($id);
        return $dumping;

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
        request()->validate([
            'address'=> ['required'],
            'dumping_picture' => ['required'],
            'resident_id' => ['required'],
        ]);

        $dumping = ReportDumping::findOrFail($id);

        $dumping->address = request('address');
        $dumping->dumping_picture = request('dumping_picture');
        $dumping->resident_id = request('resident_id');
        $dumping->save();

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
        $dumping = ReportDumping::findOrFail($id);
        $dumping->delete();

        return redirect()->back()->withSuccess('dumping report removed !');
    }

    public function search_illigal_dumping_places(Request $request){

        // DO NOT FORGET THE TURN BACK ON THE MIDDLEWARE

        // return request()->all();

        

        $places = ReportDumping::all();
        return $places;

       

    }
}
