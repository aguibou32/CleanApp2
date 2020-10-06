<?php

namespace App\Http\Controllers;

use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\InformalInvoice;
use Mail;
use PDF;

class InformalInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = InformalInvoice::latest()->get();

        // return $invoices;

        return view('users.informal_collectors')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){

        // return $request->all();
    
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
    
              $invoice = new InformalInvoice;
              $invoice->name = request('name');
              $invoice->surname = request('surname');
              $invoice->number_of_collection_material = request('number_of_collection_material');
              $invoice->value = request('amount');

              $invoice->save();



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
        <h2>Informal Collection Invoice</h2> <span>invoice no:{$invoice->id}000</span> <br>
        <table>
          <tr>
            <th>Company: CleanApp</th>
            <th>Country: South African Contact: clean.app@app.co.za</th>
          </tr>
          <tr>
            <td>Collector name: {$invoice->name}</td>
            <td>Collector surname : {$invoice->surname}</td>
          </tr>

          <tr>
            <td>Material Qty: {$invoice->number_of_collection_material}</td>
            <td>Collection Value : R{$invoice->value}</td>
          </tr>
         
        </table>";

        $pdf = PDF::loadHtml($html);
        // return $pdf->stream('file.pdf');

        $pdfFilePath = storage_path('invoices/informal/' . uniqid() .'/invoice.pdf');
        $pdf->save($pdfFilePath);

        Mail::send('emails.informal_invoice', ['collector_name'=>request('name'),
                                      'collector_surname'=>request('surname'),
                                      'collection_value'=>request('amount'),
                                      'email'=>request('email'),
                                      'items_number'=>request('number_of_collection_material'),

                                      'invoice'=>$invoice], function($message) use ($pdfFilePath){
                                          $message->subject("Informal Collection Invoice");
                                          $message->from(Auth::user()->email);
                                          $message->to('cleanapp@admin.co.za');
                                          $message->attach($pdfFilePath, ['as' => 'invoice.pdf', 'mime' => 'application/pdf']);

        });

              return redirect()->back()->withSuccess('Thank you! Your payment has been accepted');
      
          } catch (CardErrorException $e) {
              return back()->withErrors('Error! ' . $e->getMessage());
          }
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
