<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PDF;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'name' => 'required|string',
            'immobile_id' => 'required|numeric',
            'document' => 'required|cpf_cnpj',
            'personType' => 'required|min:1|max:2|numeric'
        ]);

        if($validate->fails()) {
            return \App\Helpers\Responses::conflict($validate->errors());
        }

        $checkImmobileHaveAContract = \App\Contract::where(['immobile_id' => $request->input('immobile_id')])->get();
        if(sizeof($checkImmobileHaveAContract) > 0) {
            return \App\Helpers\Responses::conflict(['message' => 'This immobile have a contract!']);
        }

        $immobile = \App\Immobile::find($request->input('immobile_id'));
        $contract = new \App\Contract();
        $contract->email = $request->input('email');
        $contract->name = $request->input('name');
        $contract->city = $immobile->city;
        $contract->immobile_id = $request->input('immobile_id');
        $contract->address = $immobile->address;
        $contract->neighborhood = $immobile->neighborhood;
        $contract->number = $immobile->number;
        $contract->document = $request->input('document');
        $contract->personType = $request->input('personType');
        $contract->complement = $immobile->complement;
        $immobile->update(["solded" => true]);
        $contract->save();

        return \App\Helpers\Responses::created($contract);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = \App\Contract::find($id);
        $contract->immobile;
        $data = [
            'title' => 'Contrato de Alocação de imóvel.',
            'contract' => $contract
        ];
        view()->share('pdf', $data);
        $pdf = PDF::loadView('contract', $data);
        return $pdf->stream('contract-'. $contract->document .'.pdf');
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
