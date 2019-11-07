<?php

namespace SierraTecnologia\Facilitador\Http\Controllers\Universal;

use Illuminate\Http\Request;
use SierraTecnologia\Facilitador\Services\FacilitadorService;
use SierraTecnologia\Facilitador\Services\RepositoryService;

class RepositoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = $this->repositoryService;
        $registros = $service->getTableData();

        return view(
            'facilitador::repositories.index',
            compact('service', 'registros')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTableJson()
    {
        return $this->repositoryService->getTableJson();
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index(Request $request)
    // {
    //     $teams = $this->repositoryService->paginated($request->user()->id);
    //     return view('team.index')->with('teams', $teams);
    // }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $registros = $this->repositoryService->search($request->user()->id, $request->search);

        return view(
            'facilitador::repositories.index',
            compact('registros')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TeamCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamCreateRequest $request)
    {
        try {
            $result = $this->repositoryService->create(Auth::id(), $request->except('_token'));

            if ($result) {
                return redirect('teams/'.$result->id.'/edit')->with('message', 'Successfully created');
            }

            return redirect('teams')->with('message', 'Failed to create');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified team.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByName($name)
    {
        $team = $this->repositoryService->findByName($name);

        if (Gate::allows('team-member', [$team, Auth::user()])) {
            return view('team.show')->with('team', $team);
        }

        return back();
    }

    // /**
    //  * Invite a team member
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function inviteMember(UserInviteRequest $request, $id)
    // {
    //     try {
    //         $result = $this->repositoryService->invite(Auth::user(), $id, $request->email);

    //         if ($result) {
    //             return back()->with('message', 'Successfully invited member');
    //         }

    //         return back()->with('message', 'Failed to invite member - they may already be a member');
    //     } catch (Exception $e) {
    //         return back()->withErrors($e->getMessage());
    //     }
    // }

    // /**
    //  * Remove a team member
    //  *
    //  * @param  int  $userId
    //  * @return \Illuminate\Http\Response
    //  */
    // public function removeMember($id, $userId)
    // {
    //     try {
    //         $result = $this->repositoryService->remove(Auth::user(), $id, $userId);

    //         if ($result) {
    //             return back()->with('message', 'Successfully removed member');
    //         }

    //         return back()->with('message', 'Failed to remove member');
    //     } catch (Exception $e) {
    //         return back()->withErrors($e->getMessage());
    //     }
    // }
}