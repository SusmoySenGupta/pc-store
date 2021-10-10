<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ComponentRequest as Request;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        $components = Component::latest()->paginate(10);

        return view('admin.component.index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\View\View
     */
    public function create(): View
    {
        $parent_components = Component::parents()->get();

        return view('admin.component.create', compact('parent_components'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ComponentRequest  $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $component = Component::create($request->validated());

            Alert::toast("A new component '{$component->name}' has been created", 'success')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-left')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.components.index');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Component  $component
     * @return Illuminate\View\View
     */
    public function show(Component $component)
    {
        return view('admin.component.show', compact('component'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Component  $component
     * @return Illuminate\Http\RedirectResponse
     */
    public function edit(Component $component): View
    {
        $parent_components = Component::parents()->get();

        return view('admin.component.edit', compact('component', 'parent_components'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ComponentRequest  $request
     * @param  App\Models\Component  $component
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Component $component): RedirectResponse
    {
        try {
            $component->update($request->validated());

            Alert::toast("Component '{$component->name}' has been updated", 'success')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-left')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.components.index');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Component  $component
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Component $component): RedirectResponse
    {
        try {
            $component->delete();

            Alert::toast("Component '{$component->name}' has been deleted", 'error')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-left')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.components.index');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }
}
