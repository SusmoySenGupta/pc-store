<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category_name = Category::create($request->validated())->name;

            Alert::toast("A new category '${category_name}' has been created", 'success')
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());

            Alert::toast("Category '{$category->name}' has been updated", 'success')
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
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
