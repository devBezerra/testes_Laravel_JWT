<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct(Purchase $purchase) {
        $this->purchase = $purchase;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = $this->purchase->all();
        return $purchases;
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
        $rules = ['items_id' => 'required', 'providers_id' => 'required', 'amount' => 'required|min:1', 'unitaryValue' => 'required', 'totalValue' => 'required'];
        $this->validate($request, $rules);

        $purchase = $this->purchase->create($request->all());
        return $purchase;
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = $this->purchase->find($id);

        if ($purchase == null) {
            return ['error' => 'Fornecedor pesquisado não existe'];
        }
        return $purchase;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = ['name' => 'min:3', 'cnpj' => 'min:18|max:18'];
        $this->validate($request, $rules);

        $purchase = $this->purchase->find($id);
        if ($purchase == null) {
            return ['error' => 'Fornecedor não pode ser atualizado'];
        }

        $purchase->update($request->all());
        return $purchase;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = $this->purchase->find($id);
        if ($purchase == null) {
            return ['error' => 'Funcionário não pode ser deletado'];
        }
        $purchase->delete();
        return ['msg' => 'Deletado com sucesso'];
    }
}
