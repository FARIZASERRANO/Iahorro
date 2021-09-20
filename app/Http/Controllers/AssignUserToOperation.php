<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\User;

class AssignUserToOperation extends Controller
{

    public static function assignUserToOperation(Clients $clients){
        $result = array();

        if($clients->getAttribute('name') == null){
            $clients = Clients::all()->whereNull('user_id');
        }


        $clients->each(function ($item, $key) use ($result) {
            $item->user_id = self::generateRandomUser();
            $item->save();
            $assignResult['operacion'] = $item->id;
            $assignResult['gestor'] = $item->user_id;
            array_push($result, $assignResult);
        });


        return response()->json([
            'message' => $result,
            'code' => 204], 204);


    }

    private static function generateRandomUser (){

        $users = User::all();

        $minimumValue = $users->first()->id;
        $maximumValue = $users->last()->id;

        return rand($minimumValue, $maximumValue);
    }

}
