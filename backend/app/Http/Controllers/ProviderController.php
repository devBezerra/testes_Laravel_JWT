<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct(Provider $provider) {
        $this->provider = $provider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = $this->provider->all();
        return $providers;
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
        $rules = ['name' => 'required|min:3', 'cnpj' => 'required|min:18|max:18'];
        $this->validate($request, $rules);

        $provider = $this->provider->create($request->all());
        return $provider;
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = $this->provider->find($id);

        if ($provider == null) {
            return ['error' => 'Fornecedor pesquisado não existe'];
        }
        return $provider;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
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

        $provider = $this->provider->find($id);
        if ($provider == null) {
            return ['error' => 'Fornecedor não pode ser atualizado'];
        }

        $provider->update($request->all());
        return $provider;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = $this->provider->find($id);
        if ($provider == null) {
            return ['error' => 'Funcionário não pode ser deletado'];
        }
        $provider->delete();
        return ['msg' => 'Deletado com sucesso'];
    }
}
