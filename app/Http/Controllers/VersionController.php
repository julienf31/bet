<?php

namespace App\Http\Controllers;

use App\Version;
use Carbon\Carbon;
use Validator;
use Toastr;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $versions = Version::all();

        return view('versions.index', compact('versions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('versions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $version = $request->get('version');
        $title = $request->get('title');
        $description = $request->get('description');
        $date = $request->get('date');
        $type = $request->get('type');

        $validator = Validator::make($request->all(),array(
            'version'             => 'required',
            'title'             => 'required',
            'description'       => 'required',
            'date'              => 'required',
        ));

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $version = new Version();
            $version->version = $version;
            $version->title = $title;
            $version->description = $description;
            $version->published_at = Carbon::createFromFormat('d/m/Y',$date);
            $version->type = $type;
            $version->save();

            Toastr::success('Version ajoutée');
            return redirect(route('versions.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function edit(Version $version)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Version $version)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        //
    }
}
