<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Project::all();

        return view('project.index', compact('data'));
    }

    public function restApiGetProjects()
    {
        try {
            $data = Project::all();
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get all projects"
        ], 200);
    }

    public function restApiGetProject($id)
    {
        try {
            $data = Project::findOrFail($id);
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get project"
        ], 200);
    }
}
