<?php

namespace App\Http\Controllers;

use ArielMejiaDev\LarapexCharts\LarapexChart;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Charts\UsersChart;
use App\CollectionFeedBack;
use App\RecyclingRequest;
use App\ReportDumping;
use App\Collection;
use App\User;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        $users_residents = User::where('profile_type', 'App\Resident')->count();
        $users_collectors = User::where('profile_type', 'App\IndependentCollector')->count();
        $users_buy_back_centers = User::where('profile_type', 'App\BuyBackCenter')->count();
        $users_pick_it_up_employes = User::where('profile_type', 'App\PickItUpCenter')->count();
        $users_informal_collectors = User::where('profile_type', null)->count();

        $male_users = User::Where('gender', 'male')->Where('profile_type', 'App\Resident')->count();
        $female_users = User::Where('gender', 'female')->Where('profile_type', 'App\Resident')->count();

        $requests = RecyclingRequest::pluck('material_quantity', 'created_at');

        $chart00 = (new LarapexChart)->setTitle('Residents By Gender')
        ->setDataset([$male_users, $female_users])
        ->setLabels(['Male', 'Female']);

       
        $chart0 = (new LarapexChart)->setTitle('Users by Category')
        ->setSubtitle('From May To Date')
        ->setType('bar')
        ->setXAxis(['User Category'])
        ->setGrid(true)
        ->setDataset([
            [
                'name'  => 'Resident',
                'data'  =>  [$users_residents]
            ],
            [
                'name'  => 'Independent Collectors',
                'data'  => [$users_collectors]
            ],
            [
                'name'  => 'Buy Back Centers',
                'data'  => [$users_buy_back_centers]
            ],
            [
                'name'  => 'PickItUp Employee',
                'data'  => [$users_pick_it_up_employes]
            ],
            [
                'name'  => 'Informal Collectors',
                'data'  => [$users_informal_collectors]
            ]
            
        ])
        ->setStroke(1);

        $chart = (new LarapexChart)->setType('line')
        ->setTitle('All Recyling Requests made by residents')
        ->setSubtitle('From May to date')
        ->setXAxis([
        ])
        ->setDataset([
            [
                'name'  =>  'recyclable material',
                'data'  =>  $requests->values()
            ]
        ]);

        $delivered = RecyclingRequest::where('collection_status', 'delivered')->count();
        $in_progress = RecyclingRequest::where('collection_status', 'in progress')->count();
        $requested = RecyclingRequest::where('collection_status', 'requested')->count();

        $chart2 = (new LarapexChart)->setType('donut')
        ->setTitle('Collection status')
        ->setDataset([$delivered, $in_progress, $requested])
        ->setColors(['#008000', '#dc3545', '#ffc73c'])
        ->setLabels(['Delivered', 'In Progress', 'Requested']);

        // $values = RecyclingRequest::where('co', 'created_at');

        $collection_values = RecyclingRequest::all()->pluck('collection_value')->toArray();

        $chart3 = (new LarapexChart)->setType('area')
        ->setTitle('Value of all requests')
        ->setSubtitle('From May to date')
        ->setDataset([
            [
                'name'  =>  'Value in Rand',
                'data'  =>  $collection_values
            ]
        ]);

        $buy_back_centers_payments =[];

        $collectors_payments =[];

        $cleanapp_payments =[];
        
        $amount_residents = 0;
        $amount_cleanapp = 0;
        $amount_collectors = 0;

        foreach ($collection_values as $c_value) {
            $buy_back_centers_payments[] = $c_value + $c_value * 0.1;
        }

        foreach ($collection_values as $c_value) {
            $collectors_payments[] = $c_value * 0.1 * 0.75;
            $amount_residents = $amount_residents + $c_value;
            $amount_collectors = $amount_collectors + $c_value * 0.1 * 0.75;
        }

        foreach ($collection_values as $c_value) {
            $cleanapp_payments[] = $c_value * 0.1 * 0.25;
            $amount_cleanapp =$amount_cleanapp + $c_value * 0.1 * 0.25;
        }

        $chart4 = (new LarapexChart)->setTitle('Profit')
        ->setSubtitle('From May To date')
        ->setType('bar')
        ->setGrid(true)
        ->setDataset([
            [
                'name'  => 'Resident share',
                'data'  => $collection_values
            ],
            [
                'name'  => 'Payment made by Buy Back Center',
                'data'  => $buy_back_centers_payments
            ],
            [
                'name'  => 'Collector Share',
                'data'  =>  $collectors_payments
            ],
            [
                'name'  => 'CleanApp Share',
                'data'  => $cleanapp_payments
            ]
        ])
        ->setStroke(1);



        // return $chart;


        $user = Auth::user();
        $requests =  RecyclingRequest::latest()->get();
        $collections = Collection::latest()->get();
        $collections = Collection::all();
        $illigal_dumpings = ReportDumping::all();

        $feedbacks = CollectionFeedback::all();

        $users = User::all();
        $collectors = User::where('profile_type', 'App\IndependentCollector')->get();
        $residents = User::where('profile_type', 'App\Resident')->get();
        $buy_back_centers = User::where('profile_type', 'App\BuyBackCenter')->get();

        $recycling_requests = RecyclingRequest::all();
        $recycling_requests_completed =  RecyclingRequest::where('collection_status', 'purchased')->get();
        $recycling_requests_pending =  RecyclingRequest::where('collection_status', 'requested')->get();


        return view('dashboard.index')->with('requests', $requests)->with('collections', $collections)
                                      ->with('collections', $collections)
                                      ->with('feedbacks', $feedbacks)
                                      ->with('illigal_dumpings', $illigal_dumpings)
                                      ->with('users', $users)
                                      ->with('collectors', $collectors)
                                      ->with('residents', $residents)
                                      ->with('amount_residents', $amount_residents)
                                      ->with('amount_collectors', $amount_collectors)
                                      ->with('amount_cleanapp',$amount_cleanapp)
                                      ->with('chart00', $chart00)
                                      ->with('chart0', $chart0)
                                      ->with('chart', $chart)
                                      ->with('chart2', $chart2)
                                      ->with('chart3', $chart3)
                                      ->with('chart4', $chart4)
                                      ;


    }
}
