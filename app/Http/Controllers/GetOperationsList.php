<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexOpetationsValidatorRequest;
use App\models\Clients;
use Carbon\Carbon;
use Illuminate\Http\Request;


class GetOperationsList extends Controller
{
    public function index (IndexOpetationsValidatorRequest $request){
        $listOfClientsWithRate = [];

        $dateFrom =  Carbon::parse($request->route('dateFrom'));
        $dateTo =  Carbon::parse($request->route('dateTo'));
        $user_id = (int) $request->route('user_id');
        $listOfClients = Clients::whereBetween('created_at',[$dateFrom,$dateTo])
                        ->where('user_id','=', $user_id)
                       ->get();

        $listOfClients->each(function ($item, $key) use ($listOfClientsWithRate) {
            $item->rate = self::calculateRate($item->provided_capital, $item->total_capital);
        });

        return $listOfClients->toJson();



    }
    function calculateRate($provided_capital, $total_capital) {
        $rate = ((float) $provided_capital * 100) / $total_capital;
        $rate = round( $rate, 0);
        return $rate;
    }

}
