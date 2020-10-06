<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\User;

class UsersChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $users = User::all();

        return Chartisan::build()
            ->labels(['First', 'Second', 'Third'])
            ->dataset('users', [$users->keys()])
            ->dataset('user 2', [$users->values()]);
            
    }
}