<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest as Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            Category::create($request->all())->name;

            toast('Category created successfully', 'success');

            return redirect()->route('admin.categories.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category): View
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category): View
    {
        $categories = Category::all()->except($category->id);

        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        try {
            $category->update($request->all());

            toast('Category updated successfully', 'success');

            return redirect()->route('admin.categories.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            $category->delete();

            toast('Category deleted successfully', 'error');

            return redirect()->route('admin.categories.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return \Illuminate\View\View
     */
    public function trashed(): view
    {
        $this->authorize('viewany', Category::class);

        $categories = Category::onlyTrashed()
            ->orderBy('deleted_at', 'DESC')
            ->paginate(10);

        return view('admin.category.trashed', compact('categories'));
    }

    /**
     * Restore the specified category.
     *
     * @param  \Illuminate\Http\Request  $http_request
     * @param int $category_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(HttpRequest $http_request, $category_id): RedirectResponse
    {
        $category = Category::withTrashed()->findOrFail($category_id);

        $this->authorize('restore', $category);

        try {
            $category->restore();

            toast('Category restored successfully', 'success');

            return redirect()->route('admin.categories.trashed');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }

    /**
     * Permanently deletes the specified category.
     *
     * @param int $category_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($category_id): RedirectResponse
    {
        $category = Category::withTrashed()->findOrFail($category_id);

        $this->authorize('forceDelete', $category);

        try {
            $category->forceDelete();

            toast('Category deleted permanently', 'error');

            return redirect()->route('admin.categories.trashed');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }
}
