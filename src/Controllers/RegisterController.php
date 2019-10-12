<?php

namespace SierraTecnologia\Facilitador\Controllers;

use Illuminate\Http\Request;
use Siravel\Models\Components\Code\Commit;
use SierraTecnologia\Facilitador\Services\RegisterService;

class Registerontroller extends Controller
{
    protected $service;

    public function __construct(RegisterService $registerService)
    {
        $this->service = $registerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commits = Commit::orderBy('id', 'DESC')->get();

        return view('commits.index', compact('commits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'commit_name'=>'required',
        'commit_price'=> 'required|integer',
        'commit_qty' => 'required|integer'
      ]);
      $commit = new Commit([
        'commit_name' => $request->get('commit_name'),
        'commit_price'=> $request->get('commit_price'),
        'commit_qty'=> $request->get('commit_qty')
      ]);
      $commit->save();
      return redirect('/commits')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commit = Commit::findOrFail($id);
        return view('commits.show', compact('commit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commit = Commit::findOrFail($id);

        return view('commits.edit', compact('commit'));
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

        return redirect('/commits')->with('success', 'Stock has been updated');
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

        return redirect('/commits')->with('success', 'Stock has been deleted Successfully');
    }
}