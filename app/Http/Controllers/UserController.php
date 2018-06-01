<?php

namespace App\Http\Controllers;

use App\Common;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::select('id', 'has_deleted', 'created_at', 'updated_at', 'email', 'name', 'is_miami', 'role_id')
			->get();

		$userRoles = [];
		foreach(Role::get()->toArray() as $role) {
			$userRoles[$role['id']] = $role['name'];
		}
		return view('user.index', ['users' => $users, 'userRoles' => $userRoles]);
    }

    /**
     * Display a page for administrator to create user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRoles = [];
        foreach(Role::get()->toArray() as $role) {
            $userRoles[$role['id']] = $role['name'];
        }
        return view('user.create', ['userRoles' => $userRoles]);
    }

    /**
     * Store a newly created user in users table.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput(['email' => $data['email'], 'role_id' => $data['role_id']])->withErrors(['email' => 'invalid email']);
        }

        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'name' => $data['name']
        ]);
        return redirect(route('user.index'));
    }

    /**
     * Restore deleted user
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        User::findOrFail($id)->update(["has_deleted" => 0]);
        return redirect(route('user.index'));
    }

	/**
	 * Show the form for editing user profile.
	 *
     * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
	    if(Auth::user()->role_id != 1 && Auth::user()->id != $id) {
	        return redirect(route('home.index'));
        }
        $userRoles = [];
        foreach(Role::get()->toArray() as $role) {
            $userRoles[$role['id']] = $role['name'];
        }
	    $user = User::findOrFail($id);
		return view('user.edit', ['user' => $user, 'userRoles' => $userRoles]);
	}

	/**
	 * Update the user profile.
     *
     * @param int $id
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
        if(Auth::user()->role_id != 1 && Auth::user()->id != $id) {
            return redirect(route('home.index'));
        }

		$data = $request->all();

        if(Auth::user()->role_id != 1 && isset($data['role_id'])) {
            return redirect(route('home.index'));
        }

        $user = User::findOrFail($id);
		$user->update(['name' => $data['name']]);

		if(Auth::user()->role_id == 1) {
		    if(!$data['password']) {
                $user->update(['role_id' => $data['role_id']]);
            } else {
                $user->update(['password' => Hash::make($data['password']), 'role_id' => $data['role_id']]);
            }
            return redirect(route('user.index'));
        } elseif($data['oldPassword'] != '') {
		    if($data['password'] == '') {
                return redirect()->back()
                    ->with('password', 'new password cannot be empty');
            }
		    if(Hash::check($data['oldPassword'], $user->password)) {
                $user->update(['password' => Hash::make($data['password'])]);
            } else {
                return redirect()->back()
                    ->with('oldPassword', 'old password is incorrect');
            }
        }

		return redirect(route('home.index'));
	}


    /**
     * Update role for specified user
     *
     * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, $id)
    {
		$data = $request->all();

		User::find($id)
			->update(['role_id' => $data['role_id']]);

		return redirect(route('user.index'));
    }

	/**
	 * Remove the specified user from users table.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		User::findOrFail($id)->update(['has_deleted' => 1]);
		return redirect(route('user.index'));
	}
}
