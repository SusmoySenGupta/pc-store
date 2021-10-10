<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest as Request;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $brands = Brand::latest()->paginate(10);

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $brand_name = Brand::create($request->validated())->name;

            Alert::toast("A new brand '${brand_name}' has been created", 'success')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-left')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.brands.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand $brand
     * @return \Illuminate\View\View
     */
    public function edit(Brand $brand): View
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest $request
     * @param  \App\Models\Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Brand $brand): RedirectResponse
    {
        try {
            $brand->update($request->validated());
            
            Alert::toast("A new brand '{$brand->name}' has been created", 'success')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-left')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.brands.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        try {
            $brand->delete();

            Alert::toast("Brand '{$brand->name}' has been deleted", 'error')
                ->padding('0.3rem')
                ->width('20rem')
                ->position('bottom-left')
                ->background('#F9FAFB')
                ->timerProgressBar();

            return redirect()->route('admin.brands.index');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        };
    }
}
