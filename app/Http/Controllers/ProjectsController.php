<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Projects::all();

        return response()->json([
            'status' => 200,
            'message' => 'Projects readed succesfully',
            'projects' => $projects
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
            'img'=> 'required',
            'title' => 'required',
            'description' => ' required',
            'sort' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'field empty'
            ]);
        }

        $project = new Projects;
        $project->img = $request->img;
        $project->skills = $request->skills;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->urlRepository = $request->urlRepository;
        $project->urlWebsite = $request->urlWebsite;
        $project->visible = $request->visible;
        $project->sort = $request->sort;
        $project->save();

        return response()->json([
            'status' => 200,
            'message' => 'Project created succesfully'
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
            'img'=> 'required',
            'title' => 'required',
            'description' => ' required',
            'urlRepository' => 'required',
            'urlWebsite' => 'required',
            'visible' => 'required|boolean',
            'sort' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'field empty'
            ]);
        }

        $project = Projects::where('id', $id)->first();

        $project->img = $request->img;
        $project->skills = $request->skills;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->urlRepository = $request->urlRepository;
        $project->urlWebsite = $request->urlWebsite;
        $project->visible = $request->visible;
        $project->sort = $request->sort;

        $project->save();

        return response()->json([
            'status' => 200,
            'message' => 'Project updated succesfully',
            'project_update' => $project
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
        $project = Projects::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Project deleted succesfully'
        ]);
    }
}
