<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->susscesResponse(Category::getAll());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->susscesResponse(
            Category::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->susscesResponse(Category::findById($id));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
      $category  = Category::find($id);
      $category->update([
        'title' => $request->get('title'),
        'description' => $request->get('description'),
      ]);  
        
      return $this->susscesResponse($category);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();

        $this->susscesResponse(['sucess' => true, 'message' => 'category removed successfully!']);
    }
}
