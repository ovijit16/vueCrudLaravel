<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function index()
    {
        $class = DB::table('classes')->get();
        $data = response()->json($class);
        return $data;
        // return CourseClass::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_name' => 'required|unique:classes|max:255',
        ]);

        // CourseClass::create($request->all);
        $data = array();
        $data['class_name'] = $request->class_name;
        DB::table('classes')->insert($data);
        return response('done');
    }

    public function destroy($id)
    {
        DB::table('classes')->where('id', $id)->delete();
        return response('deleted');
    }


    public function show($id)
    {
        $show = DB::table('classes')->where('id', $id)->first();
        return response()->json($show);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['class_name'] = $request->class_name;
        DB::table('classes')->where('id', $id)->update($data);
        return response('Updated');
    }
}
