<?php

namespace App\Http\Controllers;

use App\Models\Skills as ModelsSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = ModelsSkills::all();

        return response()->json([
            'status' => 200,
            'message' => 'Projects readed succesfully',
            'skills' => $skills
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
            'name' => 'required',
            'sort' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'field empty'
            ]);
        }

        $skills = new ModelsSkills;
        $skills->name = $request->name;
        $skills->color = $request->color ? $request->color : '';
        $skills->sort = $request->sort;
        $skills->save();

        return response()->json([
            'status' => 200,
            'message' => 'Skill created succesfully'
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
            'name' => 'required',
            'sort' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'field empty'
            ]);
        }

        $skill = ModelsSkills::where('id', $id)->first();;
        $skill->name = $request->name;
        $skill->color = $request->color ? $request->color : '';
        $skill->sort = $request->sort;
        $skill->save();

        return response()->json([
            'status' => 200,
            'message' => 'Skill updated succesfully',
            'skill_update' => $skill
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
        $skills = ModelsSkills::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Skill deleted succesfully'
        ]);
    }
}
