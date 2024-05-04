<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\V1\StorePostRequest as V1StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostsApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

// use Illuminate\Validation\Validator;


class PostController extends Controller
{
    use TraitApiSends;
    public function index()
    {
        try {
            $post = PostsApi::collection(Post::all());

            return $this->Sends($post, 200);

        } catch (\Exception $e) {
            return response('The specified resource does not exist', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            // Laravel automatically applies validation rules from StorePostRequest here
            //  $validatedData = $request->validated();  This retrieves the validated data

            $post = Post::create([
                'title' => $request['title'],
                'body' => $request['body'] // Adjust 'body' to match your request field name
            ]);

            return response()->json(['post' => $post, 'message' => 'Data saved successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $post = new PostsApi(Post::findOrFail($id));

            return $this->Sends($post, 200);
        } catch (\Exception $e) {
            return response('The specified resource does not exist', 404);
        }

    }

    public function update($id, Request $request)
    {
        try {
            $post = Post::findOrFail($id);
            $post->update($request->all());
            return response()->json(['post' => $post, 'message' => 'Data Updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            // $post->delete();
            Post::destroy($id);
            return response()->json(['message' => 'Data has been deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
