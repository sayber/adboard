<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Model\UserComments;
use App\Model\UserInfo;
use App\Model\UserRank;
use App\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userRegForm()
    {
        return view('users.create');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userLogForm()
    {
        return view('users.loginform');
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        User::create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        return redirect('login')->with('flash_notification.message', 'user registration successfully')->with('flash_notification.level', 'success');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userProfile(User $user)
    {
        $ratingAmount = 0;
        $rank         = null;
        foreach (UserRank::where('user_id', $user->id)->get() as $item) {
            $ratingAmount += $item['amount'];
            if ($user->id == $item['user_id'] && \Auth::user()->id == $item['ranked_id']) {
                $rank = $item;
            }
        }

        $comments = UserComments::with('user')->where('user_id', $user->id)->get();

        return view('users.profile_update', compact(['user', 'rank', 'ratingAmount', 'comments']));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rating(Request $request): \Illuminate\Http\RedirectResponse
    {
        //@todo проверка нужна
        $ranked_id = \Auth::user()->id;
        UserRank::create([
            'user_id'   => $request->get('user_id'),
            'ranked_id' => $ranked_id,
            'amount'    => $request->get('amount')
        ]);

        return redirect('/profile/' . $request->get('user_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userUpdated(Request $request): \Illuminate\Http\RedirectResponse
    {

        $this->validate($request, [
            'name'     => 'required|',
            'email'    => 'required|email',
            'password' => 'confirmed'
        ]);

        // Getting users id
        $user = User::with('info')->find($request->id);

        $user->name  = $request->get('name');
        $user->email = $request->get('email');

        if ($request->get('password') !== '') {
            $user->password = bcrypt($request->get('password'));
        }

        if (!$user['info']) {
            $this->setUserInfo($request);
        } else {
            $user->info()->update([
                'firstname'  => $request->get('firstname'),
                'secondname' => $request->get('secondname'),
                'lastname'   => $request->get('lastname'),
                'phone'      => $request->get('phone')
            ]);
        }

        // Updating this user
        $user->update();

        return redirect('/')
            ->with('flash_notification.message', 'Profile updated successfully')
            ->with('flash_notification.level', 'success');

    }

    /**
     * @param Request $request
     */
    protected function setUserInfo(Request $request)
    {
        $userId = \Auth::user()->id;

        UserInfo::create([
            'user_id'    => $userId,
            'firstname'  => $request->get('firstname'),
            'secondname' => $request->get('secondname'),
            'lastname'   => $request->get('lasstname'),
            'phone'      => $request->get('phone')
        ]);
    }


}
