<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest as Request;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $tags = Tag::latest()->paginate(10);

        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            Tag::create($request->all());

            toast('Tag created successfully', 'success');

            return redirect()->route('admin.tags.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\View\View
     */
    public function edit(Tag $tag): View
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Tag $tag): RedirectResponse
    {
        try {
            $tag->update($request->all());

            toast('Category updated successfully', 'success');

            return redirect()->route('admin.tags.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        try {
            $tag->delete();

            toast('Category deleted successfully', 'success');

            return redirect()->route('admin.tags.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }
}
