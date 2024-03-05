<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = DB::table('sections')->get();
        $data = response()->json($section);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'section_name' => 'required|max:30',
        ]);

        $data = array();
        $data['class_id'] = $request->class_id;
        $data['section_name'] = $request->section_name;
        DB::table('sections')->insert($data);
        return response('done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = DB::table('sections')->where('id', $id)->first();
        return response()->json($show);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'section_name' => 'required|max:30',
        ]);

        $data = array();
        $data['class_id'] = $request->class_id;
        $data['section_name'] = $request->section_name;
        DB::table('sections')->where('id', $id)->update($data);
        return response('Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('sections')->where('id', $id)->delete();
        return response('deleted');
    }
}
