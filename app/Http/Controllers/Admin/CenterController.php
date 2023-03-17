<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCenterRequest;
use App\Models\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Center::all();
        return view('admin.centers.index', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.centers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCenterRequest $request)
    {
        $validated = $request->validated();

        $center = new Center($validated);

        $saved = $center->save();

        if($saved) return 1;

        return response('Center couldn\'t be created!', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center = Center::findOrFail($id);
        return view('admin.centers.edit', compact('center'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCenterRequest $request, Center $center)
    {
        $validated = $request->validated();

        $center->fill($validated);

        $saved = $center->update();

        if($saved) return 1;

        return response('Center Data Couldn\'t be Updated!', 500);
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

    public function updateVial(Center $center)
    {
        return view('admin.centers.update-vial', compact('center'));
    }

    public function updateVialStore(Request $request, Center $center)
    {

        $isUpdated = $center->update(['daily_limit' => $request->input('new_count')]);
        
        if($isUpdated) return 1;
        
        return response('Updating Failed!', 500);
    }
}
