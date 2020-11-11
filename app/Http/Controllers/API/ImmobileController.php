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
        foreach($immobile as $key => $value)
        {
            $value->contract;
        }
        return \App\Helpers\Responses::success($immobile->toArray());
    }
    

    /**
     * Get a immobile by id if the contract don't exists.
     * 
     * @param int $id
     * @return Immobile
     */
    public function getImmobileToContract($id) 
    {

        $immobile = \App\Immobile::find($id);
        
        if (!$immobile || $immobile->active == false) {
            return \App\Helpers\Responses::notFound([
                'message' => 'Immobile don\'t exists.'
            ]);
        }
        
        if ($immobile->solded == true) {
            return \App\Helpers\Responses::conflict([
                'message' => '
                This property is already in current contract.'
            ]);
        }

        return \App\Helpers\Responses::success($immobile);
        
    }

    /**
     * Check if the new immobile don't exist in base.
     * 
     * @param $state string
     * @param $city string
     * @param $neighborhood string
     * @param $address string
     * @param $number numeric
     */
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

    /**
     * Get emails saved in table immobiles.
     * 
     * @return Array $emails
     */
    public function getAllEmailsFromImmobiles() 
    {
        $emails = \App\Immobile::select('email')->where(['active' => true])->distinct()->get();
        return \App\Helpers\Responses::success($emails->toArray());
    }

    /**
     * Get all states saved in table immobiles using email
     * 
     * @param Request $email
     * @return Array $states
     */
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

    /**
     * Get all neighborhood saved in table immobiles using email and state
     * 
     * @param Request $email
     * @param Request $state
     * @return Array $neighborhoods
     */
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

    /**
     * Get all Immobiles saved in table using email, states and neighborhood
     * 
     * @param Request $email
     * @param Request $state
     * @param Request $neighborhood
     * @return Array Immobiles
     */
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
