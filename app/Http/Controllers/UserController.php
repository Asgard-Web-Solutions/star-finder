<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Alert;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view-acp-users')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $users = User::all();

        return view('acp.user.index', [
            'users' => $users,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        if (!$id)
        {
            $id = Auth::id();
        }

        if (Gate::denies('view-profile', $id)) {
            Alert::toast('Permission Denied', 'warning');
            return redirect()->route('user');
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('all-users');
        }

        return view('acp.user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('edit-profile', $id)) {
            Alert::toast('Permission Denied', 'warning');
            return redirect()->route('user');
        }

        $user = User::find($id);

        $roles = Role::all();
        $availableRoles = array();

        foreach ($roles as $role)
        {
            if (!$user->roles->contains($role))
            {
                $availableRoles[] = $role;
            }
        }

        return view('acp.user.edit', [
            'user' => $user,
            'roles' => $availableRoles,
        ]);
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
        if (Gate::denies('edit-profile', $id)) {
            Alert::toast('Permission Denied', 'warning');
            return redirect()->route('user');
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Alert::toast('User Updated', 'success');

        return redirect()->route('all-users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addRole(Request $request, $id)
    {
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect()->route('user');
        }

        $user = User::find($id);

        if (!$user->count()) {
            Alert::toast('User Not Found', 'error');
            return redirect()->route('acp');
        }

        $this->validate($request, [
            'role' => 'required|integer|exists:roles,id|max:15',
        ]);

        $role = Role::find($request->role);

        if ($user->roles->contains($role)) {
            Alert::toast('User Already Has Role ' . $role->name, 'error');
            return redirect()->route('user', $user->id);
        }

        $user->roles()->attach($role);

        Alert::toast('User Added to ' . $role->name, 'success');
        return redirect()->route('user', $user->id);
    }

    public function removeRole($user_id, $role_id)
    {
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect()->route('user');
        }

        $user = User::find($user_id);

        if (!$user->count()) {
            Alert::toast('User Not Found', 'error');
            return redirect()->route('acp');
        }

        $role = Role::find($role_id);
        if (!$role->count()) {
            Alert::toast('Invalid Role', 'error');
            return redirect()->route('acp');
        }

        if (!$user->roles->contains($role)) {
            Alert::toast('User Is Not In Role ' . $role->name, 'error');
            return redirect()->route('user', $user->id);
        }

        $user->roles()->detach($role);

        Alert::toast('User Removed from ' . $role->name, 'info');
        return redirect()->route('user', $user->id);
    }
}
