<?php

namespace App\Http\Controllers;
use Gate;
use Alert;
use App\StarType;
use Illuminate\Http\Request;

class StarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $stars = StarType::all();

        return view('star-type.index', [
            'stars' => $stars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        return view('star-type.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $this->validate($request, [
            'type' => 'required|string|max:32',
            'diameter' => 'required|integer|max:32000',
            'color' => 'required|string|max:20',
            'probability' => 'required|integer|max:100',
        ]);

        $star = new StarType();

        $star->type = $request->type;
        $star->diameter = $request->diameter;
        $star->color = $request->color;
        $star->probability = $request->probability;

        $star->save();

        Alert::toast('New Star Type Added', 'success');

        return redirect()->route('all-star-types');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $star = StarType::find($id);

        if (!$id) {
            Alert::toast('Star Not Found', 'error');
            return redirect()->route('all-star-types');
        }

        return view('star-type.show', [
            'star' => $star,
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
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $startype = StarType::find($id);

        if (!$startype) {
            Alert::toast('Star Not Found', 'error');
            return redirect()->route('all-star-types');
        }

        return view('star-type.edit', [
            'star' => $startype,
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
        if (Gate::denies('manage-game-elements')) {
            Alert::toast('Permission Denied', 'warning');
            return redirect('/');
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'diameter' => 'integer|max:32000',
            'color' => 'string|max:20',
            'probability' => 'integer|max:100',
        ]);

        $star = StarType::find($id);

        if (!$star) {
            Alert::toast('Star Not Found', 'warning');
            return redirect()->rout('acp-star-types');
        }

        $star->type = $request->name;
        $star->diameter = $request->diameter;
        $star->color = $request->color;
        $star->probability = $request->probability;
        $star->save();

        Alert::toast('star type Updated', 'success');

        return redirect()->route('all-star-types');
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
