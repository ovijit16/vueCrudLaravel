<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Subject::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'subject_name' => 'required|unique:subjects|max:25',
            'subject_code' => 'required|unique:subjects|max:25',
        ]);

        $subjects = Subject::create($request->all());
        return response()->json('inserted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sub = Subject::findorfail($id);
        return response()->json($sub);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'subject_name' => 'required|unique:subjects|max:25',
            'subject_code' => 'required|unique:subjects|max:25',
        ]);

        $subject = Subject::findorfail($id);
        $subject->update($request->all());
        return response(('updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::where('id', $id)->delete();
        return response('delete done');
    }
}
