<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ImmobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $immobile = \App\Immobile::where('active', true)->get();
        return \App\Helpers\Responses::success($immobile->toArray());
    }

    public function getImmobile(Request $request) 
    {

    }


    private function checkIfImmobileExists($state, $city, $neighborhood, $address, $number) 
    {

        $checkImmobileExists = \App\Immobile::where(['state' => $state, "city" => $city, "neighborhood" => $neighborhood, "address" => $address, "number" => $number])->get();
        return $checkImmobileExists;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'CEP' => 'nullable|min:8|max:9',
            'state' => 'required|min:2|max:2|string',
            'address' => 'required|string',
            'number' => 'required|string',
            'city' => 'required|string',
            'complement' => 'nullable|string',
            'neighborhood' => 'required|string'
        ]);

        if($validate->fails()) {
            return \App\Helpers\Responses::conflict($validate->errors());
        }


        $immobileCheckInDb = $this->checkIfImmobileExists($request->input('state'), $request->input('city'), $request->input('neighborhood'), $request->input('address'), $request->input('number'));
        if(sizeOf($immobileCheckInDb) > 0) {
            return \App\Helpers\Responses::conflict(['message' => 'Imóvel já cadastrado!']);
        }
                
        $immobile = new \App\Immobile();
        $immobile->email = $request->input('email');
        $immobile->CEP = $request->input('CEP');
        $immobile->state = $request->input('state');
        $immobile->address = $request->input('address');
        $immobile->number = $request->input('number');
        $immobile->city = $request->input('city');
        $immobile->complement = $request->input('complement');
        $immobile->neighborhood = $request->input('neighborhood');
        $immobile->save();
        return \App\Helpers\Responses::created($immobile);
        
    }

    public function getAllEmailsFromImmobiles() 
    {
        $emails = \App\Immobile::select('email')->where(['active' => true])->distinct()->get();
        return \App\Helpers\Responses::success($emails->toArray());
    }

    public function getAllStatesFromImmobilesByEmail(Request $request) 
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns'
        ]);

        if($validate->fails()) {
            return \App\Helpers\Responses::conflict($validate->errors());
        }

        $states = \App\Immobile::select('state')->where(['email' => $request->input('email'), 'active' => true])->distinct()->get();
        return \App\Helpers\Responses::success($states->toArray());
    }

    public function getAllNeighborhoodFromImmobilesByEmailAndState(Request $request) 
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'state' => 'required|min:2|max:2|string'
        ]);

        if($validate->fails()) {
            return \App\Helpers\Responses::conflict($validate->errors());
        }

        $neighborhood = \App\Immobile::select('neighborhood')->where(['email' => $request->input('email'), 'state' => $request->input('state'),'active' => true])->distinct()->get();
        return \App\Helpers\Responses::success($neighborhood->toArray());
    }

    public function getAllImmoblilesByEmailAndStateAndNeighborhood(Request $request) 
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'state' => 'required|min:2|max:2|string',
            'neighborhood' => 'required|string'
        ]);

        if($validate->fails()) {
            return \App\Helpers\Responses::conflict($validate->errors());
        }

        $immobiles = \App\Immobile::where(['email' => $request->input('email'), 'state' => $request->input('state'),'active' => true, 'neighborhood' => $request->input('neighborhood')])->get();
        return \App\Helpers\Responses::success($immobiles->toArray());
    }

    /**
     * Disabled the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disabled($id)
    {
        $disabled = \App\Immobile::find($id)->update(['active' => false]);
        if ($disabled) {
            return \App\Helpers\Responses::success(["message" => 'Immobile deleted.']);
        }
        
    }
}
