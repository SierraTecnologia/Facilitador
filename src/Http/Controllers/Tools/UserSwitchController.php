
<?php

namespace Facilitador\Http\Controllers\Tools;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSwitchController extends Controller
{

    /**
     * UserSwitchController constructor.
     *
     * Don't call parent constructor,
     * protect controller by requiring developer role or session saying user has been switched
     */
    public function __construct()
    {
        $this->middleware('is_developer_or_switched');
    }


    /**
     * Logs in to the application as a specified user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */    public function switchUser(Request $request){
        $request->session()->put('existing_user_id', Auth::user()->id);
        $request->session()->put('user_is_switched', true);

        $newuserId = $request->input('new_user_id');
        Auth::loginUsingId($newuserId);
        return redirect()->to('/');
    }

    /**
     * Restores current login to the original user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */    public function restoreUser(Request $request) {
        $oldUserId = $request->session()->get('existing_user_id');
        Auth::loginUsingId($oldUserId);
        $request->session()->forget('existing_user_id');
        $request->session()->forget('user_is_switched');
        return redirect()->back();
    }

}
