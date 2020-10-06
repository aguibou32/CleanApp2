<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RecyclingRequestExport;
use Illuminate\Http\Request;
use App\RecyclingRequest;
use App\PickItUpRequest;
use App\Request as RequestCollection;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use QRCode;

class RequestsController extends Controller
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
        $requests = RecyclingRequest::latest()->get();
        
        // foreach($requests as $request){
        //     return $request->request->resident->user->name;
        // }
        return view('collection.index')->with('requests',$requests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'address' =>  ['required'],
            'material_type' => ['required'],
            "material_quantity" => ['required', 'numeric', 'min:50'],
        ]);

        $request = new RequestCollection;
        $request->address = request('address');
        $request->resident_id = Auth::user()->profile_id;
               
        $request->save();

        if(request('request_profile_type') == "RecyclingRequest" || request('request_profile_type') == "App\\RecyclingRequest"){
            
            $c_value = request('material_quantity') * 2;

            $file = storage_path('/app/public/qrcode/'.$request->id.'.png');
            $qrcodefile = QRCode::text("address: " .$request->address. " material type: " . request('material_type') . " quantity: " . request('material_quantity'). " total: R" . $c_value )->setSize(3)->setOutfile($file)->png();
           
            $recycling_request = RecyclingRequest::create(['material_type'=>request('material_type'), 
            'material_quantity'=> request('material_quantity'), 
            'collection_value'=>$c_value, 
            'collection_status'=>'requested',
            'collection_QRCode'=> $request->id .'.png']);

            $recycling_request->request()->save(RequestCollection::find($request->id));

            return redirect()->back()->withSuccess('Request for collection sent !');
        }

        if(request('request_profile_type') == "PickItUpRequest" || request('request_profile_type') == "App\\PickItUpRequest"){
            
            $recycling_request = PickItUpRequest::create([]);
            $recycling_request->request()->save(RequestCollection::find($request->id));
        }

        return redirect()->route('requests.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = RequestCollection::find($id);
        return $request;
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

    public function export_requests(){
        // $requests = RecyclingRequest::all();
        // return $requests;
        return Excel::download(new RecyclingRequestExport, 'recycling_requests.xlsx');
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
            'address' =>  ['required'],
            'resident_id' => ['required'],
        ]);

        $request = RequestCollection::find($id);
        $request->address = request('address');
        // $request->request_profile_type = request('request_profile_type');
        // $request->request_profile_id = request('request_profile_id');
        $request->resident_id = request('resident_id');
        
        $request->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = RequestCollection::find($id);
        if($request->request_profile_type == "RecyclingRequest" || $request->request_profile_type == "App\\RecyclingRequest"){
            
            $recycling_request = RecyclingRequest::findOrFail($request->request_profile_id);
            $recycling_request->delete();
        }

        if($request->request_profile_type == "PickItUpRequest" || $request->request_profile_type == "App\\PickItUpRequest"){
            
            $recycling_request = PickItUpRequest::findOrFail($request->request_profile_id);
            
            $recycling_request->delete();
        }

        $request->delete();


    }
}
