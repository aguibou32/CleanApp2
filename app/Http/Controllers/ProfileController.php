<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('profile.index');
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
        $user = User::findOrFail($id);

        if(auth()->user()->id !== $user->id){
            return redirect()->back()->withToastError('You are not allowed to perfom that action !');
        } 
        // return $user;
        return view('profile.edit')->with('user', $user);
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

        $user = User::FindOrFail($id);
        // return request();
        
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],  
            'phone_no' => ['required', 'string'],


            'unit_number'=> ['required', 'integer'],
            'complexe_name'=> ['required', 'string'],
            'street_name'=> ['required', 'string'],
            'province_name'=> ['required', 'string'],
            'city_name'=> ['required', 'string']

        ]);

        $user->name = request('name');
        $user->surname = request('surname');
        $user->gender = request('gender');
        $user->email = request('email');
        $user->phone_no = request('phone_no');

        $user->address->unit_number = request('unit_number');
        $user->address->complexe_name = request('complexe_name');
        $user->address->street_name = request('street_name');
        $user->address->province_name = request('province_name');
        $user->address->city_name = request('city_name');
 
        if(request()->has('profile_picture')){
            // dd(request()->profile_picture);
            request()->validate([
                'profile_picture' => ['file', 'image', 'max:5000']
            ]);
            $user->profile_picture = request('profile_picture')->store('profile pictures', 'public');
            // Here we are storing the profile picture inside storage/public/profile pictures. Now we have to remember to link the storage directory and the public directory 
        }        
        
        if(request()->has('identification_file')){
            
            // dd(request()->identification_file);

            request()->validate([
                'identification_file' => ['file', 'mimes:pdf', 'max:5000']
            ]);
            $user->profile->identification = request('identification_file')->store('drivers/identification', 'public');

            // Here we are storing the profile picture inside storage/public/profile pictures. Now we have to remember to link the storage directory and the public directory 
        }

        if(request()->has('criminal_record_file')){
            
            // dd(request()->criminal_record_file);
            request()->validate([
                'criminal_record_file' => ['file', 'mimes:pdf', 'max:5000']
            ]);
            $user->profile->criminal_record = request('criminal_record_file')->store('drivers/criminal records', 'public');
            // Here we are storing the profile picture inside storage/public/profile pictures. Now we have to remember to link the storage directory and the public directory 
        }

        if(request()->has('driver_license_file')){
            
            // dd(request()->driver_license_file);

            request()->validate([
                'driver_license_file' => ['file', 'mimes:pdf', 'max:5000']
            ]);
            $user->profile->driver_license = request('driver_license_file')->store('drivers/license', 'public');
            // Here we are storing the profile picture inside storage/public/profile pictures. Now we have to remember to link the storage directory and the public directory 
        }

        if(request()->has('ck_file')){
            
            // dd(request()->ck_file);

            request()->validate([
                'ck_file' => ['file', 'mimes:pdf', 'max:5000']
            ]);
            $user->profile->ck_file = request('ck_file')->store('buy_back_centers', 'public');
            // Here we are storing the profile picture inside storage/public/profile pictures. Now we have to remember to link the storage directory and the public directory 
        }

         
        $user->save();
        $user->address->save();
        $user->profile->save();
        return redirect()->route('profile.edit', $user->id)->withToastSuccess('profile updated');
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
