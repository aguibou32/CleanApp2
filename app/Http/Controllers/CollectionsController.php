<?php

namespace App\Http\Controllers;

use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use RealRashid\SweetAlert\Facades\Alert;
use App\Request as RequestCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\CollectionInvoice;
use App\RecyclingRequest;
use App\BuyBackCenter;
use App\Collection;
use App\User;
use Mail;
use PDF;

class CollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
        $collections = Collection::latest()->get();
        return $collections;
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


    public function map(Request $request){
      return view('collection.map');
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
       //    return request()->all();
        request()->validate([
            'collection_status' => ['required'],
            'collector_id' => ['required'],
            'request_id' => ['required'],
        ]);
        
        $collection = new Collection;
        $collection->collection_status = request('collection_status');
        $collection->collector_id = request('collector_id'); 
        $collection->request_id = request('request_id'); 

        $request = RecyclingRequest::where('id', $collection->request_id)->first();
        $request->collection_status = request('collection_status');
        $request->save();
        $collection->save();
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
        //
        $buy_back_centers = BuyBackCenter::latest()->get();
        
        $collection = Collection::findOrFail($id);

        // return $user->name;

        $request = RecyclingRequest::where('id', $collection->request_id)->first();
        
        $requested_by = $request->request->resident->user;

        return view('dashboard.show_collection')->with('request', $request)
                                                ->with('requested_by', $requested_by) 
                                                ->with('collection', $collection)
                                                ->with('buy_back_centers', $buy_back_centers);
    }

    public function sell(){

        $request = RecyclingRequest::findOrFail(request('request_id'));
        $request->collection_status = "delivered";
        $request->save();

        $collection = Collection::findOrFail(request('collection_id'));
        $collection->collection_status = "delivered";
        $collection->save();

        return redirect()->back()->withSuccess('collection delivered');
    }

    public function create_invoice(){

        // return request()->all();


        $collection = RecyclingRequest::findOrFail(request('request_id'));
        
        $invoice = new CollectionInvoice;

        $invoice->material_type = $collection->material_type;
        $invoice->material_quantity =$collection->material_quantity;
        $invoice->collection_value = $collection->collection_value;
        $invoice->tax = 1;
        $invoice->total = $collection->collection_value + (10 * $collection->collection_value /100);
        $invoice->resident_share = $collection->collection_value;
        $invoice->collector_share = (10 * $collection->collection_value /100) * 0.75;
        $invoice->cleanapp_share = (10 * $collection->collection_value /100) * 0.25;

        

        // We know each collection (collection table) has a collector_id associated with it, now all we need to do is to first get that collection
        // using the request_id; the request_id is the RecyclingRequest id. So if we know the request_id, we can get the collector associated with
        // that request;


        $collection = Collection::where('request_id', request('request_id'))->first();
        $invoice->collector_id = $collection->collector_id;
       
        // If we get the collector_id associated with a request, we can back into user table where user_profile is IndependentCollector
        // and where the profile id is the same as the collector id we found above; then we can get the independent collector

        $collector = User::where('profile_type', 'App\IndependentCollector')->
                           where('profile_id', $invoice->collector_id)->first();

        $invoice->collection_id = request('request_id');
        $invoice->buy_back_center_id = Auth::user()->profile_id;
      
        $invoice->save();

        $name = Auth::user()->name;
        $surname = Auth::user()->surname;
        $contact = Auth::user()->phone_no;

        $surname = Auth::user()->surname;
        $address = Auth::user()->address->unit_number . " " . Auth::user()->address->street_name . " " 
        .Auth::user()->address->complexe_name . " " 
        .Auth::user()->address->city_name . " " . Auth::user()->address->prince_name;

        $html = "
        
        <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>
        </head>
        <body>
        <h2>Collection Invoice</h2> <span>invoice no:{$invoice->id}000</span> <br>
        <table>
          <tr>
            <th>Company: CleanApp</th>
            <th>Contact: clean.app@app.co.za</th>
            <th>Country: South Africa</th>
          </tr>
          <tr>
            <td>Genereated by: {$name} {$surname} </td>
            <td>Address: {$address}</td>
            <td>Contact: {$contact}</td>
          </tr>
          <tr>
            <td>Material Type: {$invoice->material_type}</td>
            <td>Material Qty: {$invoice->material_quantity}</td>
            <td>Collection Value : R{$invoice->collection_value}</td>
          </tr>
          <tr>
            <td>Amount received by resident: R{$invoice->resident_share}</td>
            <td>Collector Share: R{$invoice->collector_share}</td>
            <td>Clean App Share: R{$invoice->cleanapp_share}</td>
          </tr>
        </table>";

        $pdf = PDF::loadHtml($html);
        // return $pdf->stream('file.pdf');

        $pdfFilePath = storage_path('invoices/' . uniqid() .'/invoice.pdf');
        $pdf->save($pdfFilePath);

        Mail::send('emails.invoice', ['requested_by_name'=>request('requested_by_name'),
                                      'requested_by_surname'=>request('requested_by_surname'),
                                      'collector'=>$collector,
                                      'collection'=>$collection,
                                      'invoice'=>$invoice], function($message) use ($pdfFilePath){
                                          $message->subject("Collection invoice");
                                          $message->from(Auth::user()->email);
                                          $message->to(request('requested_by_email'));
                                          $message->attach($pdfFilePath, ['as' => 'invoice.pdf', 'mime' => 'application/pdf']);

        });

        return redirect()->back()->withSuccess('Invoice has been generated and sent !');

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
            'collection_status' => ['required'],
            'collector_id' => ['required'],
            'request_id' => ['required']
        ]);
        
        $collection = Collection::findOrFail($id);
        $collection->collection_status = request('collection_status');
        $collection->collector_id = request('collector_id'); 

        $collection->save();

    }

    public function payment(Request $request){

      // return $request->all();
      $collection = Collection::findOrFail($request->collection_id);
      $material_price = $request->material_price;
      // return $material_price;

      return view('dashboard.payment')->with('collection', $collection)->with('material_price', $material_price);

    }

    public function charge(Request $request){

    //  return $request->all();

      request()->validate([
        'amount' => "required|numeric|gt:0",
    ]);

      try {
          $charge = Stripe::charges()->create([
              'amount' => $request->amount,
              'currency' => 'ZAR',
              'source' => $request->stripeToken,
              'description' => 'Payment made for collection',
              'receipt_email' => $request->email,
              'metadata' => [
                  'data1' => 'metadata 1',
                  'data2' => 'metadata 2',
                  'data3' => 'metadata 3',
              ],
          ]);

          $collection = Collection::findOrFail($request->collection_id);
          $collection->payment_status = "payment made";
          $collection->collection_status = "purchased";
          $collection->save();
          
          return redirect()->route('collections.show', $collection->id)->withSuccess('Thank you! Your payment has been accepted');
  
      } catch (CardErrorException $e) {
          return back()->withErrors('Error! ' . $e->getMessage());
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
        $collection = Collection::findOrFail($id);
        $collection->delete();
    }
}
