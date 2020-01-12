<?php

namespace App\Http\Controllers;

use Alert;
use Gate;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $roles = Role::all();

        return view('acp.role.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        return view('acp.role.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $this->validate($request, [
            'name' => 'required|alpha_dash|max:24',
            'color_class' => 'required|alpha_dash|max:24',
        ]);

        $role = new Role();

        $role->name = $request->name;
        $role->color_class = $request->color_class;
        $role->save();

        Alert::toast('Role Created', 'success');

        return redirect()->route('all-roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $role = Role::find($id);

        return view('acp.role.show', [
            'role' => $role,
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
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $role = Role::find($id);

        return view('acp.role.edit', [
            'role' => $role,
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
        if (Gate::denies('manage-roles')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $this->validate($request, [
            'name' => 'required|alpha_dash|max:24',
            'color_class' => 'required|alpha_dash|max:24',
        ]);

        $role = Role::find($id);

        $role->name = $request->name;
        $role->color_class = $request->color_class;

        $role->save();

        return redirect()->route('all-roles');
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
}
