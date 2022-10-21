<?php

namespace App\Http\Services\Category;

use LaravelEasyRepository\Service;
use App\Http\Repositories\Category\CategoryRepository;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryServiceImplement extends Service implements CategoryService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(CategoryRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function create($attributes)
    {
        $category = $this->mainRepository->whereName($attributes['name']);
        if ($category) {
            return response()->json([
                'message' => 'Category name already registered!',
                'status' => 'error',
            ], Response::HTTP_BAD_REQUEST);
        }

        $category = $this->mainRepository->create($attributes);

        return response()->json([
            'message' => 'Category name added successfully!',
            'status' => 'success',
            'data' => $category
        ], Response::HTTP_CREATED);
    }

    public function update($id, $attributes)
    {
        $category = $this->mainRepository->update($id, $attributes);

        return response()->json([
            'message' => 'Category name updated successfully!',
            'status' => 'success',
            'data' => $category
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $category = $this->mainRepository->delete($id);

        return response()->json([
            'message' => 'Category name deleted successfully!',
            'status' => 'success',
            'data' => $category
        ], Response::HTTP_OK);
    }
}
