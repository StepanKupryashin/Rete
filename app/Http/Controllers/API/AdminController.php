<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return $this->susscesResponse([
            'categories' => Category::getAll(),
            'topics' => Topic::getAll(),
            'users' => User::users()
        ]);
    }

    public function deleteUser(Request $request, int $id)
    {
        $this->susscesResponse(User::deleteUser($id));
    }

    public function linkTopicCategory(Request $request)
    {
        DB::table('categories_topics')->insert([
            'category_id' => $request->get('category_id'),
            'topic_id' => $request->get('topic_id'),
        ]);
        return $this->susscesResponse([
            'message' => 'Успешно'
        ]);
    }
}
