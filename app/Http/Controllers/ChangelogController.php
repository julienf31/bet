<?php

namespace App\Http\Controllers;

use App\Changelog;
use App\Version;
use Illuminate\Http\Request;
use Toastr;

class ChangelogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $changelog = Changelog::all();
        $versions = Version::all();

        return view('changelog.index', compact('versions', 'changelog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($version_id = null)
    {
        if(isset($version_id)){
            $selected_version = Version::find($version_id);
        } else {
            $selected_version = Version::first();
        }

        $versions = Version::all();

        return view('changelog.create', compact( 'versions','selected_version'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $changelog = new Changelog($request->except('_token'));
        $changelog->save();

        Toastr::success('Fonctionalitée ajoutée avec succés','Ajout terminé');
        return redirect(route('changelog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function show(Changelog $changelog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function edit(Changelog $changelog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Changelog $changelog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Changelog $changelog)
    {
        //
    }
}
