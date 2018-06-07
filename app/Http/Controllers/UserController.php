<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateUserProfile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const USERS_LIST_PAGINATE = 2;

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(self::USERS_LIST_PAGINATE);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->id != $user->id) {
            return abort(403, 'You do not have access to update this profile');
        }
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserProfile $updateUserProfile
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfile $updateUserProfile, User $user)
    {
        try {
            $user->name = $updateUserProfile->get('name', $user->name);
            $user->email = $updateUserProfile->get('email', $user->email);
            if($password = $updateUserProfile->get('password')) {
                $user->password =  Hash::make($password);
            }
            $user->save();
        } catch (\Exception $exception) {
            return abort(500, 'Server error');
        }
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            if(Auth::user()->hasRole(User::ADMIN_ROLE)) {
                $user->delete();
            } else {
                return abort(403, 'You don`t have permissions');
            }
        } catch (\Exception $exception) {
            return abort(500, 'Server error');
        }
        return redirect()->route('users.index');
    }
}
