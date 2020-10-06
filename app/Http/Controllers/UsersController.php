<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\IndependentCollector;
use App\RecyclingRequest;
use Illuminate\Http\Request;
use App\LocationAddress;
use App\PickItUpCenter;
use App\BuyBackCenter;
use App\ReportDumping;
use App\Collection;
use App\Resident;
use App\Vehicle;
use App\User;
use Mail;
use Gate;
use DB;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth')->except('create','index', 'store');
    }

    public function index()
    {
        // This where I learned to to implement the following Access Control Level method https://www.youtube.com/watch?v=yKxR8TQrr2A
        
       
        // if(!Gate::allows('isAdmin')){
        //     return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        // }

        $users = User::latest()->get();
        $requests = RecyclingRequest::all();

        // return $requests;

        $dumpings = ReportDumping::all();
        
        return view('users.index')->with('users', $users)
                                 ->with('requests', $requests)
                                 ->with('dumpings', $dumpings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('users.create');
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
            'surname' => ['required', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_no' => ['required', 'numeric'],
            'profile_type' => ['required', 'max:255'],
            'street_name'=> ['required', 'max:255'],
            'unit_number' => ['required', 'numeric'],
            'complexe_name' => ['required', 'max:255'],
            'province_name' => ['required', 'max:255'],
            'city_name' => ['required', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = new User;

        $user->name = request('name');
        $user->surname = request('surname');
        $user->gender = request('gender');
        $user->email = request('email');
        $user->phone_no = request('phone_no');
        
        $user->password = Hash::make(request('password'));
        
        
        $user->save();
        
        $address = new LocationAddress;
        $address->street_name = request('street_name');
        $address->unit_number = request('unit_number');
        $address->complexe_name = request('complexe_name');
        $address->province_name = request('province_name');
        $address->city_name = request('city_name');

        $address->user_id = $user->id;

        $address->save();

        if(request('profile_type') == "Resident" || request('profile_type') == "App\\Resident"){
            
            $profile = Resident::create([]);
            $profile->user()->save(User::find($user->id));

            Mail::send('emails.registration_email', ['name'=>request('name'), 'surname'=>request('surname')], function($message){
                                          $message->subject("Welcome Message");
                                          $message->from('admin@cleanapp.co.za');
                                          $message->to(request('email'));

        });



        }
       
        if(request('profile_type') == "IndependentCollector" || request('profile_type') == "App\\IndependentCollector"){


            // We are creating the vehicle because it only belongs to this specfic type of user (independent collector)
            $profile = IndependentCollector::create([]);
            $profile->user()->save(User::find($user->id));

            $user = User::find($user->id); // find the specefic user
            
            $collector = $user->profile; // find the collector
            
            $vehicle = new Vehicle; // new instance of vehicle;
            $vehicle->collector_id = $collector->id;
            $vehicle->save();
        }

        if(request('profile_type') == "PickItUpCenter" || request('profile_type') == "App\\PickItUpCenter"){
            
            $profile = PickItUpCenter::create([]);
            $profile->user()->save(User::find($user->id));
        }

        if(request('profile_type') == "BuyBackCenter" || request('profile_type') == "App\\BuyBackCenter"){
           
            $address = request('unit_number'). " " .request('street_name'). " " .request('province_name')." " .request('city_name');

            $profile = BuyBackCenter::create(['site_name'=>request('name'), 'site_address'=> $address]);
            $profile->user()->save(User::find($user->id));
        }

        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);  
        return view('users.show')->with('user', $user);
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
        // if(!Gate::allows('isAdmin')){
        //     return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        // }
    }

    public function export_users(){

        return Excel::download(new UsersExport, 'users.xlsx');

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

        // if(!Gate::allows('isAdmin')){
        //     return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        // }

        request()->validate([
            'name' =>  ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_no' => ['required', 'numeric'],
            'profile_type' => ['required', 'max:255'],
            'street_name'=> ['required', 'max:255'],
            'unit_number' => ['required', 'max:255'],
            'complexe_name' => ['required', 'max:255'],
            'province_name' => ['required', 'max:255'],
            'city_name' => ['required', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::findOrFail($id);
        
        $user->name = request('name');
        $user->surname = request('surname');
        $user->gender = request('gender');
        $user->email = request('email');
        $user->phone_no = request('phone_no');
        
        $user->password = Hash::make(request('password'));
        
        
        $user->save();
        
        // $address = new LocationAddress;
        $address = $user->address;

        $address->street_name = request('street_name');
        $address->unit_number = request('unit_number');
        $address->complexe_name = request('complexe_name');
        $address->province_name = request('province_name');
        $address->city_name = request('city_name');

        $address->user_id = $user->id;

        $address->save();

    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        //
        $user = User::findOrFail($id);
        // return request("active");
        if(request('active') == 'active'){
            
            $user->active = "deactive";
            $user->save();

            return redirect()->back();
        }
        else if(request('active') == 'deactive'){
            $user->active = "active";
            $user->save();
            return redirect()->back();
        }

        if(!Gate::allows('isAdmin')){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!Gate::allows('isAdmin')){
        //     return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        // }

        $user = User::findOrFail($id);
        

        if($user->profile_type == "App\Resident" || $user->profile_type == "App\\Resident"){
           
            $resident = Resident::findOrFail($user->profile_id);
            $resident->delete();
        }
       
        if($user->profile_type == "App\IndependentCollector" || $user->profile_type == "App\\IndependentCollector"){

            $collector = IndependentCollector::findOrFail($user->profile_id);
            $collector->delete();
        }

        if($user->profile_type == "App\PickItUpCenter" || $user->profile_type == "App\\PickItUpCenter"){
            
            $p_center = PickItUpCenter::findOrFail($user->profile_id);
            $p_center->delete();
        }

        if($user->profile_type == "App\BuyBackCenter" || $user->profile_type == "App\\BuyBackCenter"){
           
            $b_center = BuyBackCenter::findOrFail($user->profile_id);
            $b_center->delete();
        }

        $user->delete();
        

    }
}
