<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {  
         if (auth()->check()) {
        $posts = Post::all();
        return response()->json([
            'posts' => count($posts),
            'data' => $posts,
            'status' => true
        ]);
    }else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    
}

    public function show($id)
    {
        $post = Post::find($id);
        if ($post != null) {
            return response()->json([
                'message' => 'Record found',
                'data' => $post,
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
                'data' => [],
                'status' => true
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are some errors',
                'errors' => $validator->errors(),
                'status' => false
            ], 200);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return response()->json([
            'message' => 'Post added successfully',
            'post' => $post,
            'status' => true
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return response()->json([
                'message' => 'Post not found',
                'status' => false
            ], 200);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are some errors',
                'errors' => $validator->errors(),
                'status' => false
            ], 200);
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
    
        return response()->json([
            'message' => 'Updated successfully',
            'data' => $post,
            'status' => true
        ], 200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return response()->json([
                'message' => 'Post not found',
                'status' => false
            ], 200);
        }

        $post->delete();

        return response()->json([
            'message' => 'Deleted successfully',
            'status' => true
        ], 200);
    }
}
