<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', null); // Lấy giá trị tìm kiếm từ query parameter
        $perPage = $request->get('per_page', 10); // Lấy số lượng record mỗi trang (mặc định 10)
    
        // Tìm kiếm theo 'name' và phân trang
        $categories = Category::when($search, function (Builder $query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->paginate($perPage);
    
        return response()->json($categories);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|max:255',
        ]);

        return Category::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'nullable|unique:categories|max:255',
            'description' => 'nullable|max:255',
        ]);

        $category->update($validated);

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $category;
    }
}

