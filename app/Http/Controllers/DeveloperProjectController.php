<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperProjectController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Developer::all();

        return view('developerProject.index', compact('data'));
    }

    public function restApiGetDevelopersProjects()
    {
        try {
            $data = Developer::with('projects')->get();
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get all developer-project relationships"
        ], 200);
    }

    public function restApiGetProjectDevelopers($projectId)
    {
        try {
            $data = Project::find($projectId)->developers()->orderBy('name')->get();
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get the developers of the project"
        ], 200);
    }

    public function restApiGetDeveloperProjects($developerId)
    {
        try {
            $data = Developer::find($developerId)->projects()->with('developers')->orderBy('title')->get();
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get the projects of the developer"
        ], 200);
    }

    public function restApiGetDeveloperProjectRelationships()
    {
        try {
            // $results = Developer::all();
            $results = Developer::with('projects')->get();
            $data    = [];

            foreach ($results as $developer) {
                foreach ($developer->projects as $project) {
                    $data[] = $project->pivot;
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get developer-project relationships"
        ], 200);
    }

    public function restApiGetDeveloperProjectRelationship($developerId, $projectId)
    {
        try {
            // $data = Developer::findOrFail($developerId)->projects()->where('project_id', $projectId)->with('developers')->get()->makeHidden('pivot');

            $data = Developer::findOrFail($developerId)->projects()->where('developer_id', $developerId)
            ->where('project_id', $projectId)->first()->pivot;
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get developer-project relationship"
        ], 200);
    }
}
