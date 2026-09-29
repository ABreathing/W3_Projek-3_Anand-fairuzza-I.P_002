<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('activities')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request, CategoryService $service): RedirectResponse
    {
        $service->create($request->validated());

        return to_route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(Category $category, CategoryService $service): RedirectResponse
    {
        try {
            $service->delete($category);
        } catch (DomainException $exception) {
            return to_route('categories.index')->with('error', $exception->getMessage());
        }

        return to_route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}