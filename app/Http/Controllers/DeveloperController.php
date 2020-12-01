<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Developer::all();

        return view('developer.index', compact('data'));
    }

    public function restApiGetDevelopers()
    {
        try {
            $data = Developer::all();
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get all developers"
        ], 200);
    }

    public function restApiGetDeveloper($id)
    {
        try {
            $data = Developer::findOrFail($id);
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get developer"
        ], 200);
    }
}
