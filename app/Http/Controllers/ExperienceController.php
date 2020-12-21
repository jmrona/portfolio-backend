<?php

namespace App\Http\Controllers;

use App\Models\Experiences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Experiences::all();
        return response()->json([
            'status' => 200,
            'message' => 'Experience readed succesfully',
            'experiences' => $experiences
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=> 'required',
            'description' => 'required',
            'role' => ' required',
            'date' => 'required',
            'visible' => 'required|boolean',
            'sort' => 'required|numeric',
            'img' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'field empty'
            ]);
        }

        $experience = new Experiences;
        $experience->title = $request->title;
        $experience->description = $request->description;
        $experience->role = $request->role;
        $experience->date = $request->date;
        $experience->visible = $request->visible;
        $experience->sort = $request->sort;
        $experience->img = $request->img;
        $experience->save();

        return response()->json([
            'status' => 200,
            'message' => 'Experience created succesfully'
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
        $validator = Validator::make($request->all(),[
            'title'=> 'required',
            'description' => 'required',
            'role' => ' required',
            'date' => 'required',
            'visible' => 'required',
            'sort' => 'required|numeric',
            'img' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'field empty'
            ]);
        }

        $experience = Experiences::where('id', $id)->first();

        $experience->title = $request->title;
        $experience->description = $request->description;
        $experience->role = $request->role;
        $experience->date = $request->date;
        $experience->visible = $request->visible;
        $experience->sort = $request->sort;
        $experience->img = $request->img;

        $experience->save();

        return response()->json([
            'status' => 200,
            'message' => 'Experience updated succesfully',
            'experience_updated' => $experience
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $experience = Experiences::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Experience deleted succesfully'
        ]);
    }
}
