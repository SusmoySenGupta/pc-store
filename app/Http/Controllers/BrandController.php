<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest as Request;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\View\View;

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
            Brand::create($request->all());

            toast('Brand created successfully', 'success');

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
            $brand->update($request->all());

            toast('Brand updated successfully', 'success');

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

            toast('Brand deleted successfully', 'error');

            return redirect()->route('admin.brands.index');
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
        $this->authorize('viewany', Brand::class);

        $brands = Brand::onlyTrashed()
            ->orderBy('deleted_at', 'DESC')
            ->paginate(10);

        return view('admin.brand.trashed', compact('brands'));
    }

    /**
     * Restore the specified brand.
     *
     * @param  \Illuminate\Http\Request  $http_request
     * @param int $brand_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(HttpRequest $http_request, $brand_id): RedirectResponse
    {
        $brand = Brand::withTrashed()->findOrFail($brand_id);

        $this->authorize('restore', $brand);

        try {
            $brand->restore();

            toast('Brand restored successfully', 'success');

            return redirect()->route('admin.brands.trashed');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }

    /**
     * Permanently deletes the specified brand.
     *
     * @param int $brand_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($brand_id): RedirectResponse
    {
        $brand = Brand::withTrashed()->findOrFail($brand_id);

        $this->authorize('forceDelete', $brand);

        try {
            $brand->forceDelete();

            toast('Brand deleted permanently', 'error');

            return redirect()->route('admin.brands.trashed');
        }
        catch (\Exception$e)
        {
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
    }
}
