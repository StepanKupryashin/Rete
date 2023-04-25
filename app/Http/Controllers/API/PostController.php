<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->susscesResponse(Post::getLasted());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->susscesResponse(
            Post::create([
                'message' => $request->get('message'),
                'topic_id' => $request->get('topic_id'),
                'author_id' => $request->user()->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->susscesResponse(Post::findById($id));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post  = Post::find($id);

        $post->update([
            'message' => $request->get('message'),
        ]);

        return $this->susscesResponse($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();

        $this->susscesResponse(['sucess' => true, 'message' => 'post removed successfully!']);
    }
}
