<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\UserInfo;
use App\Model\UserRank;
use App\Model\UserComments;
use Illuminate\Http\Request;

/**
 * Class CommentsController
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        UserComments::create([
            'user_id'     => $request->get('user_id'),
            'commented_id'    => \Auth::user()->id,
            'comment' => $request->get('comment')
        ]);

        return redirect('/profile/'.$request->get('user_id'));
    }
}
