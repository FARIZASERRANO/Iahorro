<?php

namespace App\Http\Controllers;

use App\models\Operations;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Models\Clients;
use App\Http\Requests\NewOperationRequests;


class NewOperations extends Controller
{

    public function store (NewOperationRequests $request){

        $newClientAtribute = $request->json()->all();
        $newIdClient = $this->saveNewClient($newClientAtribute);

        if(isset($newIdClient->id)){
            return response()->json([
                'message' => 'Created',
                'code' => 201], 201);
        }else {
            if (isset($newOperation->id)) {
                return response()->json([
                    'message' => 'Something has gone wrong, please contact IAhorro Customer Service.',
                    'code' => 500], 500);
            }

        }
    }

    private function saveNewClient($newClientAtribute){
        try{

            $newIdClient = Clients::create($newClientAtribute);

            return $newIdClient;

        }catch(\Exception $ex){

            $this->errorCheckerOnDatebaseInsertion($ex->getCode());

        }
    }


    private function errorCheckerOnDatebaseInsertion($errorCode) {

        $response = '';


        if($errorCode == 23000){

            $response = response()->json([
                'code' => 409,
                'message' => 'Integrity constraint violation',
            ], 409);

        }else{

            $response = response()->json([
                'code' => 500,
                'message' => 'Server error. Code error '.$errorCode.'.' ,
            ], 500);

        }

        throw new HttpResponseException($response);

    }

}
