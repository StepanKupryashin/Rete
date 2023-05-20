<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->susscesResponse(Topic::getAll());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $topic = Topic::create([
            'title' => $request->get('title'),
            'description' => $request->get('description', "Отсутсвует"),
            'author_id' => $request->user()->id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        if ((bool) $request->get('to_category')) {
            DB::table('categories_topics')->insert([
                'category_id' => $request->get('category_id'),
                'topic_id' => $topic->id
            ]);
        }
        $topic->category;

        return $this->susscesResponse($topic);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $topic = Topic::findById($id);

        return $this->susscesResponse($topic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topic = Topic::find($id);

        $topic->update([
            'title' => $request->get('title'),
            'description' => $request->get('description', "Отсутсвует"),
        ]);
        if ((bool) $request->get('to_category')) {
            DB::table('categories_topics')->insert([
                'category_id' => $request->get('category_id'),
                'topic_id' => $topic->id
            ]);
        }

        if ((bool) $request->get('remove_category')) {
            DB::table('categories_topics')->
                where('category_id', $request->get('category_id'))
                ->where('topic_id', $topic->id)->
                delete();
        }

        $topic->category;

        return $this->susscesResponse($topic);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Topic::find($id)->delete();

        $this->susscesResponse(['sucess' => true, 'message' => 'topic removed successfully!']);
    }

    public function getLastActivity()
    {
        return $this->susscesResponse(Topic::lastActivity());
    }
}
