<?php

namespace SierraTecnologia\Facilitador\Http\Controllers\Universal;

use Illuminate\Http\Request;
use SierraTecnologia\Facilitador\Services\FacilitadorService;
use Siravel\Models\Components\Code\Commit;
use SierraTecnologia\Facilitador\Services\RegisterService;
use SierraTecnologia\Facilitador\Services\RepositoryService;

class RegisterController extends Controller
{
    protected $registerService;

    public function __construct(FacilitadorService $facilitadorService, RepositoryService $repositoryService, RegisterService $registerService)
    {
        $this->registerService = $registerService;
        parent::__construct($facilitadorService, $repositoryService);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $register = $this->registerService->find();

        return view(
            'facilitador::registers.index',
            compact('register')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $register = $this->registerService->find();

        return view(
            'facilitador::registers.edit',
            compact('register')
        );
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
        $request->validate([
            'commit_name'=>'required',
            'commit_price'=> 'required|integer',
            'commit_qty' => 'required|integer'
        ]);

        $commit = Commit::findOrFail($id);
        $commit->commit_name = $request->get('commit_name');
        $commit->commit_price = $request->get('commit_price');
        $commit->commit_qty = $request->get('commit_qty');
        $commit->save();

        return redirect($this->repositoryService->getRouteIndex())->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commit = Commit::findOrFail($id);
        $commit->delete();

        return redirect($this->repositoryService->getRouteIndex())->with('success', 'Stock has been deleted Successfully');
    }
}