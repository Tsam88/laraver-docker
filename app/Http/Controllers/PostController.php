<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::all();

        return view('post.index', compact('data'));
    }

    public function restApiGetPosts()
    {
        try {
            $data = Post::all();
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get all posts"
        ], 200);
    }

    public function restApiGetPost($id)
    {
        try {
            $data = Post::findOrFail($id);
        } catch (\Throwable $e) {
            return response()->json([
                "data" => [],
                "message" => $e->getMessage()
            ], 400);
        }

        return response()->json([
            "data" => $data,
            "message" => "Success: Get post"
        ], 200);
    }
}
