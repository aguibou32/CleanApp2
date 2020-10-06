<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CollectionInvoice;

class CollectionInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = CollectionInvoice::latest()->get();
        return $invoices;

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
        return "test";
        
        $invoice = new CollectionInvoice;

        request()->validate([
           'material_type' => ['required'],
           'material_quantity' => ['required'],
           'collection_value' => ['required'],
           'tax' => ['required'],
           'total' => ['required'],
           'resident_share' => ['required'],
           'collector_share' => ['required'],
           'cleanapp_share' => ['required'],
           'collector_id' => ['required'],
           'collection_id' => ['required'],
           'buy_back_center_id' => ['required'],
        ]);

        $invoice->material_type = request('material_type');
        $invoice->material_quantity = request('material_quantity');
        $invoice->collection_value = request('collection_value');
        $invoice->tax = request('tax');
        $invoice->total = request('total');
        $invoice->resident_share = request('resident_share');
        $invoice->collector_share = request('collector_share');
        $invoice->cleanapp_share = request('cleanapp_share');
        $invoice->collector_id = request('collector_id');
        $invoice->collection_id = request('collection_id');
        $invoice->buy_back_center_id = request('buy_back_center_id');

        $invoice->save();

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

        $invoice = CollectionInvoice::findOrFail($id);
        return $invoice;

    }

    public function collection_invoice($id){
        return 'test';
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

        $invoice = new CollectionInvoice;

        request()->validate([
           'material_type' => ['required'],
           'material_quantity' => ['required'],
           'collection_value' => ['required'],
           'tax' => ['required'],
           'total' => ['required'],
           'resident_share' => ['required'],
           'collector_share' => ['required'],
           'cleanapp_share' => ['required'],
           'collector_id' => ['required'],
           'collection_id' => ['required'],
           'buy_back_center_id' => ['required'],
        ]);

        $invoice->material_type = request('material_type');
        $invoice->material_quantity = request('material_quantity');
        $invoice->collection_value = request('collection_value');
        $invoice->tax = request('tax');
        $invoice->total = request('total');
        $invoice->resident_share = request('resident_share');
        $invoice->collector_share = request('collector_share');
        $invoice->cleanapp_share = request('cleanapp_share');
        $invoice->collector_id = request('collector_id');
        $invoice->collection_id = request('collection_id');
        $invoice->buy_back_center_id = request('buy_back_center_id');

        $invoice->save();

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
        $invoice = CollectionInvoice::findOrFail($id);

        request()->validate([
           'material_type' => ['required'],
           'material_quantity' => ['required'],
           'collection_value' => ['required'],
           'tax' => ['required'],
           'total' => ['required'],
           'resident_share' => ['required'],
           'collector_share' => ['required'],
           'cleanapp_share' => ['required'],
           'collector_id' => ['required'],
           'collection_id' => ['required'],
           'buy_back_center_id' => ['required'],
        ]);

        $invoice->material_type = request('material_type');
        $invoice->material_quantity = request('material_quantity');
        $invoice->collection_value = request('collection_value');
        $invoice->tax = request('tax');
        $invoice->total = request('total');
        $invoice->resident_share = request('resident_share');
        $invoice->collector_share = request('collector_share');
        $invoice->cleanapp_share = request('cleanapp_share');
        $invoice->collector_id = request('collector_id');
        $invoice->collection_id = request('collection_id');
        $invoice->buy_back_center_id = request('buy_back_center_id');

        $invoice->save();
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
        $invoice = CollectionInvoice::findOrFail($id);
        $invoice->delete();
    }
}
