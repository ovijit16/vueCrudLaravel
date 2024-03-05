<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = DB::table('students')->get();
        $data = response()->json($student);
        return $data;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'name' => 'required|max:35',
            'gender' => 'required|max:20',
            'phone' => 'required|unique:students|max:20',
            'password' => 'required|min:8',
            'email' => 'unique:students|max:50',
            'photo' => '',
            'address' => 'max:150',
        ]);

        if (!$validatedData) {
            return response()->json([
                'status' => 422,
                'errors' => 'Field Requirement does not match.',
            ], 422);
        } else {



            $data = array();
            $data['class_id'] = $request->class_id;
            $data['section_id'] = $request->section_id;
            $data['name'] = $request->name;
            $data['gender'] = $request->gender;
            $data['phone'] = $request->phone;
            $data['password'] = Hash::make($request->password);
            $data['email'] = $request->email;
            $data['photo'] = $request->photo;
            $data['address'] = $request->address;
            $students = DB::table('students')->insert($data);

            if ($students) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Students Added Successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong',
                ], 500);
            }

            // return response('done');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = DB::table('students')->where('id', $id)->first();
        if (!$show) {
            return response()->json([
                'status' => 404,
                'message' => 'No Student ID Found',
            ], 404);
        } else {
            return response()->json($show);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $validatedData = $request->validate([
        //     'class_id' => 'required',
        //     'section_id' => 'required',
        //     'name' => 'required|max:35',
        //     'gender' => 'required|max:20',
        //     'phone' => 'required|unique:students|max:20',
        //     'password' => 'required|max:20',
        //     'email' => 'unique:students|max:50',
        //     'photo' => '',
        //     'address' => 'max:150',
        // ]);

        $find = DB::table('students')->where('id', $id)->first();
        if (!$find) {
            return response()->json([
                'status' => 404,
                'message' => 'No Student ID Found',
            ], 404);
        } else {
            $data = array();
            $data['class_id'] = $request->class_id;
            $data['section_id'] = $request->section_id;
            $data['name'] = $request->name;
            $data['gender'] = $request->gender;
            $data['phone'] = $request->phone;
            $data['password'] = Hash::make($request->password);
            $data['email'] = $request->email;
            $data['photo'] = $request->photo;
            $data['address'] = $request->address;
            DB::table('students')->where('id', $id)->update($data);

            return response()->json([
                'status' => 200,
                'message' => 'Student info Updated Successfully',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $find = DB::table('students')->where('id', $id)->first();
        if (!$find) {
            return response()->json([
                'status' => 404,
                'message' => 'No Student ID Found',
            ], 404);
        } else {
            $img_path = $find->photo;
            if ($img_path != '') {
                unlink($img_path);
            }

            DB::table('students')->where('id', $id)->delete();
            // return response('deleted');
            return response()->json([
                'status' => 200,
                'message' => 'Student info Deleted Successfully',
            ], 200);
        }
    }
}
