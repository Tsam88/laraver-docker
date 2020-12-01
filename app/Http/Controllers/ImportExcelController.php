<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use App\Imports\ProjectsImport;
use App\Imports\DevelopersImport;
use Illuminate\Support\Facades\Validator;
use App\Imports\DeveloperProjectRelationshipsImport;

class ImportExcelController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx,csv,txt',
            'type' => 'required|string|in:post,project,developer,developerProjectRelationships',
        ]);

        switch ($request->type) {
            case 'post':
                $import = new PostsImport;
                $route  = 'post.index';
                break;
            case 'project':
                $import = new ProjectsImport;
                $route  = 'project.index';
                break;
            case 'developer':
                $import = new DevelopersImport;
                $route  = 'developer.index';
                break;
            case 'developerProjectRelationships':
                $import = new DeveloperProjectRelationshipsImport;
                $route  = 'developer.project.index';
                break;
        }

        try {
            $import->import($request->file('file'));
        } catch (\Throwable $e) {
            return back()->with('error', "Error in mapping. {$e->getMessage()}");
        }

        if ($dbError = $import->dbErrors()) {
            return redirect()->route($route)->with('dbError', $dbError);
        }

        $validationErrors = $import->validationErrors();

        return redirect()->route($route)->with('success', 'Excel Data Imported successfully.')->with('validationErrors', $validationErrors);
    }

    public function restApiImport(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:xls,xlsx,csv,txt',
            'type' => 'required|string|in:post,project,developer,developerProjectRelationships',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 404);
        }

        switch ($request->type) {
            case 'post':
                $import = new PostsImport;
                break;
            case 'project':
                $import = new ProjectsImport;
                break;
            case 'developer':
                $import = new DevelopersImport;
                break;
            case 'developerProjectRelationships':
                $import = new DeveloperProjectRelationshipsImport;
                break;
        }

        //  Error in file mapping
        try {
            $import->import($request->file('file'));
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Error in file mapping. {$e->getMessage()}"
            ], 404);
        }

        //  DB Error
        if ($dbError = $import->dbErrors()) {
            return response()->json([
                "message" => "DB Error: {$dbError}"
            ], 404);
        }

        //  Validation Errors
        $validationErrors = $import->validationErrors();

        return response()->json([
            "errors"  => $validationErrors,
            "message" => "Excel Data Imported successfully."
        ], 200);
    }
}
