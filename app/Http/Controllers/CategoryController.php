<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
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
        $parent_categories = Category::parents()->get();

        return view('admin.category.create', compact('parent_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        try {
            $category_name = Category::create($request->validated())->name;

            Alert::toast("A new category '${category_name}' has been created", 'success')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-right')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.categories.index');
        }
        catch (\Exception $e)
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
        $parent_categories = Category::parents()->get()->except($category->id);

        return view('admin.category.edit', compact('category', 'parent_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        try {
            $category->update($request->validated());

            Alert::toast("Category '{$category->name}' has been updated", 'success')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-right')
                ->background('#F9FAFB')
                ->timerProgressBar();

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

            Alert::toast("Category '{$category->name}' has been deleted", 'error')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-left')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.categories.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }
}
