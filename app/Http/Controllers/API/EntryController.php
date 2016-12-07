<?php

namespace App\Http\Controllers\API;

use App\Entries\Manager;
use App\Events\EntryCreationRequested;
use App\Events\EntryUpdateRequested;
use App\Events\EntryDeletionRequested;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  response()->json(['entries' => Manager::list()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string'
        ]);
        try{
            event(new EntryCreationRequested(
                     $request->input('last_name'),
                     $request->input('first_name'),
                     $request->input('phone')
            ));
            $id = Manager::findByValues(
                $request->input('last_name'),
                $request->input('first_name'),
                $request->input('phone')
            )->id;
            return response()->json(['saved' => true, 'id' => $id]);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return null;
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
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'id' => 'required|string'
        ]);
        try{
            $entry = Manager::find($id);
            event(new EntryUpdateRequested(
                  $entry,
                  $request->input('last_name'),
                  $request->input('first_name'),
                  $request->input('phone')
            ));
            $entry = Manager::find($id);
            return response()->json(['saved' => true, 'id' => $entry->id]);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $entry = Manager::find($id);
            event(new EntryDeletionRequested($entry));
            return response()->json(['deleted' => true, 'id' => $entry->id]);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
